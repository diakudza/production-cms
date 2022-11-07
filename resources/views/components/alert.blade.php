@if (session('success'))
<div class="alert alert-success animate__animated animate__fadeInRight">
    {{ session('success') }}
</div>
@endif

@if (session('fail'))
<div class="alert alert-danger animate__animated animate__fadeInRight">
    {{ session('fail') }}
</div>
@endif

@if ($errors->any())

<div class="alert alert-danger animate__animated animate__fadeInRight">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif
