<template>
    <div class="card card-panel">
        <div class="card-body">
            <div class="title">Создать \ Редактировать</div>
            <div class="row">
                <form action="" class="col-12">
                    
                    <custom-uploader action="article/upload"></custom-uploader>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Заголовок">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Алиас (ЧПУ)">
                        <div class="form-helper">Генерируется автоматически</div>
                    </div>

                    <div class="form-group">
                        <multiselect
                            v-model="country"
                            :options="countries"
                            :custom-label="searchCountry"
                            :max-height="250" 
                            :show-labels="false"
                            :clear-on-select="false"
                            :allow-empty="false"
                            placeholder="Страна"
                            label="title"
                            key="id"
                            track-by="id">
                            <span slot="noResult">Не найдено</span>
                        </multiselect>
                    </div>

                    <div class="form-group">
                        <multiselect 
                            v-model="city" 
                            :options="cities"
                            :max-height="250" 
                            :show-labels="false" 
                            :searchable="true"
                            :internal-search="true"
                            :clear-on-select="false"
                            :loading="isLoadingCity" 
                            :disabled="isDisabledCity"
                            :allow-empty="false"
                            track-by="id"
                            key="idd"
                            label="title"
                            :custom-label="searchCountry"
                            @search-change="searchCityVk"
                            placeholder="Город">
                            <span slot="noResult">Не найдено</span>
                        </multiselect>
                    </div>

                    <div class="form-group mb-4">
                        <div class="subtitle">Текст (область контент)</div>
                        <ckeditor 
                            :editor="editor" 
                            v-model="content" 
                            :config="editorConfig"
                            tag-name="textarea"></ckeditor>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import { mapFields } from 'vuex-map-fields'
import Multiselect from 'vue-multiselect'
import CustomUploader from '../../general/CustomUploader/CustomUploader'
export default {
    name: 'ArticleShow',
    components: { Multiselect, CustomUploader },
    data() {
        return {
            editor: ClassicEditor,
            editorConfig: {
                ckfinder: {
                    uploadUrl: '/admin/api/v1/article/upload'
                }
            },
            content: '',

            country: [],
            city: [],

            countries: [],
            cities: [],
            isLoadingCountry: false,
            isLoadingCity: false,
            isDisabledCity: this.city ? true : false,

            
        }
    },
    computed: {
        
    },
    methods: {
        UploadAdapter(loader) {
            console.log(loader)
        },
        getCountryVk () {
            this.isLoadingCountry = true;
            window.jsonp('https://api.vk.com/method/database.getCountries?v=5.92&need_all=1&lang=ru&count=1000&access_token=' + window.vk_access_token, null, (err, data) => {
                if (err) {console.error('Error get country ', err.message)} else {
                    this.countries = data.response.items;
                    this.isLoadingCountry = false;}
            });
        },
        // country
        searchCountry ({ key, title }) {
            return `${title}`
        },
        searchCityVk (query) {
            this.isLoadingCity = true;
            window.jsonp('https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + this.country.id + '&q=' + query + '&access_token=' + window.vk_access_token, null, (err, data) => {
                if (err) {console.error('Error search city ',err.message);} else {
                    this.cities = data.response.items;
                    this.isLoadingCity = false;}
            });
        },
        getCityVk (option) {
            this.isLoadingCity = true;
            window.jsonp('https://api.vk.com/method/database.getCities?v=5.92&lang=ru&country_id=' + option.id + '&access_token=' + window.vk_access_token, null, (err, data) => {
                if (err) {console.error('Error get city ',err.message);} else {
                    this.cities = data.response.items;
                    this.isLoadingCity = false;}
            });
        },
    },
    mounted() {
        this.getCountryVk();
        console.log(this.country)
    }
}
</script>

<style scoped>

</style>