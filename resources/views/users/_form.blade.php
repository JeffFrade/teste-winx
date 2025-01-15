<div class="row">
    @include('util.errors')
    @csrf

    <div class="col-md-4">
        <div class="form-group">
            <label for="name"><span class="required">*</span> Nome:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Nome" value="{{ old('name', $user->name ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="email"><span class="required">*</span> E-mail:</label>
            <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email', $user->email ?? '') }}">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="password"><span class="required">*</span> Senha:</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha" value="{{ old('password', '') }}">
        </div>
    </div>

    @can('admin')
        <div class="col-md-4">
            <div class="form-group">
                <label for="permission"><span class="required">*</span> Permissão:</label>
                <select id="permission" name="permission" class="form-control select2">
                    <option value="" disabled="" selected="">Selecione Uma Opção</option>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}" {{ old('permission', $user->permission[0]->name ?? '') == $permission->name ? 'selected="selected"' : '' }}>{{ trans('profiles.' . $permission->name) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endcan
</div>
