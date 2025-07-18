@if (session('success'))
    <div class="alert alert-success" role="alert" style="color: black">
        {{session('success')}}
    </div>
@endif
@if (session('errors'))
    <div class="alert alert-danger" role="start" style="color:white">
        error: {{session('errors')}}
    </div>
@endif
