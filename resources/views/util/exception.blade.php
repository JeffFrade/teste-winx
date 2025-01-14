@if (session('error'))
    <div class="success" style="display: none;">
        <div class="form-error hidden">{{ session('error') }}</div>
    </div>
@endif
