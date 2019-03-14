@extends('layouts.app')

@section('title', 'Профиль пользователя')
    
@section('content')
    
    <section class="profile mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 mb-5">
                    <div class="d-flex align-items-center profile-avatar">
                        <div class="profile-avatar__userpic mr-3 d-flex align-items-center">
                            <img src="{{ $data->avatar }}" alt="">
                        </div>
                    <div class="profile-avatar__name">{{ $data->name }} {{ $data->secondname }}</div>
                    </div>
                </div>
                <div class="col-12 col-md-9">

                    {{-- Список туров у гида --}}
                    <div class="card card-panel mb-5">
                        <div class="card-body">
                            <div class="title">Мои экскурсии</div>

                            <div class="row">
                                @foreach ($tours as $item)
                                    <div class="col-12 col-md-4 mb-4">
                                        <div class="tour-item border25">
                                            <a href="{{ route('tour-show', $data->id) }}" class="tour-item__cover d-block mb-2">
                                                <img src="{{ $item->cover }}" alt="" class="border25">
                                            </a>
                                            <a href="{{ route('tour-show', $data->id) }}" class="tour-item__title d-block mb-2">{{ $item->name }}</a>
                                            
                                            <div class="d-flex justify-content-between align-items-end">
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
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Include footer --}}
    @include('partials/footer')

@endsection