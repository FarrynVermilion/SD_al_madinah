@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif
@if (session('errors'))
    <div class="alert alert-danger" role="start" style="color: black">
        error: {{session('errors')}}
    </div>
@endif
