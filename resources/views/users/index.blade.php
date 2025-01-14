@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1 class="m-0 text-dark">Usuários</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('home.users.index') }}" method="GET">
                <div class="card card-warning card-outline">
                    <div class="card-header bg-transparent">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Nome/E-mail" value="{{ $params['search'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-warning btn-overlay"><i class="fa fa-search"></i>&nbsp; Filtrar</button>
                                &nbsp;
                                <a href="{{ route('home.users.create') }}" class="btn btn-default text-dark"><i class="fa fa-user-plus"></i>&nbsp; Cadastrar Usuário</a>

                            </div>
                        </div>
                    </div>

                    <div class="card-body overflow-y">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Perfil</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ __('profiles.' . $user->permission[0]->name) }}</td>
                                        <td>{!! \App\TypeLabels\ActiveValue::label($user->active) !!}</td>
                                        <td style="width: 1%" nowrap="nowrap">
                                            <a href="{{ route('home.users.edit', ['id' => $user->id]) }}" class="btn btn-default btn-xs" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                                            &nbsp;
                                            <a href="#" class="btn btn-danger btn-xs btn-overlay" data-id="{{ $user->id }}" title="Excluir" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-ban"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Não há dados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        {{ \App\Helpers\PaginateHelper::paginateWithParams($users, $params) }}
                    </div>

                    @include('util.overlay')
                </div>
            </form>
        </div>

        @include('util.delete-modal')
    </div>
@stop

@section('js')
    <script src="{{ asset('js/delete-modal.js') }}"></script>
    <script src="{{ asset('js/form-errors.js') }}"></script>
    <script type="text/javascript">
        deleteModal('users/delete/');
    </script>
@stop