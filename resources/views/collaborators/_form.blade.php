<div class="row">
    @include('util.errors')
    @csrf

    <div class="col-md-4">
        <div class="form-group">
            <label for="name"><span class="required">*</span> Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ old('name', $collaborator->name ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="email"><span class="required">*</span> E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email', $collaborator->email ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="position"><span class="required">*</span> Cargo:</label>
            <input type="text" id="position" name="position" class="form-control" placeholder="Cargo" value="{{ old('position', $collaborator->position ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="admission_date"><span class="required">*</span> Data de Admissão:</label>
            <input type="date" id="admission_date" name="admission_date" class="form-control" placeholder="Data de Admissão" value="{{ old('admission_date', $collaborator->admission_date ?? '') }}">
        </div>
    </div>
</div>
