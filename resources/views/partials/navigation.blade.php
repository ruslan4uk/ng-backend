<section class="top pt-3 pb-3 {{$class}} {{ (Request::is('guide/*') ? ' top--blue' : '') }}">
    <div class="container">
        <div class="row">
            <div class="col-2 col-lg-1">
                <a href="/" class="logo">EG</a>
            </div>
            <div class="col-4 pt-3 d-none d-md-block">
                <ul class="d-flex top-navigation ml-lg-4">
                    <li class="top-navigation__item">
                        <a href="{{ route('about') }}" class="mr-4">О нас</a>
                    </li>
                    <li class="top-navigation__item">
                        <a href="">Обратная связь</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-lg-7 align-self-center ml-auto">
                <div class="d-flex ml-auto">
                    @if (isset($data))
                        @auth
                            <navigation-toogle :name="'{{{ Auth::user()->name }}}'" :avatar="'{{$data->avatar}}'"></navigation-toogle>
                        @endauth
                    @endif
                    
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-blue btn-w9 f-regular ml-auto">Вход</a>
                        <a href="{{ route('register') }}" class="btn btn-white btn-w9 f-regular ml-3">Регистрация</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

@if (Request::is('guide/*'))
    <section class="top-blue-line">
        
    </section>
@endif