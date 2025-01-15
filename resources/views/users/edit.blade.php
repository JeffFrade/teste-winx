@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Usuário {{ $user->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('home.users.update', ['id' => $user->id]) }}" method="POST">
                @method('PUT')
                <div class="card card-warning card-outline">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title text-dark">Editar Usuário</h3>
                    </div>

                    <div class="card-body">
                        @include('users._form')
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('home.users.index') }}" class="btn btn-danger btn-overlay"><i class="fa fa-times"></i>&nbsp; Cancelar</a>
                        &nbsp;
                        <button type="submit" class="btn btn-warning btn-overlay"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                    </div>

                    @include('util.overlay')
                </div>
            </form>
        </div>
    </div>
@stop