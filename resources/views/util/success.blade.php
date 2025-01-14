@if (session('message'))
    <div class="success" style="display: none;">
        <div class="form-success hidden">{{ session('message') }}</div>
    </div>
@endif
