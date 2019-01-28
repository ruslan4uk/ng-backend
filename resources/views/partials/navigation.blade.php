<div class="navigation {% if navigation %}navigation--revers{% endif %}">
        <div class="navigation__wrap">
            <a href="" class="navigation__logo">
                <div class="logo">EG</div>
            </a>
            {{-- {% if nav %} --}}
            <ul class="navigation__list">
                <li class="navigation__item">
                    <a href="about.html" class="navigation__link">О нас</a>
                </li>
                <li class="navigation__item">
                    <a href="callback.html" class="navigation__link">Обратная связь</a>
                </li>
            </ul>
            <div class="navigation__right">
                <a href="{{ route('login') }}" class="btn btn--white">Вход</a>
                <a href="{{ route('register') }}" class="btn btn--blue btn--ml">Регистрация</a>
            </div>
            {{-- {% endif %} --}}
        </div>
    </div>