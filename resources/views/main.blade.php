@extends('layouts.app')

@section('title', 'Главная')


@section('content')
    <section class="main">
        <div class="container">

            {{-- Navigation include --}}
            @include('partials/navigation')

            <div class="main__content">
                <svg class="main__icon"><use xlink:href="{{ asset('images/sprite.svg#icon-main') }}"></use></svg>
                <div class="main__title">Все совершенно просто!</div>
                <div class="main__subtitle">Выберите страну и начните путешествие прямо сейчас</div>
                <!-- search -->
                <div class="search">
                    <form action="" class="search__form">
                        <div class="search__group">
                            <input type="text" class="search__input" placeholder="Ба" />
                            <input type="submit" class="search__button" value="От винта!" />
                            <div class="search__country">
                                <img src="{{ asset('images/main/flag.png') }}" alt="" />
                            </div>

                            
                            <div class="search__ac ac">
                                <div class="ac__list">

                                    @php
                                        $collection = array(1,2,3,4)
                                    @endphp
                                    @foreach ($collection as $collections)
                                        <a href="" class="ac__item">
                                            <div class="ac__flag">
                                                <img src="{{ asset('images/main/flag.png') }}" alt="" />
                                            </div>
                                            <div class="ac__country">Барселона, Испания</div>
                                        </a>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials/subnavigation')

    <section class="mcontent">
        <div class="container">
            <div class="mcontent__title">Нашлось 800 достопримечательностей в Риме</div>
            <div class="mcontent__wrap active" data-main-tab="1">

                {{-- {# Экскурсии #} --}}
                @php 
                    $tour = array(1,2,3,4,5)
                @endphp 
                @foreach ($tour as $item)
                    @include('partials/block/tour')
                @endforeach

            </div>

            {{-- <div class="mcontent__wrap" data-main-tab="2">
                {# Гиды #}
                {% for i in [1,2,3,4,5] %}
                    {% include "partials/blocks/_guide.html" %}
                {% endfor %}
            </div>

            <div class="mcontent__wrap" data-main-tab="3">
                {# Достопримечательности #}
                {% for i in [1,2,3,4,5] %}
                    {% include "partials/blocks/_sights.html" %}
                {% endfor %}
            </div> --}}

        </div>
    </section>

    {{-- footer --}}
    @include('partials/footer')

@endsection