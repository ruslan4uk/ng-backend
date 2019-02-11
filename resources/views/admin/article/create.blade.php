@extends('layouts.admin')

@section('title', 'Услуги гида')

@section('content')

<div class="card card-panel">
    <div class="card-body">
        <div class="title position-relative">Статьи</div>
        <form action="" class="row">
            <div class="col-12">

                <div class="subtitle">Основная информация</div>

                <div class="form-group">
                    <input type="text" name="title" id="" 
                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                        value="{{ old('name') }}" placeholder="Заголовок">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <textarea type="text" name="content" id="ckeditor"
                        class="form-control{{ $errors->has('introtext') ? ' is-invalid' : '' }}" 
                        value="{{ old('introtext') }}" placeholder="Короткое описание"></textarea>
                    @if ($errors->has('introtext'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('introtext') }}</strong>
                        </span>
                    @endif
                </div>

                

            </div>
        </form>
    </div>
</div>

@endsection