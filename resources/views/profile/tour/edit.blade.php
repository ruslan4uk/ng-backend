@extends('layouts.app')

@section('title', 'Профиль пользователя')
    
@section('content')
    
    <section class="profile mt-5 mb-5">
        <div class="container">
            
            {{-- profile component --}}
            <tour :data="{{ $json }}"></tour>
            
        </div>
    </section>

    {{-- Include footer --}}
    @include('partials/footer')

@endsection