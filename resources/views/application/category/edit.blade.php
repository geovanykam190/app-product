@extends('adminlte::page')

@section('title', 'Categoria')

@section('content')

    {!! Form::model($category, ['url'=>route('categories.update', $category->id), 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
    <div class="card card-inside">

        <div class="card-create-header">
            <h2><i class="fas fa-list"></i> Edição de Categoria</h2>
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
                    <button class="btn btn-success">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop
