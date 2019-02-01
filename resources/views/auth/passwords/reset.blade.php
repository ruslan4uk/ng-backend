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
                    <div class="op__title">Смена пароля</div>
                    <div class="op__subtitle">Создайте новый пароль</div>

                    <form method="POST" action="{{ route('password.update') }}" class="op__form form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form__group">
                            <input 
                                    id="email" 
                                    type="text" 
                                    class="{{ $errors->has('email') ? ' is-invalid' : '' }}" 
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
                                    class="{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                    placeholder="Введите новый пароль"
                                    name="password" required />

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
                                    class="" 
                                    placeholder="Повторите пароль"
                                    name="password_confirmation" required />
                        </div>

                        <a href="{{ route('login') }}" class="form__forgot-password">Авторизоваться</a>
                        <div class="form__group">
                            <input type="submit" value="ОК!" class="btn btn--gh op__btn" />
                        </div>
                    </form>
                
                </div>
            </div>
        </div>
    </section>
@endsection
