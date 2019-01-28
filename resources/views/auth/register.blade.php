@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <section class="top">
        <div class="container">
          <div class="navigation navigation--revers">
            <div class="navigation__wrap">
              <a href="" class="navigation__logo">
                <div class="logo">EG</div>
              </a>
            </div>
          </div>
        </div>
      </section>
      <section class="op">
        <div class="container">
          <div class="op__wrap">
            <div class="op__left op__left--register">
              <img src="{{ asset('images/op/register.png') }}" alt="" class="op__poster" />
            </div>
            <div class="op__right">
              <div class="op__title">Сделайте первый шаг!</div>
              <div class="op__subtitle">И откройте много нового с сервисом</div>

              {{-- Form --}}
              <form method="POST" action="{{ route('register') }}" class="op__form form">
                  @csrf
                <div class="form__group">
                  <input 
                        id="name" 
                        type="text" 
                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                        name="name" 
                        value="{{ old('name') }}" required autofocus
                        placeholder="Введите Ваше имя" />
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__group">
                  <input 
                        id="login" 
                        type="text" 
                        class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}" 
                        name="login" 
                        value="{{ old('login') }}" required autofocus
                        placeholder="Придумайте логин" />
                    @if ($errors->has('login'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('login') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__group">
                  <input 
                        id="password" 
                        type="password" 
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                        name="password" required 
                        placeholder="И пароль" />
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__group">
                    <input 
                        id="password-confirm" 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" required
                        placeholder="Повторите пароль" />
                </div>
                <div class="form__group">
                  <div class="form__radio-group">
                    <div class="form__radio">
                      <input name="status" type="radio" value="0" id='status_1' {{ old('status') == 0 ? 'checked' : '' }} />
                      <label for="status_1" class="form__label form__label--blue">Я турист</label>
                    </div>
                    <div class="form__radio">
                      <input name="status" type="radio" value="1" id='status_2' {{ old('status') == 1 ? 'checked' : '' }} />
                      <label for="status_2" class="form__label form__label--blue">Я гид</label>
                    </div>
                  </div>
                    @if ($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__group">
                  <input 
                        id="email" 
                        type="text" 
                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                        name="email" 
                        value="{{ old('email') }}" required 
                        placeholder="И напоследок Ваш эл.адрес для подтверждения регистрации" />
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form__group form__custom-checkbox">
                  <input type="checkbox" name="personal-data" id="personal-data" {{ old('personal-data') ? 'checked' : '' }} />
                  <label for="personal-data" class="form__label"> Согласие на обработку персональных данных </label>
                  @if ($errors->has('personal-data'))
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('personal-data') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form__group">
                  <input type="submit" value="Начинаем!" class="btn btn--gh op__btn" />
                </div>
              </form>
              {{-- End form --}}

              <div class="op__social">
                <div class="op__social-text">Вы также можете войти через</div>
                <div class="op__social-item">
                  <a href="" class="op__social-link"><img src="{{ asset('images/op/vk.png') }}" alt="" /></a>
                </div>
                <div class="op__social-item">
                  <a href="" class="op__social-link"><img src="{{ asset('images/op/ok.png') }}" alt="" /></a>
                </div>
                <div class="op__social-item">
                  <a href="" class="op__social-link"><img src="{{ asset('images/op/fb.png') }}" alt="" /></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection