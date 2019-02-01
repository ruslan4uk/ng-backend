@extends('layouts.app')

@section('title', 'Гид')

@section('content')

<section class="top top--blue">
    <div class="container">
      
      {{-- Navigation include --}}
      @include('partials/navigation')

    </div>
  </section>
  <div class="cguide">
    <div class="container">
      <div class="cguide__wrap">
        <div class="cguide__left">
          <div class="cguide__userpic">
            <img src="{{ asset('images/cguide/userpic.jpg') }}" alt="" />
          </div>
          <div class="cguide__fio">{{ $user->name }}</div>
          <div class="cguide__cl">
            <div class="cguide__cl-block">
              <svg class="cguide__cl-icon">
                <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
              </svg>
              <span class="cguide__cl-count">285</span>
            </div>
            <div class="cguide__cl-block">
              <svg class="cguide__cl-icon">
                <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
              </svg>
              <span class="cguide__cl-count">15</span>
            </div>
          </div>
          <div class="cguide__lang">
            <div class="cguide__lang-title">Владение языками</div>
            <div class="cguide__lang-list">
              <a href="" class="cguide__lang-item">
                <img src="{{ asset('images/main/flag.png') }}" alt="" />
              </a>
              <a href="" class="cguide__lang-item">
                <img src="{{ asset('images/main/flag.png') }}" alt="" />
              </a>
              <a href="" class="cguide__lang-item">
                <img src="{{ asset('images/main/flag.png') }}" alt="" />
              </a>
            </div>
          </div>
          <div class="cguide__services">
            <div class="cguide__subtitle">Услуги</div>
            <p>-Индивидуальные экскурсии </p>
            <p>-Сопровождение на деловых встречах, организация конференций, устный перевод</p>
            <p>-Трансфер</p>
            <p>-Услуги перевода</p>
          </div>
        </div>
        <div class="cguide__right">
          <div class="cguide__content">
            <div class="cguide__title">Обо мне</div>
            <p>{{ $user_data->about }}</p>
            <div class="cguide__contact">
              <div class="cguide__title">Основные контакты</div>
              <div class="cguide__contact-list">
                <div class="cguide__contact-item">
                  <svg class="cguide__contact-icon">
                    <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                  </svg>
                  <div class="cguide__contact-text">kulishenko@libero.it</div>
                </div>
                <div class="cguide__contact-item">
                  <svg class="cguide__contact-icon">
                    <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                  </svg>
                  <div class="cguide__contact-text">kulishenko@libero.it</div>
                </div>
                <div class="cguide__contact-item">
                  <svg class="cguide__contact-icon">
                    <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                  </svg>
                  <div class="cguide__contact-text">kulishenko@libero.it</div>
                </div>
                <div class="cguide__contact-item">
                  <svg class="cguide__contact-icon">
                    <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                  </svg>
                  <div class="cguide__contact-text">kulishenko@libero.it</div>
                </div>
              </div>
              <div class="cguide__contact-hide">
                <div class="cguide__title cguide__title--small">Дополнительные</div>
                <div class="cguide__contact-list">
                  <div class="cguide__contact-item">
                    <svg class="cguide__contact-icon">
                      <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                    </svg>
                    <div class="cguide__contact-text">kulishenko@libero.it</div>
                  </div>
                  <div class="cguide__contact-item">
                    <svg class="cguide__contact-icon">
                      <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                    </svg>
                    <div class="cguide__contact-text">kulishenko@libero.it</div>
                  </div>
                  <div class="cguide__contact-item">
                    <svg class="cguide__contact-icon">
                      <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                    </svg>
                    <div class="cguide__contact-text">kulishenko@libero.it</div>
                  </div>
                  <div class="cguide__contact-item">
                    <svg class="cguide__contact-icon">
                      <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                    </svg>
                    <div class="cguide__contact-text">kulishenko@libero.it</div>
                  </div>
                  <div class="cguide__contact-item">
                    <svg class="cguide__contact-icon">
                      <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                    </svg>
                    <div class="cguide__contact-text">kulishenko@libero.it</div>
                  </div>
                  <div class="cguide__contact-item">
                    <svg class="cguide__contact-icon">
                      <use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use>
                    </svg>
                    <div class="cguide__contact-text">kulishenko@libero.it</div>
                  </div>
                </div>
              </div>
              <a href="" class="cguide__contact-more js--cguide-open">Подробнее</a>
            </div>
            <div class="cguide__action action">
              <div class="cguide__title action__title">Экскурсии</div>
              <div class="action__wrap owl-carousel js--action-slider">
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action2.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action3.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action4.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action2.jpg' ) }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action3.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action4.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action2.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action3.jpg') }}" alt="" />
                  </a>
                </div>
                <div class="action__item">
                  <a href="#" class="action__link">
                    <img src="{{ asset('images/action/action4.jpg') }}" alt="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="cguide__comments">
            <div class="cguide__title">Комментарии</div>
            <div class="comment">
              <div class="comment__wrap">
                <div class="comment__photo">
                  <img src="img/main/photo.jpg" alt="" />
                </div>
                <div class="comment__description">
                  <div class="comment__title">Айшат</div>
                  <div class="comment__subtitle">01.01.2019</div>
                  <div class="comment__rating"></div>
                  <div class="comment__text"> Первый мой приезд в Рим был очень неожиданным, совершенно случайным… Теперь я здесь живу и это уже неслучайно. Город оказался совершенно своим, родным и светлым. Застольные песни, культура винограда, застывшие во времени целые кварталы – все это пришлось мне по душе и очень кстати. Сейчас... </div>
                  <a href="" class="comment__more">Подробнее</a>
                </div>
              </div>
            </div>
            <div class="comment">
              <div class="comment__wrap">
                <div class="comment__photo">
                  <img src="img/main/photo.jpg" alt="" />
                </div>
                <div class="comment__description">
                  <div class="comment__title">Айшат</div>
                  <div class="comment__subtitle">01.01.2019</div>
                  <div class="comment__rating"></div>
                  <div class="comment__text"> Первый мой приезд в Рим был очень неожиданным, совершенно случайным… Теперь я здесь живу и это уже неслучайно. Город оказался совершенно своим, родным и светлым. Застольные песни, культура винограда, застывшие во времени целые кварталы – все это пришлось мне по душе и очень кстати. Сейчас... </div>
                  <a href="" class="comment__more">Подробнее</a>
                </div>
              </div>
            </div>
            <div class="comment">
              <div class="comment__wrap">
                <div class="comment__photo">
                  <img src="img/main/photo.jpg" alt="" />
                </div>
                <div class="comment__description">
                  <div class="comment__title">Айшат</div>
                  <div class="comment__subtitle">01.01.2019</div>
                  <div class="comment__rating"></div>
                  <div class="comment__text"> Первый мой приезд в Рим был очень неожиданным, совершенно случайным… Теперь я здесь живу и это уже неслучайно. Город оказался совершенно своим, родным и светлым. Застольные песни, культура винограда, застывшие во времени целые кварталы – все это пришлось мне по душе и очень кстати. Сейчас... </div>
                  <a href="" class="comment__more">Подробнее</a>
                </div>
              </div>
            </div>
            <div class="comment">
              <div class="comment__wrap">
                <div class="comment__photo">
                  <img src="img/main/photo.jpg" alt="" />
                </div>
                <div class="comment__description">
                  <div class="comment__title">Айшат</div>
                  <div class="comment__subtitle">01.01.2019</div>
                  <div class="comment__rating"></div>
                  <div class="comment__text"> Первый мой приезд в Рим был очень неожиданным, совершенно случайным… Теперь я здесь живу и это уже неслучайно. Город оказался совершенно своим, родным и светлым. Застольные песни, культура винограда, застывшие во времени целые кварталы – все это пришлось мне по душе и очень кстати. Сейчас... </div>
                  <a href="" class="comment__more">Подробнее</a>
                </div>
              </div>
            </div>
            <div class="comment">
              <div class="comment__wrap">
                <div class="comment__photo">
                  <img src="img/main/photo.jpg" alt="" />
                </div>
                <div class="comment__description">
                  <div class="comment__title">Айшат</div>
                  <div class="comment__subtitle">01.01.2019</div>
                  <div class="comment__rating"></div>
                  <div class="comment__text"> Первый мой приезд в Рим был очень неожиданным, совершенно случайным… Теперь я здесь живу и это уже неслучайно. Город оказался совершенно своим, родным и светлым. Застольные песни, культура винограда, застывшие во времени целые кварталы – все это пришлось мне по душе и очень кстати. Сейчас... </div>
                  <a href="" class="comment__more">Подробнее</a>
                </div>
              </div>
            </div>
            <div class="flex-center">
              <a href="" class="cquide__comments-more btn-more">Показать еще</a>
            </div>
          </div>
          <div class="cguide__addcomment">
            <div class="cguide__title">Добавить отзыв</div>
            <form action="" class="form">
              <textarea name="" id="" cols="30" rows="10" placeholder="Введите текст отзыва..."></textarea>
              <div class="flex-right">
                <input type="submit" value="Отправить" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @include('partials/footer')

  @endsection