@extends('adminlte::page')

@section('title', 'Perfil')

@section('content')

    {!! Form::open(['url' => route('profile.store'), 'class' => 'form-horizontal']) !!}
    <div class="card card-inside">

        <div class="card-create-header">
            <h2><i class="fas fa-user-plus"></i> Cadastro de Perfil</h2>
        </div>
        <hr>
        <div class="card-create-body">
            @include("application.profile._form")
        </div>
        <hr>
        <div class="card-create-footer">
            <div class="row">
                <div class="col col-md-12 text-right">
                    <a href="{{route('profile.index')}}" class="btn btn-danger">Voltar</a>
                    <button class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop
