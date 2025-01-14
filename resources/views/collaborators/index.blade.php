@extends('adminlte::page')

@section('title', 'Colaboradores')

@section('content_header')
    <h1 class="m-0 text-dark">Colaboradores</h1>
@stop

@section('content')
    @include('util.errors')
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
                                @can('admin')
                                    &nbsp;
                                    <a href="#" class="btn btn-secondary btn-overlay" data-toggle="modal" data-target="#batchModal"><i class="fa fa-file-excel"></i>&nbsp; Cadastrar Em Lote</a>
                                @endcan
                                &nbsp;
                                <a href="{{ route('home.collaborators.create') }}" class="btn btn-default text-dark."><i class="fa fa-plus"></i>&nbsp; Cadastrar Colaborador</a>
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
                                    <th>Data de Admissão</th>
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
                                            @can('admin')
                                                &nbsp;
                                                @if ($collaborator->active)
                                                    <a href="#" class="btn btn-danger btn-xs btn-overlay btn-status" data-id="{{ $collaborator->id }}" title="Inativar"><i class="fa fa-fw fa-ban"></i></a>
                                                @else
                                                    <a href="#" class="btn btn-success btn-xs btn-overlay btn-status" data-id="{{ $collaborator->id }}" title="Ativar"><i class="fa fa-fw fa-check"></i></a>
                                                @endif
                                            @endcan
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
    </div>

    @include('collaborators.batch-modal')
@stop

@section('js')
    <script type="text/javascript">
        $('.btn-status').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                contentType: 'application/x-www-form-urlencoded',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                method: 'PUT',
                url: 'collaborators/status/' + $(this).data('id'),
                timeout: 0,
                success: function (response) {
                    $.notify({message: '<i class="fa fa-fw fa-check"></i>&nbsp; ' + response.message}, {type: 'success'});
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (err) {
                    let error = err.responseJSON.error;

                    if (error == undefined) {
                        error = err.responseJSON;
                    }

                    $.notify({message: '<i class="fa fa-fw fa-times"></i>&nbsp; ' + error.message}, {type: 'danger'});
                    console.error(error);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            });
        });

        $('#batchModal').on('hide.bs.modal', function (event) {
            $('.overlay').addClass('overlay-hidden');
        });
    </script>
@stop