@extends('layouts.app')

@section('title', 'Профиль пользователя')
    
@section('content')
    
    <section class="profile mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <profile-avatar :name="'{{{ Auth::user()->name }}}'" :avatar="'{{ $data->avatar }}'"></profile-avatar>
                </div>
                <div class="col-12 col-md-9">

                    {{-- profile component --}}
                    <profile :data="{{ $json }}"></profile>
                    
                </div>
            </div>
        </div>
    </section>

    {{-- Include footer --}}
    @include('partials/footer')

@endsection