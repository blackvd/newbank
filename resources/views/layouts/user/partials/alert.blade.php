@if (session('success'))
    <div class="alert alert-success border-0 mb-4" role="alert"> 
        {{ session('success') }}
    </div>
@endif

@if (session('echec'))
    <div class="alert alert-danger border-0 mb-4" role="alert"> 
        {{ session('echec') }}
    </div>
@endif
