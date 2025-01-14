@extends('adminlte::page')

@section('title', 'Colaboradores')

@section('content_header')
    <h1 class="m-0 text-dark">Colaboradores</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('home.collaborators.index') }}" method="GET">
                <div class="card card-warning card-outline">
                    <div class="card-header bg-transparent">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Nome/E-mail/Cargo" value="{{ $params['search'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-warning btn-overlay"><i class="fa fa-search"></i>&nbsp; Filtrar</button>
                                &nbsp;
                                <a href="#" class="btn btn-secondary"><i class="fa fa-file-excel"></i>&nbsp; Cadastrar Em Lote</a>
                                &nbsp;
                                <a href="#" class="btn btn-default text-dark"><i class="fa fa-plus"></i>&nbsp; Cadastrar Colaborador</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body overflow-y">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Cargo</th>
                                    <th>Admissão</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($collaborators as $collaborator)
                                    <tr>
                                        <td>{{ $collaborator->name }}</td>
                                        <td>{{ $collaborator->email }}</td>
                                        <td>{{ $collaborator->position }}</td>
                                        <td>{{ \App\Helpers\DateHelper::convertDate($collaborator->admission_date) }}</td>
                                        <td>{!! \App\TypeLabels\ActiveValue::label($collaborator->active) !!}</td>
                                        <td style="width: 1%" nowrap="nowrap">
                                            <a href="{{ route('home.collaborators.edit', ['id' => $collaborator->id]) }}" class="btn btn-default btn-xs" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                                            &nbsp;
                                            <a href="#" class="btn btn-danger btn-xs btn-overlay" data-id="{{ $collaborator->id }}" title="Excluir" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-fw fa-trash"></i></a>
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
                        {{ \App\Helpers\PaginateHelper::paginateWithParams($collaborators, $params) }}
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
    <script type="text/javascript">
        deleteModal('accounts/delete/');
    </script>
@stop