@extends('layouts.admin.app')

@section('title', 'Détails de la demande')
    
@section('styles')
<link href="{{asset('assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>

<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />

<link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
<link href="assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
<style class="dark-theme">
    #chart-2 path {
        stroke: #0e1726;
    }
</style>

<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/custom_dt_custom.css')}}">

@endsection

@section('css-apply-to-body', 'sidebar-noneoverflow')

@section('content')
<div class="page-header">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <div class="title">
            <h3>NewBank</h3>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.index')}}">Agent</a></li>
            <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">{{ $agent->name}}</a></li>
        </ol>
    </nav>
</div>

<div class="row layout-spacing">
    <div class="col-lg-12 col-12">
        @include('layouts.admin.partials.alert')
    </div>

    <!-- Content -->
    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-two">
            <div class="widget-heading">
                <h5 class="">Information Agent</h5>
            </div>
            <div class="widget-content p-3">
                <form action="{{ route('agent.edit') }}" method="POST" id="agentForm">
                    @csrf
                    <div class="form-row mb-1">
                        <div class="form-group col-md-6">
                            <label for="username">Nom utilisateur</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$agent->username}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$agent->name}}">
                        </div>
                        <input type="hidden" name="id" id="id" value="{{$agent->id}}">
                    </div>
                    <div class="form-row mb-2">
                        <div class="form-group col-md-6">
                            <input type="submit" value="Modifiez" class="btn btn-secondary">
                        </div>                        
                    </div>
                </form>
                <form action="{{ route('agent.delete', ['id'=>$agent->id]) }}" method="POST" id="delAgentForm">
                    @csrf
                    {{-- <input type="hidden" value="{{$agent->id}}" name="id"> --}}
                </form>

                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <input type="submit" id="delAgentBtn" value="supprimez" class="btn btn-danger">
                    </div>                        
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h5 class="">Les transactions effectuer</h5>
            </div>

            <div class="widget-content">
                <table id="datatable" class="table style-1 dt-table-hover non-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ref</th>
                            <th>Credit</th>
                            <th>Solde</th>
                            <th>Agent</th>
                            <th>libelle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trans as $item)
                        <tr>
                            <td>{{$item->from_date}}</td>
                            <td>{{$item->ref}}</td>
                            <td>{{$item->credit}}</td>
                            <td>{{$item->solde}}</td>
                            <td>{{$agent->name}}</td>
                            <td>{{$item->libelle}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
<script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="assets/js/dashboard/dash_1.js"></script>

<script>
    $('#delAgentBtn').click(function(){
        swal({
            title: 'Êtes-vous sûr(e)',
            text: "Vous vous apprêtez à supprimer ce utilisateur.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $('#delAgentForm').submit()
            }
        })
    })
</script>

<script>
    c2 = $('#datatable').DataTable({
        "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
    "<'table-responsive'tr>" +
    "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', 
                            "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' 
                        },
            "sInfo": "Page _PAGE_ / _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Recherche",
            "sLengthMenu": "Resultats :  _MENU_",
            "sEmptyTable": "Aucune donnée disponible dans le tableau",
            "sZeroRecords": "Aucune entree trouver",
            "sLengthMenu":  "Affichage _MENU_",
        },
        "lengthMenu": [5, 10, 20, 50],
        "pageLength": 5 
    });
</script>
@endsection