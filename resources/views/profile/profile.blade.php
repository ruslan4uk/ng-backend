@extends('layouts.app')

@section('title', 'Гид')

@section('content')
<section class="top">
    <div class="container">
        <div class="navigation navigation--revers">
        <div class="navigation__wrap">
            <a href="{{ route('main') }}" class="navigation__logo">
            <div class="logo">EG</div>
            </a>
            <ul class="navigation__list">
            <li class="navigation__item">
                <a href="about.html" class="navigation__link">О нас</a>
            </li>
            <li class="navigation__item">
                <a href="callback.html" class="navigation__link">Обратная связь</a>
            </li>
            </ul>
            <div class="navigation__right">
            <a href="login.html" class="btn btn--white">Вход</a>
            <a href="register.html" class="btn btn--blue btn--ml">Регистрация</a>
            </div>
        </div>
        </div>
    </div>
    </section>
    <section class="lk">
    <div class="container">
        <a href="" class="lk__help flex-right">Советы по заполнению профиля</a>
        <div class="lk__wrap">
        <div class="lk__left mb-2">
            <div class="user-pic">
            <div class="user-pic__photo">
                <img src="{{ asset('images/lk/userpic.png') }}" alt="" />
            </div>
            <div class="user-pic__name">Евгения Кулишенко </div>
            </div>
            <a href="" class="user-pic__add-photo">Добавить фото</a>
        </div>
        <div class="lk__right">
            <div class="lk__card mb-3">
            <div class="lk__title">Основная информация</div>
            <div class="lk__form form">
                <div class="form__group">
                <input type="text" class="form__input lk__country" placeholder="Введите Ваше имя или название компании" />
                </div>
                <div class="lk__form-wrap mb-1">
                <div class="lk__form-col lk__form-col--top">
                    <div class="form__group lk__form-select">
                    <select name="" id="" class="form__select">
                        <option value="Страна">Страна</option>
                        <option value="Страна">Страна</option>
                    </select>
                    <div class="lk__form-select-arr">&#9660;</div>
                    </div>
                    <div class="form__group">
                    <input type="text" class="form__input" placeholder="Языки" />
                    <a href="" class="lk__add">+ Добавить язык</a>
                    </div>
                </div>
                <div class="lk__form-col lk__form-col--top">
                    <div class="form__group">
                    <input type="text" class="form__input" placeholder="Город" />
                    <a href="" class="lk__add">+ Добавить город</a>
                    </div>
                </div>
                </div>
                <div class="lk__form-subtitle">Поставьте галочку напротив Ваших услуг</div>
                <div class="lk__checkbox-group mb-1">
                <div class="form__group form__custom-checkbox">
                    <input id="checkЧастный гид" type="checkbox" class="form__checkbox" />
                    <label for="checkЧастный гид" class="form__label">Частный гид</label>
                </div>
                <div class="form__group form__custom-checkbox">
                    <input id="checkТуристическая компания" type="checkbox" class="form__checkbox" />
                    <label for="checkТуристическая компания" class="form__label">Туристическая компания</label>
                </div>
                <div class="form__group form__custom-checkbox">
                    <input id="checkТрансфер" type="checkbox" class="form__checkbox" />
                    <label for="checkТрансфер" class="form__label">Трансфер</label>
                </div>
                <div class="form__group form__custom-checkbox">
                    <input id="checkАренда авто/яхт" type="checkbox" class="form__checkbox" />
                    <label for="checkАренда авто/яхт" class="form__label">Аренда авто/яхт</label>
                </div>
                <div class="form__group form__custom-checkbox">
                    <input id="checkОрганизация мероприятий" type="checkbox" class="form__checkbox" />
                    <label for="checkОрганизация мероприятий" class="form__label">Организация мероприятий</label>
                </div>
                <div class="form__group form__custom-checkbox">
                    <input id="checkУслуги перевода" type="checkbox" class="form__checkbox" />
                    <label for="checkУслуги перевода" class="form__label">Услуги перевода</label>
                </div>
                <div class="form__group form__custom-checkbox">
                    <input id="checkШопинг" type="checkbox" class="form__checkbox" />
                    <label for="checkШопинг" class="form__label">Шопинг</label>
                </div>
                </div>
                <div class="lk__form-subtitle">Контакты</div>
                <div class="lk__form-wrap">
                <div class="lk__form-col lk__form-col--top">
                    <div class="lk__form-flex lk__form-phone">
                    <div class="form__group form__group--plgrey lk__form-select">
                        <select name="" id="" class="form__select">
                        <option value="Страна">Дом</option>
                        <option value="Страна">Дом</option>
                        </select>
                        <div class="lk__form-select-arr">&#9660;</div>
                    </div>
                    <div class="form__group">
                        <input type="text" class="form__input" placeholder="+7" />
                    </div>
                    </div>
                    <div class="form__helper form__group">Введите номер с кодом города, напр. +7 495 646-84-89 или (495) 6468489</div>
                </div>
                </div>
                <div class="lk__block-contact mb-1">
                <div class="lk__checkbox-group">
                    <div class="form__group form__custom-checkbox">
                    <input id="checkWhatsapp" type="checkbox" class="form__checkbox" />
                    <label for="checkWhatsapp" class="form__label">Whatsapp</label>
                    </div>
                    <div class="form__group form__custom-checkbox">
                    <input id="checkViber" type="checkbox" class="form__checkbox" />
                    <label for="checkViber" class="form__label">Viber</label>
                    </div>
                    <div class="form__group form__custom-checkbox">
                    <input id="checkTelegram" type="checkbox" class="form__checkbox" />
                    <label for="checkTelegram" class="form__label">Telegram</label>
                    </div>
                    <div class="form__group form__custom-checkbox">
                    <input id="checkWechart" type="checkbox" class="form__checkbox" />
                    <label for="checkWechart" class="form__label">Wechart</label>
                    </div>
                </div>
                <a href="" class="lk__add">+ Добавить номер</a>
                </div>
                <div class="lk__form-subtitle">Удобное время для связи</div>
                <div class="lk__block-work">
                <div class="form__group lk__block-work-week lk__form-select">
                    <select name="" id="" class="form__select">
                    <option value="Страна">День недели</option>
                    <option value="Страна">День недели</option>
                    </select>
                    <div class="lk__form-select-arr">&#9660;</div>
                </div>
                <div class="form__group lk__block-work-time">
                    <input type="text" class="form__input" placeholder="С" />
                </div>
                <div class="form__group lk__block-work-time">
                    <input type="text" class="form__input" placeholder="По" />
                </div>
                </div>
            </div>
            </div>
            <div class="lk__card mb-3">
            <div class="lk__title">В интернете</div>
            <div class="lk__form form">
                <div class="lk__form-wrap">
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Эл.почта" />
                    <div class="lk__fphone-favorite active">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Вконтакте" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Скайп" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Одноклассники" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Сайт" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Инстаграм" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Facebook" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="Twitter" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="+7 982 528 45 60" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="+7 982 528 45 60" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                <div class="lk__form-col2">
                    <div class="form__group lk__fphone">
                    <input type="text" class="form__input" placeholder="+7 982 528 45 60" />
                    <div class="lk__fphone-favorite ">&#9733;</div>
                    </div>
                </div>
                </div>
                <div class="lk__form-wrap">
                <div class="lk__form-col2">
                    <div class="form__group form__helper mb-0"> * Чтобы добавить избранный вид связи нажмите на звездочку </div>
                </div>
                </div>
            </div>
            </div>
            <div class="lk__card mb-3">
            <div class="lk__title lk__title--nomrg">Расскажите туристам о себе</div>
            <div class="lk__subtitle">Это позволит привлечь больше внимания к Вам</div>
            <div class="lk__form form">
                <textarea name="" id="" cols="30" rows="10"></textarea>
                <div class="form__helper">*Минимум 200 знаков</div>
            </div>
            </div>
            <div class="lk__card mb-3">
            <div class="lk__title lk__title--nomrg">Лицензия гида</div>
            <div class="lk__subtitle">Если у Вас есть лицензия, обязательно покажите ее, это повысит уровень доверия к Вам</div>
            <div class="lk__upload upload">
                <h3>Загрузчик фото (будет подбираться и стилизоваться в зависимости от дальнейшей реализации</h3>
            </div>
            </div>

            @if(Auth::user()->hasRole('admin'))
                <div class="lk__card lk__card--admin mb-3">
                    <div class="lk__title lk__title--nomrg">Комментарий администратора</div>
                    <div class="lk__subtitle">При отказе в модерации оставьте комментарий по исправлению ошибок заполнения профиля</div>
                    <div class="lk__form form">
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="flex-center lk__admin-btn">
                    <a href="" class="btn-submit btn-submit--success">Сохранить и одобрить анкету</a>
                    <a href="" class="btn-submit btn-submit--error">Сохранить и отклонить анкету</a>
                </div>
            @endif
            

            <div class="flex-center">
            <input type="submit" value="Сохранить" class="btn-submit" />
            </div>
        </div>
        </div>
    </div>
    </section>

    {{-- Footer include --}}
    @include('partials/footer')

@endsection