@extends('layouts.admin')

@section('title', 'Услуги гида')

@section('content')

<div class="card card-panel">
    <div class="card-body">
        <div class="title">Гиды</div>
        <div class="table-responsive">
            <table class="table b-table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle">Имя</th>
                        <th class="align-middle">Дата регистрации</th>
                        <th class="align-middle text-right">Управление</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr id="guide-list_{{$user->id}}" class="{{$user->active ? '' : 'table-secondary'}}">
                        <td class="d-flex align-items-center">
                            <img src="images/cguide/userpic.jpg" class="userpic-small rounded-circle mr-2" alt="Cinque Terre">
                            {{$user->name}}
                        </td>
                        <td class="align-middle">{{$user->created_at}}</td>
                        <td class="admin-btn align-middle">
                            <div class="d-flex justify-content-end">
                                
                                <form action="{{ route('admin.guide.show',['id' => $user->id]) }}" method="post">
                                    @method('POST')
                                    @csrf
                                    @if($user->active)
                                        <input type="hidden" name="active" value="0">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Отключить гида"><i class="fas fa-times"></i></button>
                                    @else
                                        <input type="hidden" name="active" value="1">
                                        <button type="submit" class="btn btn-sm btn-outline-success" data-toggle="tooltip" data-placement="top" title="Включить гида"><i class="fas fa-check"></i></button>
                                    @endif
                                </form>

                                <a href="{{ route('admin.guide.show',['id' => $user->id]) }}" class="btn btn-sm btn-outline-info ml-1" data-toggle="tooltip" data-placement="top" title="Редактировать гида"><i class="fas fa-pencil-alt"></i></a>
                                
                                <form action="{{ route('admin.guide.show',['id' => $user->id]) }}" method="POST" data-form="{{$user->id}}" data-action="confirm">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger ml-1" data-toggle="tooltip" data-placement="top" title="Удалить гида"><i class="far fa-trash-alt"></i></button>               
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalGuideConfirm" data-id>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Удалить?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <b-btn class="btn-blue" data-confirm-btn>Удалить</b-btn>
                        <b-btn class="btn-white ml-2" data-dismiss="modal">Отменить</b-btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection