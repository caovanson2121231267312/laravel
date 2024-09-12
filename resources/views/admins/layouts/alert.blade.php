@if (session('mess'))
    <div class="alert alert-mess d-none alert-primary" role="alert">
        {{ session('mess') }}
    </div>
@endif

@if (session('success'))
    <div class="alert d-none" id="code-alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert d-none" id="code-alert-error" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alert d-none" id="code-alert-info" role="alert">
        {{ session('info') }}
    </div>
@endif