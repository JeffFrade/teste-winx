@extends('adminlte::page')

@section('title', 'Editar Colaborador')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Colaborador {{ $collaborator->nome }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('home.collaborators.update', ['id' => $collaborator->id]) }}" method="POST">
                @method('PUT')
                <div class="card card-warning card-outline">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title text-dark">Atualizar Colaborador</h3>
                    </div>

                    <div class="card-body">
                        @include('collaborators._form')
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('home.collaborators.index') }}" class="btn btn-danger btn-overlay"><i class="fa fa-times"></i>&nbsp; Cancelar</a>
                        &nbsp;
                        <button type="submit" class="btn btn-warning btn-overlay"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                    </div>

                    @include('util.overlay')
                </div>
            </form>
        </div>
    </div>
@stop