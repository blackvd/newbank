@extends('layouts.admin.app')

@section('title', 'Gestion des comptes')

@section('styles')
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
                <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">Comptes</a></li>
            </ol>
        </nav>

    </div>

    <div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <table id="datatable" class="table style-1 dt-table-hover non-hover">
                        <thead>
                        <tr>
                            <th>Nom complet</th>
                            <th>Numéro de compte</th>
                            <th>Type de compte</th>
                            <th>Solde</th>
                            <th>Statut</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $account)
                            <tr>
                                <td>
                                    {{$account->client->civilite == "M" ? "M." : $account->client->civilite}} {{$account->client->nom}} {{$account->client->prenoms}}
                                </td>
                                <td>
                                    {{$account->numero_compte}}
                                </td>
                                <td>
                                    {{$account->type_compte == 1 ? "Courant" : "Épargne"}}
                                </td>
                                <td>
                                    {{$account->solde}}
                                </td>
                                <td></td>
                                <td></td>
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
    <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
    <script>
        // var e;
        c2 = $('#datatable').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });
    </script>
@endsection
