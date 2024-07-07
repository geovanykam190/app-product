@extends('adminlte::page')

@section('title', 'Usuários')

@section('content')

    {!! Form::model($user, ['url'=>route('users.update', $user->id), 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
    <div class="card card-inside">

        <div class="card-create-header">
            <h2><i class="fas fa-user-plus"></i> Edição de Usuário</h2>
        </div>
        <hr>
        <div class="card-create-body">
            @include("application.user._form")
        </div>
        <hr>
        <div class="card-create-footer">
            <div class="row">
                <div class="col col-md-12 text-right">
                    <a href="{{route('users.index')}}" class="btn btn-danger">Voltar</a>
                    <button class="btn btn-success">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop
