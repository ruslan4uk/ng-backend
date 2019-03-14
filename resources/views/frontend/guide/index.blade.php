@extends('layouts.app')

@section('title', 'Профиль пользователя')
    
@section('content')

    <section class="guide mt-5">
        <div class="container">
            @if (isset($guide))
                <div class="row">
                    <div class="col-12 col-md-3 pr-md-5 mb-4">
                        <div class="guide__avatar mb-2">
                            <img src="{{ $guide->avatar }}" alt="" class="border25">
                        </div>
                        <div class="guide__name mb-2 pr-2 pl-2">
                            {{ $guide->name }} {{ $guide->secondname }}
                        </div>

                        <div class="d-flex justify-content-between pl-2 pr-2 mb-4">
                            <div class="guide__like">
                                <i class="fas fa-heart"></i>
                                <span>285</span>
                            </div>
                            <div class="guide__comment-count">
                                <i class="fas fa-comment-alt"></i>
                                <span>285</span>
                            </div>
                        </div>

                        <div class="guide__language mb-3">
                            <div class="guide__subtitle">Владение языками</div>
                            <div class="guide__language-list">
                                @foreach (json_decode($guide->language) as $lang)
                                    {{ $lang->value }},
                                @endforeach
                            </div>
                        </div>

                        <div class="guide__services mb-3">
                            <div class="guide__subtitle">Услуги</div>
                            <div class="guide__services-list">
                                @foreach (json_decode($guide->services) as $service)
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

                    </div>

                    <div class="col-12 col-md-9">
                        <div class="card card-panel mb-5">
                            <div class="card-body">
                                <div class="title mb-2">Обо мне</div>
                                <div class="guide__about mb-5">
                                    <p>{{ $guide->about }}</p>
                                </div>
                                
                                <div class="title mb-2">Основные контакты</div>
                                <div class="guide__contact-info mb-4">
                                    <guide-contact :contact="{{ $guide->contact }}" 
                                            :other_contact="{{ $guide->other_contact }}"
                                            :city="{{ $guide->city }}"
                                            :email="'{{ $email }}'"></guide-contact>
                                </div>
                                
                                <div class="title mb-3">Экскурсии</div>
                                <div class="row">
                                    @foreach ($tour as $item)
                                        <div class="col-6 col-md-3">
                                            <a href="{{ route('frontTour', $item->id) }}">
                                                <img src="{{ $item->cover }}" alt="" class="border25 mb-2">
                                            </a>
                                            <a href="" class="guide__tour-title">{{ $item->name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                                
                            </div>
                        </div>

                        {{-- comment --}}
                        <div class="card card-panel mb-5">
                            <div class="card-body">
                                <div class="title mb-3">Комментарии</div>
                                <div class="comment">

                                    <div class="comment__list">
                                        @if (count($comments) > 0)
                                            @foreach ($comments as $item)
                                                <div class="comment__item align-items-center align-items-md-start">
                                                    <div class="comment__avatar">
                                                        <img src="{{ $item->user_data->avatar }}" class="border25">
                                                    </div>
                                                    <div class="comment__right">
                                                        <div class="comment__name">{{ $item->user_data->name }} {{ $item->user_data->secondname }}</div>
                                                        <div class="comment__date">{{ $item->created_at->format('d.m.Y') }}</div>
                                                        <div class="comment__text d-none d-md-block">
                                                            {{ $item->text }}
                                                        </div>
                                                    </div>
                                                    <div class="comment__text d-md-none mt-3">{{ $item->text }}</div>
                                                </div>
                                            @endforeach
                                        @else 
                                            <p>Пока комментариев нет</p>
                                        @endif
                                    </div>
                                    
                                    @auth
                                        {{-- new comment --}}
                                        <div class="comment__new">
                                            <form action="{{ route('addComment', $guide->id) }}" method="POST">
                                                @csrf
                                                <div class="title mb-3">Добавить комментарий</div>
                                                <div class="form-group">
                                                    <textarea name="comment" cols="30" rows="10" class="form-control" placeholder="Текст комментария"></textarea>
                                                </div>
                                                <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-sm btn-blue">Отправить</button>
                                                </div>
                                                @if(session('success'))
                                                    <div class="alert alert-success">
                                                        {{session('success')}}
                                                    </div>
                                                @endif

                                                @if(session('error'))
                                                    <div class="alert alert-danger">
                                                        {{session('error')}}
                                                    </div>
                                                @endif
                                                
                                            </form>
                                        </div>
                                        {{-- end new comment --}}
                                    @endauth

                                </div>
                            </div>
                        </div>
                        {{-- end comment --}}

                    </div>

                </div>    
            @endif
        </div>
    </section>
    
    {{-- Include footer --}}
    @include('partials/footer')

@endsection