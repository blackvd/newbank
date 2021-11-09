@if (session('success'))
    <div class="alert alert-light-success border-0 mb-4" role="alert"> 
        {!! session('success') !!}
    </div>
@endif

@if (session('echec'))
    <div class="alert alert-light-danger border-0 mb-4" role="alert"> 
        {!! session('echec') !!}
    </div>
@endif

@if (session('attention'))
    <div class="alert alert-light-info border-0 mb-4" role="alert"> 
        {!! session('attention') !!}
    </div>
@endif