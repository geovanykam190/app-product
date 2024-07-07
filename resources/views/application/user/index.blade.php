@extends('adminlte::page')

@section('title', 'Usuários')



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
            <h2><i class="fas fa-user"></i> Lista de Usuários</h2>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Perfil</th>
                    <th scope="col"> 
                        <a href="/application/users/create"> 
                            <span class="text-success icons-actions" title="Adicionar Usuário">
                                <i class="fas fa-user-plus"></i> 
                            </span>
                        </a> 
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($lists AS $list)
                <tr>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->profile->name ?? " - " }}</td>
                    <td class="max-wid-200">
                        <a href="/application/users/{{ $list->id }}/edit/"> 
                            <span class="text-info icons-actions" title="Editar Usuário">
                                <i class="fas fa-user-edit"></i>
                            </span>
                        </a> 
                        <form action="{{ route('users.destroy', $list->id)}}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <span class="text-danger icons-actions" title="Deletar Usuário" onclick="confirmSend(this, 'Usuário')"><i class="fas fa-user-times"></i></span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

