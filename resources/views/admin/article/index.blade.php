@extends('layouts.admin')

@section('title', 'Услуги гида')

@section('content')

<div class="card card-panel">
    <div class="card-body">
        <div class="title position-relative">Статьи <a href="{{ route('admin.article.create') }}" class="btn btn-outline-success admin-btn btn-new"><i class="fas fa-plus"></i></a></div>

    </div>
</div>

@endsection