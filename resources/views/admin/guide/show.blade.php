@extends('layouts.admin')

@section('title', 'Услуги гида')

@section('content')

<div class="card card-panel">
    <div class="card-body">
        <div class="title">Основная информация ({{$user->name}})</div>
        <guide-profile-show></guide-profile-show>
    </div>
</div>

@endsection