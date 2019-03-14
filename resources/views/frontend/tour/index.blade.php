@extends('layouts.app')

@section('title', 'Профиль пользователя')
    
@section('content')

    <section class="tour mt-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 pr-md-5 mb-4">
                    <div class="card card-panel tour-guide-column mb-5">
                        <div class="card-body">
                            <div class="title mb-3">Гид</div>

                            <div class="tour-guide-column__name-avatar mb-3">
                                <a href="{{ route('frontGuide', $guide->id) }}" class="tour-guide-column__avatar">
                                    <img src="{{ $guide_data->avatar }}" class="border25">
                                </a>
                                
                                <a href="{{ route('frontGuide', $guide->id) }}" class="tour-guide-column__name">
                                    <p>{{ $guide_data->name }}</p>
                                    <p>{{ $guide_data->secondname }}</p>
                                </a>
                            </div>
                            
                            {{-- Услуги --}}
                            <div class="guide__services mb-3">
                                <div class="guide__subtitle">Услуги</div>
                                <div class="guide__services-list">
                                    @foreach (json_decode($guide_data->services) as $service)
                                        @switch($service)
                                            @case(1)
                                                Частный гид
                                                @break
                                            @case(2)
                                                Туристическая компания
                                                @break
                                            @case(3)
                                                Трансфер
                                                    @break
                                            @case(4)
                                                Аренда авто/яхт
                                                    @break
                                            @case(5)
                                                Организация мероприятий
                                                    @break
                                            @case(6)
                                                Услуги перевода
                                                    @break
                                            @case(7)
                                                Шоппинг
                                                @break
                                        @endswitch
                                    @endforeach
                                </div>
                            </div>

                            {{-- Контакты --}}
                            <div class="tour-guide-column__contact mb-3">
                                <div class="guide__subtitle">Контакты</div>
                                <div class="tour-guide-column__contact-list">
                                    <div class="tour-guide-column__contact-item">
                                        <div class="tour-guide-column__contact-icon">
                                            <i class="fas fa-map-marker-alt"></i> 
                                        </div>
                                        <span>{{ $city->city }}, {{ $city->country_name }}</span>
                                    </div>
                                    <div class="tour-guide-column__contact-item">
                                        <div class="tour-guide-column__contact-icon">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        <span>{{ $guide->email }}</span>
                                    </div>
                                </div>

                                @foreach (json_decode($guide_data->contact) as $phone)
                                    <div class="tour-guide-column__contact-item">
                                        <div class="tour-guide-column__contact-icon">
                                                <i class="fas fa-phone"></i>
                                        </div>
                                        <span>{{ $phone->value }}</span>
                                    </div>
                                @endforeach
                                
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Right side --}}
                <div class="col-12 col-md-8">
                    <div class="tour__title mb-4">{{ $tour->name }}</div>
                    <div class="tour__cover">
                        <img src="{{ $tour->cover_big }}" alt="" class="border25">
                    </div>

                    {{-- Card --}}
                    <div class="card card-panel tour__right-card mb-5 border25">
                        <div class="card-body">
                            <div class="tour-block mb-3">
                                <div class="tour-block__left">
                                    <div class="tour-block__list d-flex">
                                        <div class="tour-block__item mr-3">
                                            <div class="tour-block__icon"><i class="far fa-clock"></i></div>
                                            <div class="tour-block__text">??? часов</div>
                                        </div>
                                        <div class="tour-block__item mr-3">
                                            <div class="tour-block__icon"><i class="fas fa-users"></i></div>
                                            <div class="tour-block__text">{{ $tour->member_count }} человек</div>
                                        </div>
                                        <div class="tour-block__item mr-3">
                                            <div class="tour-block__icon"><i class="far fa-money-bill-alt"></i></div>
                                            <div class="tour-block__text">{{ $tour->price }} руб.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tour__about">{{ $tour->about }}</div>
                        </div>
                    </div>

                    {{-- tour order btn --}}
                    <div class="d-flex justify-content-center">
                        <div class="tour__order-btn mb-5" data-toggle="modal" data-target="#order">Заказать экскурсию</div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    {{-- modal window order --}}
    <div class="modal fade" id="order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заказ экскурсии</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Ваше имя">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Ваш телефон">
                    </div>
                    <div class="form-group">
                        <input type="text" сlass="form-control" placeholder="Ваша почта">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-blue">Заказать</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Include footer --}}
    @include('partials/footer')

@endsection