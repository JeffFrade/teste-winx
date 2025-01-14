@can('admin')
    <div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="batchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('home.collaborators.batch') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batchModalLabel">Cadastrar Colaboradores Em Lote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="alert alert-warning">
                            Modelo de envio do CSV: <a href="{{ asset('csv/example.csv') }}" class="text-dark">Clique aqui</a>.
                        </div>

                        @csrf
                        <input type="file" id="csv" name="csv" accept="*.csv">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-times"></i>&nbsp; Fechar</button>
                        <button type="submit" class="btn btn-warning"><i class="fa fa-fw fa-file-excel"></i>&nbsp; Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan