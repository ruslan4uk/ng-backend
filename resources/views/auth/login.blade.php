@extends('layouts.app')

@section('title', 'Логин')

@section('content')
    
    @include('partials.navigation')

    <section class="auth">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-md-6 d-none d-md-block">
                    <img src="{{ asset('images/op/login.png') }}" alt="" class="op__poster" />
                </div>
                <div class="col-12 col-md-5">
                    <div class="title">Поехали!</div>
                    <div class="subtitle">Мы рады Вашему возвращению</div>
                    <form method="POST" action="{{ route('login') }}" class="mt-3">
                        @csrf

                        <div class="form-group">
                            <input 
                                id="email" 
                                type="text" 
                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email"   
                                value="{{ old('email') }}" 
                                placeholder="Введите Ваш логин или эл.адрес" 
                                required autofocus />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group mb-1">
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
                        <div class="form-group text-right mb-4">
                            <a href="{{ route('password.request') }}" class="form-forgot-password">Забыли пароль?</a>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="ОК!" class="btn btn-block btn-gradient" />
                        </div>
                    </form>    
                    <div class="auth-social mb-4">
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
{{-- 
        <section class="op">
        <div class="container">
            <div class="op__wrap">
                <div class="op__left">
                    <img src="{{ asset('images/op/login.png') }}" alt="" class="op__poster" />
                </div>
                <div class="op__right">
                    <div class="op__title">Поехали!</div>
                    <div class="op__subtitle">Мы рады Вашему возвращению</div>

                    <form method="POST" action="{{ route('login') }}" class="op__form form">
                        @csrf
                        <div class="form__group">
                            <input 
                                    id="email" 
                                    type="text" 
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                    name="email"   
                                    value="{{ old('email') }}" 
                                    placeholder="Введите Ваш логин или эл.адрес" 
                                    required autofocus />

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
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
                        <a href="{{ route('password.request') }}" class="form__forgot-password">Забыли пароль?</a>
                        <div class="form__group">
                            <input type="submit" value="ОК!" class="btn btn--gh op__btn" />
                        </div>
                    </form>
                    <div class="op__social">
                        <div class="op__social-text">Вы также можете войти через</div>
                        <div class="op__social-item">
                        <a href="{{ route('oAuth', ['provider' => 'vkontakte']) }}" class="op__social-link"><img src="{{ asset('images/op/vk.png') }}" alt="" /></a>
                        </div>
                        <div class="op__social-item">
                        <a href="" class="op__social-link"><img src="{{ asset('images/op/ok.png') }}" alt="" /></a>
                        </div>
                        <div class="op__social-item">
                        <a href="{{ route('oAuth', ['provider' => 'facebook']) }}" class="op__social-link"><img src="{{ asset('images/op/fb.png') }}" alt="" /></a>
                        </div>
                    </div>
                   
                    @if (session('error'))
                        <div class="text-center" role="alert">
                        Перед авторизацией через соц.сети необходимо <a href="{{ route('register') }}">зарегистрироваться</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section> --}}
@endsection
