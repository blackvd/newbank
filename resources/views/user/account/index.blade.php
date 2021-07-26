@extends('layouts.user.app')

@section('title', 'Tableau de bord')
    
@section('styles')

@endsection

@section('css-apply-to-body', 'alt-menu sidebar-noneoverflow')

@section('content')
<div class="page-header page-header-scrollspy">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <div class="title">
            <h3>Compte(s)</h3>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">Liste</a></li>
        </ol>
    </nav>
</div>

<div class="row layout-top-spacing">
    <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Numéro de compte</th>
                                <th>Solde</th>
                                <th class="text-center">Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
