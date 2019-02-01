<!doctype html>
<html>
  <head>
    <base href="/" />
    <meta charset="utf-8"/>
    <title>@yield('title') - EG </title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#fff"/>
    <meta name="format-detection" content="telephone=no"/>
    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" media="all" href="{{ asset('/css/app.css') }}"/>
  </head>
  <body>
    <!-- BEGIN content -->
    <div class="app" id="app">

        <section class="top">
            <div class="container">
                <div class="navigation navigation--revers">
                    <div class="navigation__wrap">
                        <a href="page.html" class="navigation__logo">
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
                <div class="lk__wrap">
                    {{-- Admin Navigation --}}
                    <div class="lk__left mb-2">
                        <div class="lk__left-nav">
                            <ul>
                                <li class="active"><a href="#">Гиды</a></li>
                                <li><a href="{{ route('admin.services.index') }}">Услуги гидов</a></li>
                                <li><a href="#">Комментарии</a></li>
                            </ul>
                        </div>
                    </div>
                    {{-- End admin  navigation --}}

                    <div class="lk__right">

                        @yield('content')
                        
                    </div>
                            
                </div>
            </div>
        </section>
                
        {{-- Footer include --}}
        @include('partials/footer')
        
    </div>
    <!-- END content -->

    <!-- BEGIN scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <!-- END scripts -->
  </body>
</html>
