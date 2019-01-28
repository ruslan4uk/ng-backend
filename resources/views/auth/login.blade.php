@extends('layouts.app')

@section('title', 'Логин')

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
                    <a href="" class="form__forgot-password">Забыли пароль?</a>
                    <div class="form__group">
                        <input type="submit" value="ОК!" class="btn btn--gh op__btn" />
                    </div>
                </form>
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
