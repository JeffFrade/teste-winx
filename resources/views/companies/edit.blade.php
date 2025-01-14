@extends('adminlte::page')

@section('title', 'Editar Empresa')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Empresa {{ $company->nome }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('home.companies.update', ['id' => $company->id]) }}" method="POST">
                @method('PUT')
                <div class="card card-warning card-outline">
                    <div class="card-header bg-transparent">
                        <h3 class="card-title text-dark">Atualizar Empresa</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @include('util.errors')
                            @csrf

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name"><span class="required">*</span> Nome:</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ old('name', $company->name ?? '') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                       <button type="submit" class="btn btn-warning btn-overlay"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                    </div>

                    @include('util.overlay')
                </div>
            </form>
        </div>
    </div>
@stop