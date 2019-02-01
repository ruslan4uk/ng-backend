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
                    <div class="op__title">Забыли пароль?</div>
                    <div class="op__subtitle">Мы с радостью его напомним</div>

                    <form method="POST" action="{{ route('password.email') }}" class="op__form form">
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
                        <a href="{{ route('login') }}" class="form__forgot-password">Авторизоваться</a>
                        <div class="form__group">
                            <input type="submit" value="ОК!" class="btn btn--gh op__btn" />
                        </div>
                    </form>
                
                    @if (session('status'))
                        <div class="text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
