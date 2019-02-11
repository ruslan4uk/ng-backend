@extends('layouts.admin')

@section('title', 'Услуги гида')

@section('content')

<div>
    <giude-profile-index :user="{{$user->id}}"></giude-profile-index>
</div>

@endsection