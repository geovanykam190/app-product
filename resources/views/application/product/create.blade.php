@extends('adminlte::page')

@section('title', 'Produtos')

@section('content')

    {!! Form::open(['url' => route('products.store'), 'class' => 'form-horizontal']) !!}
    <div class="card card-inside">

        <div class="card-create-header">
            <h2><i class="fas fa-shop"></i> Cadastro de Produto</h2>
        </div>
        <hr>
        <div class="card-create-body">
            @include("application.product._form")
        </div>
        <hr>
        <div class="card-create-footer">
            <div class="row">
                <div class="col col-md-12 text-right">
                    <a href="{{route('products.index')}}" class="btn btn-danger">Voltar</a>
                    <button class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@stop
