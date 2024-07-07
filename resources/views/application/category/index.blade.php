@extends('adminlte::page')

@section('title', 'Categorias')



@section('content')

    @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade in show m-2" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade in show m-2" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-inside">
         <div class="card-create-header">
            <h2><i class="fas fa-list"></i> Lista de Categorias</h2>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Status</th>
                    <th scope="col"> 
                        <a href="/application/categories/create"> 
                            <span class="text-success icons-actions" title="Adicionar Produto">
                                <i class="fas fa-plus"></i> 
                            </span>
                        </a> 
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists AS $list)
                <tr>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->status == 1 ? 'Ativo' : 'Inativo'}}</td>
                    <td class="max-wid-200">
                        <a href="/application/categories/{{ $list->id }}/edit/"> 
                            <span class="text-info icons-actions" title="Editar Categorias">
                                <i class="fas fa-edit"></i>
                            </span>
                        </a> 
                        <form action="{{ route('categories.destroy', $list->id)}}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <span class="text-danger icons-actions" title="Deletar Categoria" onclick="confirmSend(this, 'Categoria')"><i class="fas fa-times"></i></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

