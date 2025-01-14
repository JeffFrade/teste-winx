@extends('adminlte::page')

@section('title', 'Informações do Lote')

@section('content_header')
    <h1 class="m-0 text-dark">Informações do Lote</h1>
@stop

@section('content')
    @include('util.errors')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('home.batch_infos.show', ['id' => $id]) }}" method="GET">
                <div class="card card-warning card-outline">
                    <div class="card-header bg-transparent">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Conteúdo" value="{{ $params['search'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-warning btn-overlay"><i class="fa fa-search"></i>&nbsp; Filtrar</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body overflow-y">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Conteúdo</th>
                                    <th>Status</th>
                                    <th>Observações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($infos as $info)
                                    <tr>
                                        <td>{{ $info->line_content }}</td>
                                        <td>{!! \App\TypeLabels\InfoValue::label($info->status) !!}</td>
                                        <td>{{ $info->obs ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Não há dados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        {{ \App\Helpers\PaginateHelper::paginateWithParams($infos, $params) }}
                    </div>
                    @include('util.overlay')
                </div>
            </form>
        </div>
    </div>
@stop