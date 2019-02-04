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

        <section class="top pt-3 pb-3 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-2 col-lg-1">
                        <a href="/" class="logo">EG</a>
                    </div>
                    <div class="col-4 pt-3 d-none d-md-block">
                        <ul class="d-flex top-navigation ml-lg-4">
                            <li class="top-navigation__item">
                                <a href="" class="mr-4">О нас</a>
                            </li>
                            <li class="top-navigation__item">
                                <a href="">Обратная связь</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-7 align-self-center d-none d-md-block">
                        <div class="d-flex ml-auto">
                            <a href="" class="btn btn-blue btn-w9 f-regular ml-auto">Вход</a>
                            <a href="" class="btn btn-white btn-w9 f-regular ml-3">Регистрация</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="lk-panel mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <ul class="nav flex-column">
                            <li class="nav-item {{ (\Request::route()->getName() == 'admin.guide.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.guide.index') }}">Гиды</a>
                            </li>
                            <li class="nav-item {{ (\Request::route()->getName() == 'admin.services.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.services.index') }}">Услуги гидов</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Комментарии</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-9">
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
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
    <!-- END scripts -->
  </body>
</html>
