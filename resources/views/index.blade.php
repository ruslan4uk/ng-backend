@extends('layouts.main')

@section('title', 'Главная')

@section('content')

@include('partials/navigation', ['class' => 'top-main'])

<section class="main-head d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 offset-md-5">
                <div class="main-head__icon mb-4 mt-4"><img src="images/main/main-world.png" alt=""></div>
                <div class="main-head__title mb-4">Все совершенно просто!</div>
                <div class="main-head__subtitle">Выберите страну и начните путешествие прямо сейчас</div>
                <main-search></main-search>
            </div>
        </div>
    </div>
</section>

<a name="more"></a>
<section class="main-filter pt-5 mt-5 mb-5" id="more">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main-filter__title text-center mb-4">Что Вас интересует в данном регионе?</div>
            </div>
            <div class="col-12">
                <div class="main-filter__tabs">
                    <div class="main-filter__btn active" data-tab="1">
                        <div class="main-filter__icon"><i class="fas fa-camera-retro"></i></div>
                        <span>Экскурсии</span>
                    </div>
                    <div class="main-filter__btn" data-tab="2">
                        <div class="main-filter__icon"><i class="fas fa-bullhorn"></i></div>
                        <span>Гиды</span>
                    </div>
                    <div class="main-filter__btn" data-tab="3">
                        <div class="main-filter__icon"><i class="fas fa-gopuram"></i></div>
                        <span>Достопримечательности</span>
                    </div>
                    <div class="main-filter__btn" data-tab="4">
                        <div class="main-filter__icon"><i class="far fa-sun"></i></div>
                        <span>Погода</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-tabs main-tabs-1">
    <div class="container">
        <div class="row">
            @foreach ($tours as $item)
                <div class="col-12 col-md-4 mb-4">
                    <div class="tour-item border25">
                        <a href="{{ route('frontTour', $item->id) }}" class="tour-item__cover d-block mb-2">
                            <img src="{{ $item->cover }}" alt="" class="border25">
                        </a>
                        <a href="{{ route('frontTour', $item->id) }}" class="tour-item__title d-block mb-2">{{ $item->name }}</a>
                        
                        <div class="tour-item__guide d-flex align-items-center">
                            <a href="{{ route('frontGuide', $item->user_id) }}" class="tour-item__avatar mr-2">
                                @if ($item->user_data->avatar)
                                    <img src="{{ $item->user_data->avatar }}" alt="">
                                @endif
                            </a>
                            <a href="{{ route('frontGuide', $item->user_id) }}" class="tour-item__name">
                                {{ $item->user_data->name }} {{ $item->user_data->secondname }}
                            </a>
                            
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="tour-item__timing">4-5 часов</div>
                            <div class="tour-item__price">
                                от
                                <span>
                                    {{ $item->price }} 
                                    @switch($item->currency)
                                        @case(1)
                                            Р
                                            @break
                                        @case(2)
                                            USD
                                            @break
                                    @endswitch
                                </span>
                                с группы
                            </div>
                            <a href="{{ route('frontTour', $item->id) }}" class="tour-item__more btn btn-sm btn-gradient">Подробнее</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section class="main-tabs main-tabs-2 d-none">
    <div class="container">
        <div class="row">
            @if (count($guides) > 0)
                @foreach ($guides as $guide_item)
                    <div class="col-12 mb-4">
                        <div class="guide-item">
                            <div class="guide-item__avatar">
                                @if (isset($guide_item->userdata->avatar))
                                    <img src="{{ $guide_item->userdata->avatar }}" class="border25">
                                @endif
                            </div>
                            <div class="guide-item__right border25">
                                <div class="guide-item__name">{{ $guide_item->userdata->name }}</div>
                                <div class="guide-item__count-tour">{{ count($guide_item->tour) }} экскурсия</div>
                                <div class="guide-item__about">{{ mb_substr($guide_item->userdata->about, 0, 300) }}</div>
                                <a href="{{ route('frontGuide', $guide_item->id) }}" class="guide-item__more">
                                    Подробнее
                                    <span class="guide-item__more-icon"><i class="fas fa-angle-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>                
                @endforeach
            @endif
        </div>
    </div>
</section>

<section class="main-tabs main-tabs-3 d-none">
    <div class="container">
        <div class="row">
            Тексты
        </div>
    </div>
</section>

<section class="main-tabs main-tabs-4 d-none">
    <div class="container">
        <div class="row">
            Погода
        </div>
    </div>
</section>

<section class="mb-5"></section>
    
@endsection