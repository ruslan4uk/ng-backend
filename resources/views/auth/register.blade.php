@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')

  <section class="auth">
      <div class="container">
          <div class="row justify-content-between  align-items-center">
              <div class="col-12 col-md-7 d-none d-md-block">
                  <img src="{{ asset('images/op/register.png') }}" alt="" class="op__poster" />
              </div>
              <div class="col-12 col-md-5">
                  <div class="title">Сделайте первый шаг!</div>
                  <div class="subtitle">И откройте много нового с сервисом</div>
                  <form method="POST" action="{{ route('register') }}" class="mt-3">
                      @csrf

                      <div class="form-group">
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

                      <div class="form-group">
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

                      <div class="form-group">
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

                      <div class="form-group">
                          <input 
                            id="password-confirm" 
                            type="password" 
                            class="form-control" 
                            name="password_confirmation" required
                            placeholder="Повторите пароль" />
                      </div>

                      <div class="form-group">
                            <div class="form-radio form-check-inline">
                                <input name="role" type="radio" value="tourist" id='role_1' {{ old('role') == 0 ? 'checked' : '' }} />
                                <label for="role_1" class="mb-0">Я турист</label>
                            </div>
                            <div class="form-radio form-check-inline">
                                <input name="role" type="radio" value="guide" id='role_2' {{ old('role') == 1 ? 'checked' : '' }} />
                                <label for="role_2" class="mb-0">Я гид</label>
                            </div>

                            <div class="form__radio">
                                
                            </div>
                            <div class="form__radio">
                                
                            </div>
                            @if ($errors->has('role'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                      </div>

                      <div class="form-group">
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

                      <div class="form-group">
                            <div class="form-check-inline form-check">
                                <input type="checkbox" name="personal-data" class="form-check-input" id="personal-data" {{ old('personal-data') ? 'checked' : '' }} />
                                <label for="personal-data" class="form-check-label"> Согласие на обработку персональных данных </label>
                            
                            </div>
                            @if ($errors->has('personal-data'))
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('personal-data') }}</strong>
                                </div>
                            @endif
                      </div>

                      <div class="form-group">
                          <input type="submit" value="НАЧИНАЕМ!" class="btn btn-block btn-gradient-reg" />
                      </div>
                      
                  </form>    
                  <div class="auth-social mb-4 mt-1">
                      <div class="d-md-flex align-items-center text-center text-md-left">
                          <p class="mb-3 mb-md-0">Вы также можете войти через</p>
                          <div class="d-flex pl-md-4 justify-content-center justify-content-md-start">
                              <div class="auth-social-btn">
                                  <a href="{{ route('oAuth', ['provider' => 'vkontakte']) }}" class="op__social-link"><img src="{{ asset('images/op/vk.png') }}" alt="" /></a>
                              </div>
                              <div class="auth-social-btn">
                                  <a href="" class="op__social-link"><img src="{{ asset('images/op/ok.png') }}" alt="" /></a>
                              </div>
                              <div class="auth-social-btn">
                                  <a href="{{ route('oAuth', ['provider' => 'facebook']) }}" class="op__social-link"><img src="{{ asset('images/op/fb.png') }}" alt="" /></a>
                              </div>
                          </div>
                      </div>
                  </div>
                  @if (session('error'))
                      <div class="alert alert-danger" role="alert">
                      Перед авторизацией через соц.сети необходимо <a href="{{ route('register') }}">зарегистрироваться</a>
                      </div>
                  @endif
              </div>
          </div>
      </div>
  </section>

@endsection