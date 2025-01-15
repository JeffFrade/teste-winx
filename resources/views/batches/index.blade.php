@extends('adminlte::page')

@section('title', 'Lotes')

@section('content_header')
    <h1 class="m-0 text-dark">Lotes</h1>
@stop

@section('content')
    @include('util.errors')
    <div class="row">
        <div class="col-12">
            <div class="card card-warning card-outline">
                <div class="card-body overflow-y">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Status</th>
                                <th>Data de Criação</th>
                                <th>Data de Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($batches as $batch)
                                <tr>
                                    <td>{{ $batch->user->name }}</td>
                                    <td>{!! \App\TypeLabels\BatchValue::label($batch->status) !!}</td>
                                    <td>{{ \App\Helpers\DateHelper::convertTimestamp($batch->created_at) }}</td>
                                    <td>{{ \App\Helpers\DateHelper::convertTimestamp($batch->updated_at) }}</td>
                                    <td style="width: 1%" nowrap="nowrap">
                                        <a href="{{ route('home.batch_infos.show', ['id' => $batch->id]) }}" class="btn btn-warning btn-xs" title="Ver Informações"><i class="fa fa-fw fa-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Não há dados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ \App\Helpers\PaginateHelper::paginateWithParams($batches, []) }}
                </div>
            </div>
        </div>
    </div>
@stop
