<?php

class ParserXml{

    public $modx;
    public $fileXml;
    public $xml;
    public $dom;
    public $iteration;

    //public $category_id;

    public $category_temp; // Array temp category
    public $product_temp; // ['article'] => ['id']
    public $temp;
    //public $filter_temp;

    public $msearch_limit;
    public $iter;


    /**
     * @param modX $modx
     * @param array $config
     */
    public function __construct($modx)
    {
        $this->iteration = 1;
        $this->modx = $modx;
        $this->xml = new XMLReader;
        $this->dom = new DOMDocument;
        $this->category_temp;
        $miniShop2 = $this->modx->getService('miniShop2');
    }

    /**
     * Init method
     * @param none
     * @return none
     */
    function init() {
        // Start parse file and create or update resource
        $this->xml_to_array();
        $this->xml_user_sale();
        // Delete diff resource
        if(!$this->diff_resource()){
        // Delete old index mSearch2
        $this->msearch_index_delete();
        // Create index mSearch2
        $this->msearch_index_update($msearch_limit);
        }
        // Next step clear cache
        $this->modx->cacheManager->clearCache();
    }

    function xml_user_sale() {
        echo "<pre>";
        if($this->fileXml){
            $this->xml->open($this->fileXml);
            // Начинаем чтение первого элемента
            while ($this->xml->read() && $this->xml->name !== 'Контрагент');
            // && $iteration < $this->iter
            // Проходим циклом по каждому элементу
            while ($this->xml->name === 'Контрагент')
            //while ($this->xml->name === 'Элемент')
            {
                //$iteration++;
                // Закидываем элемент в simpleXml и парсим 
                $node = simplexml_import_dom($this->dom->importNode($this->xml->expand(), true));
                $list = json_decode(json_encode($node),1);

                if(isset($list['@attributes']['Почта']) && $list['@attributes']['Почта'] != '') {
                    $user_email = $list['@attributes']['Почта'];
                    if ($user = $this->modx->getObject('modUser', array('username' => $user_email))) {
                        if ($profile = $user->getOne('Profile')) {
                            $extended = $profile->get('extended');
                            $extended['sale'] = $list['@attributes']['Скидка'];
                            $profile->set('extended', $extended);
                            if ($profile->save()) {
                                echo "Скидка пользователя ". $profile->get('email') ." обновлена \n";
                            } else {
                                echo "Не удалось обновить профиль \n";
                            } 
                        } else { echo $list['@attributes']['Почта'] ." ошибка получения профиля \n"; }
                    } else {  echo "Пользователя ". $list['@attributes']['Почта'] ." не существует \n"; }
                } else { echo "!!! Не существует почты". $list['@attributes']['Почта']."\n"; }

                // Переход к следующему элементу
                $this->xml->next('Контрагент');
            }
            $this->xml->close($this->fileXml);
        }
    }

    /**
     * File to array
     * @param url $fileXml
     * @return array $return
     */
    function xml_to_array() {
        if($this->fileXml){
            $this->xml->open($this->fileXml);
            // Начинаем чтение первого элемента
            while ($this->xml->read() && $this->xml->name !== 'Элемент');

            // Проходим циклом по каждому элементу
            while ($this->xml->name === 'Элемент' && $iteration < $this->iter)
            //while ($this->xml->name === 'Элемент')
            {
                $iteration++;

                // Закидываем элемент в simpleXml и парсим 
                $node = simplexml_import_dom($this->dom->importNode($this->xml->expand(), true));
                $list = json_decode(json_encode($node),1);
               
                // Делаем запрос и узнаем есть ли у нас такой ресурс 
                // Сравнение по артикулу
                $parent_id = $this->is_resource($list['@attributes']['Артикул']);

                // Массив виртуальных категорий
                $filter[] = $this->is_category($list['@attributes']['ТипОсновы'],3);
                $filter[] = $this->is_category($list['@attributes']['Цвет'],4);
                $filter[] = $this->is_category($list['@attributes']['Оттенок'],5);
                $filter[] = $this->is_category($list['@attributes']['ВидРисунка'],6);
                $filter[] = $this->is_category($list['@attributes']['Производитель'],7);

                // Формируем регулярную
                if($list['@attributes']['РегулярнаяТкань'] == "Да") {
                    $filter[] = 10;
                }
                // Формируем распродажу
                $praspr = 0;
                if($list['@attributes']['ЦенаРаспродажа'] > 0) {
                    $praspr = 1;
                    $filter[] = 13;
                    echo "Распродажа - ".$praspr."\n";
                }
                
                // Формируем акцию
                $paction = 0;
                if($list['Категории']['Категория']['@attributes']['Процент']) {
                    $paction = 1;
                    $filter[] = 12;
                }
                // Формируем новинки
                $pnew = 0;
                if($list['Категории']['Категория']['@attributes']['АвтоматРассчитаннаяНазвание'] == "Автомат рассчитанная новинка") {
                    $filter[] = 11;
                    $pnew = 1;
                }

                // Если в двух категориях дерева
                if($list['@attributes']['Фактура2'] != "") {
                    $filter[] = $this->parent_id(
                        $list['@attributes']['Фактура2'],
                        $list['@attributes']['ВидФактуры2']
                    );
                }

                // Суем в массив даже если один элемент
                foreach($this->string_to_array($list['Назначения']['Назначение']) as $use) {
                    $filter[] = $this->is_category($use,8);
                }

                // Убираем расширение у картинок
                // Пока так, потом уберем этот цикл
                // Приводим к виду .jpg (в сайте!!!)
                foreach($this->string_to_array($list['Картинки']['Картинка']) as $value) {
                    $image[] = substr($value, 0, (strlen ($value)) - (strlen (strrchr($value,'.'))));
                }
                // Исключаем дубли
                $filter = array_values(array_diff($filter, array('')));

                // Готовим цены
                if($list['@attributes']['ЦенаРасчетная'] == $list['@attributes']['ЦенаБазовая']) {
                    // Цены одинаковы распродажи нет
                    $price_tmp = str_replace(',','.',$list['@attributes']['ЦенаБазовая']);
                    $price = preg_replace('/[^0-9,.]/','', $price_tmp);
                    //$price = preg_replace('~\D+~','', $list['@attributes']['ЦенаРасчетная']);
                    //$price = preg_replace('%^\s+|\s+$%u', '', $list['@attributes']['ЦенаБазовая']);
                    
                    $old_price = 0;
                } else {
                    //$price = preg_replace('~\D+~','', $list['@attributes']['ЦенаРасчетная']);
                    $price_tmp = str_replace(',','.',$list['@attributes']['ЦенаРасчетная']);
                    $price = preg_replace('/[^0-9,.]/','', $price_tmp);
                    
                    $old_price_tmp = str_replace(',','.',$list['@attributes']['ЦенаБазовая']);
                    $old_price = preg_replace('/[^0-9,.]/','', $old_price_tmp);
                    //$old_price = preg_replace('~\D+~','', $list['@attributes']['ЦенаБазовая']);
                }
                
                // Готовим скидку
                if(!$list['@attributes']['ПроцентСкидкиНаценки']) {
                    $list['@attributes']['ПроцентСкидкиНаценки'] = '';
                }

                echo "<pre>";

                // Если ЕСТЬ - обновляем
                // Если НЕТ - создаем
                if($parent_id) {
                    
                    // Т.к. нет ресурса пробегаемся по дереву, 
                    // нужен родитель 
                    // Жрет много ресурсов
                    $parent = $this->parent_id(
                        $list['@attributes']['Фактура1'],
                        $list['@attributes']['ВидФактуры1']
                    );
                      
                    // Получаем объект и обновляемся
                    $resource = $this->modx->getObject('msProduct', (int)$parent_id);
                    $resource->set('parent', (int)$parent);
                    $resource->set('pagetitle', $list['@attributes']['НаименованиеДляСайта']);
                    $resource->set('article', $list['@attributes']['Артикул']);
                    $resource->set('tags', $this->string_to_array($list['Назначения']['Назначение']));
                    $resource->set('categories', $filter);
                    $resource->set('template', 3);
                    $resource->set('context_key', 'web');
                    $resource->set('price', $price);
                    //$resource->set('old_price', $old_price);
                    $resource->set('content', $list['@attributes']['ДополнительноеОписаниеНоменклатуры']);
                    $resource->setTVValue('images', json_encode($image));
                    $resource->set('createdon', strtotime($list['@attributes']['ДатаПоследнегоПоступления']));
                    $resource->set('thumb', '../product/'.$image[0].'.jpg');
                    // $resource->set('guid', $list['@attributes']['Гуид']);
                    $resource->setTVValue('color', $list['@attributes']['Цвет']);
                    $resource->setTVValue('subcolor', $list['@attributes']['Оттенок']);
                    $resource->setTVValue('remainder', preg_replace("/[^a-z0-9.%()\'<>]/i", "", str_replace(',','.', $list['@attributes']['Остаток'])));
                    $resource->setTVValue('width', $list['@attributes']['Ширина']);
                    $resource->setTVValue('composition', $list['@attributes']['Состав']);
                    $resource->setTVValue('basis', $list['@attributes']['ТипОсновы']);
                    $resource->setTVValue('vendors', $list['@attributes']['Производитель']);
                    $resource->setTVValue('images', json_encode($image));
                    $resource->setTVValue('bilateral', $this->string_to_int($list['@attributes']['Двусторонняя']));
                    $resource->setTVValue('regular', $this->string_to_int($list['@attributes']['РегулярнаяТкань']));
                    // remote warehouse
                    $resource->setTVValue('remote_warehouse', $this->string_to_int($list['@attributes']['УдаленныйСклад']));
                    // end remote warehouse
                    $resource->setTVValue('pcount', $list['@attributes']['ВШтуках']);
                    $resource->setTVValue('sale', $list['@attributes']['ПроцентСкидкиНаценки']);
                    $resource->setTVValue('oldprice', $old_price);
                    $resource->setTVValue('newprice', $price);
                    $resource->setTVValue('praspr', $praspr);
                    $resource->setTVValue('paction', $paction);
                    $resource->setTVValue('pnew', $pnew);
                    $resource->set('deleted', 0);
                    $resource->set('deletedon', 0);
                    $resource->set('deletedby', 0);
                    
                    // Проверка на успех и показываем что обновились
                    if($resource->save()){
                        echo "Resource update " . $resource->get('id') . " - " . $price_tmp . " - " . $price . "\n";
                    }
                    // Создаем массив ['article'] => ['id']
                    $this->product_temp[$list['@attributes']['Артикул']] = $resource->get('id');

                } else {
                    // Т.к. нет ресурса пробегаемся по дереву, 
                    // нужен родитель 
                    // Жрет много ресурсов
                    $parent = $this->parent_id(
                        $list['@attributes']['Фактура1'],
                        $list['@attributes']['ВидФактуры1']
                    );

                    // Создаем новый товар
                    $resource = $this->modx->newObject('msProduct',array(
                        'parent' => (int)$parent,
                        'pagetitle' => $list['@attributes']['НаименованиеДляСайта'],
                        'class_key' => 'msProduct',
                        'published' => 1,
                        'article' => $list['@attributes']['Артикул'],
                        'tags' => $this->string_to_array($list['Назначения']['Назначение']),
                        'categories' => $filter,
                        'template' => 3,
                        'context_key' => 'web',
                        'price' => $price,
                        //'old_price' => $old_price,
                        'content' => $list['@attributes']['ДополнительноеОписаниеНоменклатуры'],
                        'alias' => 'i'.preg_replace('~\D+~','',$list['@attributes']['Артикул']),
                        'source' => $this->modx->getOption('ms2_product_source_default'),
                        'createdon' => $list['@attributes']['ДатаПоследнегоПоступления'],
                        'show_in_tree' => 0,
                        'thumb' => '../product/'.$image[0] . '.jpg',
                    ));
                    if($resource->save()){
                        // Добавляем ТВшку и показываем что создали
                        $resource = $this->modx->getObject('msProduct', $resource->get('id'));
                        $resource->setTVValue('images', json_encode($image));
                        $resource->setTVValue('color', $list['@attributes']['Цвет']);
                        $resource->setTVValue('subcolor', $list['@attributes']['Оттенок']);
                        $resource->setTVValue('remainder', preg_replace("/[^a-z0-9.%()\'<>]/i", "", str_replace(',','.', $list['@attributes']['Остаток'])));
                        $resource->setTVValue('width', $list['@attributes']['Ширина']);
                        $resource->setTVValue('composition', $list['@attributes']['Состав']);
                        $resource->setTVValue('basis', $list['@attributes']['ТипОсновы']);
                        $resource->setTVValue('vendors', $list['@attributes']['Производитель']);
                        $resource->setTVValue('images', json_encode($image));
                        $resource->setTVValue('bilateral', $this->string_to_int($list['@attributes']['Двусторонняя']));
                        $resource->setTVValue('regular', $this->string_to_int($list['@attributes']['РегулярнаяТкань']));
                        // remote warehouse
                        $resource->setTVValue('remote_warehouse', $this->string_to_int($list['@attributes']['УдаленныйСклад']));
                        // end remote warehouse
                        $resource->setTVValue('pcount', $list['@attributes']['ВШтуках']);
                        $resource->setTVValue('sale', $list['@attributes']['ПроцентСкидкиНаценки']);
                        $resource->setTVValue('oldprice', $old_price);
                        $resource->setTVValue('newprice', $price);
                        $resource->setTVValue('praspr', $praspr);
                        $resource->setTVValue('paction', $paction);
                        $resource->setTVValue('pnew', $pnew);
                        $resource->save();

                        // Создаем массив ['article'] => ['id']
                        $this->product_temp[$list['@attributes']['Артикул']] = $resource->get('id');


                        echo "Resource create " . $resource->get('id') . "\n";
                    }
                }

                // Обнуляем массивы
                unset($filter);
                unset($image);
                // Переход к следующему элементу
                $this->xml->next('Элемент');
            }            
            $this->xml->close($this->fileXml);
        }

        print_r($this->category_temp);

        echo "ИНФОРМАЦИЯ: \n";
        echo "Колличество запросов к БД: " . $this->modx->executedQueries . "\n";

    }


    /**
     * Если что то в файле нехватает, а на сайте есть - удаляем
     * @param none
     * @return true
     */
    function diff_resource() {
        $all_product = $this->modx->getCollection('msProduct', array('published' => 1, 'searchable' => 1, 'deleted' => 0));
        foreach($all_product as $one_product) {
            $temp[$one_product->get('article')] = $one_product->get('id');
        }

        $id_for_delete = array_diff($temp,$this->product_temp);

        foreach($id_for_delete as $k => $v) {
            // $resource = $this->modx->getObject('msProduct', (int)$array['id']);
            // if($resource) {
            //     $resource->set('deleted', 1);
            //     if($resource->save()) {
            //         return "Ресурс отмечен как удаленный! \n";
            //         $flag = true;
            //     }
            // }
            $response = $this->modx->runProcessor('resource/delete', array('id' => $v));
            if (!$response->isError()) {
                echo "Товар с артикулом $v - удален \n";
                $flag = true;
            }
        }
        if($flag) return true;
        return false;
    }
        

    /**
     * mSearch2 update index processor
     * @param limit
     * @return is_error
     */
    function msearch_index_update($limit = 999) {
        $response = $this->modx->runProcessor('mgr/index/create', array(
            'limit' => $limit,
            ), 
            array(
                'processors_path' => $this->modx->getOption('core_path') . 'components/msearch2/processors/'
            )
        );
        echo "Индекс обновлен \n";
        return $response->response;
    }

    /**
     * mSearch2 delete index processor
     * @param none
     * @return is_error
     */
    function msearch_index_delete() {
        $response = $this->modx->runProcessor('mgr/index/remove', 
            array(), 
            array(
                'processors_path' => $this->modx->getOption('core_path') . 'components/msearch2/processors/'
            )
        );
        echo "Индекс очищен \n";
        return $response->response;
    }

    /**
     * Да или пустота преобразуем в 0 и 1
     * @param string
     * @return int 1/0
     */
    function string_to_int($string) {
        if($string == "Да") {
            return 1;
        } else {
            return 0;
        }
    }


    /**
     * Если не массив делаем массив
     * @param array ? string
     * @return array
     */
    function string_to_array($input) {
        if(!is_array($input)) {
            $input = array($input);
        }
        return $input;
    }

    /**
     * Проверяем есть ли ресурс родитель
     * @param string $articul
     * @return int $return
     */
    function is_resource($articul = false) {
        $is_resource = $this->modx->getObject(
            'msProductData', 
            array('article' => $articul)
        );
        if($is_resource) {
            return $is_resource->get('id');
        } else {
            return false;
        }
    }

    /**
     * Получаем ид родителя 
     * @param string $category - pagetitle
     * @param string $subcategory - pagetitle
     * @return int $return
     */
    function parent_id($category, $subcategory = false) {

        if(!$subcategory && $subcategory == "") {
            $c_id = $this->is_category($category);
            if($c_id) {
                // Категория существует, возвращаем ИД
                return $c_id;
            } else {
                exit('Ошибка построения дерева!');
            }
        } else {
            $c_id = $this->is_category($category);
            if($c_id) {
                // Категория существует, узнаем про субкатегорию
                $s_id = $this->is_category($subcategory,$c_id);
                if($s_id) {
                    return $s_id;
                } else {
                    exit('Ошибка построения дерева 2!');
                }
            } else {
                exit('Ошибка построения дерева 1!');
            }
        }
        
        
    }

    /**
     * Проверка на наличие категории и субкатегории
     * Если категории нет, то создаем
     * @param string $category - pagetitle
     * @return int $return id
     */
    function is_category($category, $parent = 2) {

        if($category == "") return false;

        if($parent == 2 and $this->category_temp[$category]) {
            return $this->category_temp[$category];
        }

        $is_category = $this->modx->getObject(
            'modResource', 
            array('pagetitle' => $category, 'parent' => $parent)
        );

        // Категория есть
        // Возвращаем ИД категории
        if($is_category) {
            $c = $is_category->get('id');
            if($parent == 2) $this->category_temp[$category] = $c;
            return $c;
        } else {
            
            $alias = modResource::filterPathSegment($this->modx, $category);

            $response = $this->modx->newObject('msCategory',array(
                'pagetitle' => $category,
                'class_key' => 'msCategory',
                'published' => 1,
                'parent' => $parent,
                'template' => 2,
                'context_key' => 'web',
                'alias' => $alias,
                'isfolder' => 1
            ));

            if($response->save()){
                $c = $response->get('id');
            }

            if($parent == 2) $this->category_temp[$category] = $c;
            return $c;
        }
        
    }

    /**
     * Create resource
     * @param array 
     * @return int $response->response['object']['id']
     */
    function create_processor($array) {
        $response = $this->modx->runProcessor('resource/create', $array);
        if ($response->isError()) {
            exit("Ошибка при создании категорий первого уровня");
        }
        return $response->response['object']['id'];
    }

    /**
     * Delete processor
     * @param array 'id' => $id
     * @return $response
     */
    function delete_processor($array) {
        // $response = $this->modx->runProcessor('resource/delete', $array);
        // if (!$response->isError()) {
        //     return 'Ресурс отмечен как удаленный!';
        //     // echo $response->getResponse();
        // }

        $resource = $this->modx->getObject('msCategory', (int)$array['id']);
        if($resource) {
            $resource->set('deleted', 1);
            if($resource->save()) {
                return "Ресурс отмечен как удаленный! \n";
            }
        }
    }

    /**
     * Get all resource id
     * @return array $output
     */
    function get_all_resource() {
        $query = $this->modx->newQuery('modResource');
        $query->where(array(
            'class_key' => 'msCategory',
            'id:>=' => 14,
        ));
        $resources = $this->modx->getCollection('modResource',$query);
        foreach ($resources as $k => $res) {
        $output[] = $res->get('id');
        }
        return $output;
    }

}
?>