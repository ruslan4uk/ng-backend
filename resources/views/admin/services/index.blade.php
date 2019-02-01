@extends('layouts.admin')

@section('title', 'Услуги гида')

@section('content')

<div>
    <services-table></services-table>
</div>

<div class="lk__card mb-3">
    <div class="lk__title">Управление услугами гидов</div>

    @if (session('message'))
        <div class="alert alert--success mb-3" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="table-flex-guide mb-2">
        <div class="table-flex-guide__header">
            <div class="table-flex-guide__row">
                <div class="table-flex-guide__col table-flex-guide__col--name">Название</div>
                <div class="table-flex-guide__col table-flex-guide__col--createdon">Описание</div>
                <div class="table-flex-guide__col table-flex-guide__col--btns"></div>
            </div>
        </div>

        @foreach($services as $service )
            <div class="table-flex-guide__body">
                <div class="table-flex-guide__row">
                    <div class="table-flex-guide__col table-flex-guide__col--name">
                        <div class="user-pic lk__userpic">
                            <div class="user-pic__name"> {{ $service->title }} </div>
                        </div>
                    </div>
                    <div class="table-flex-guide__col table-flex-guide__col--createdon"> {{ $service->description }} </div>
                    <div class="table-flex-guide__col table-flex-guide__col--btns admin__btns admin__btns--end">
                        <a href="{{ route('admin.services.edit', ['id', $service->id]) }}" class="admin__btn admin__btn--edit">Редактировать</a>
                        <form action="{{ route('admin.services.destroy', [$service->id]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="admin__btn admin__btn--delete">Удалить</button>
                        </form>
                    </div>
                </div>  
            </div>
        @endforeach

    </div>

    <a href="{{ route('admin.services.create') }}" class="btn btn--blue">Добавить</a>

</div>

@endsection