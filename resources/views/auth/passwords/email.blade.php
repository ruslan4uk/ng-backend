@extends('layouts.app')

@section('title', 'Логин')

@section('content')

    <section class="auth">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-12 col-md-6 d-none d-md-block">
                    <img src="{{ asset('images/op/login.png') }}" alt="" class="op__poster" />
                </div>
                <div class="col-12 col-md-5">
                    <div class="title">Забыли пароль?</div>
                    <div class="subtitle">Мы с радостью его напомним</div>
                    <form method="POST" action="{{ route('password.email') }}" class="mt-3">
                        @csrf

                        <div class="form-group">
                            <input 
                                id="email" 
                                type="text" 
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="Введите Ваш эл.адрес" 
                                required autofocus />
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group text-right mb-4">
                            <a href="{{ route('login') }}" class="form-forgot-password">Авторизоваться</a>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="ОК!" class="btn btn-block btn-gradient-reg" />
                        </div>
                    </form>    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
