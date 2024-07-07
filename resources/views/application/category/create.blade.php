@extends('adminlte::page')

@section('title', 'Categorias')

@section('content')

    {!! Form::open(['url' => route('categories.store'), 'class' => 'form-horizontal']) !!}
    <div class="card card-inside">

        <div class="card-create-header">
            <h2><i class="fas fa-list"></i> Cadastro de Categoria</h2>
        </div>
        <hr>
        <div class="card-create-body">
            @include("application.category._form")
        </div>
        <hr>
        <div class="card-create-footer">
            <div class="row">
                <div class="col col-md-12 text-right">
                    <a href="{{route('categories.index')}}" class="btn btn-danger">Voltar</a>
                    <button class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop
