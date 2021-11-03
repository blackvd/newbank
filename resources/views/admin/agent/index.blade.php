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
                <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">cartes</a></li>
            </ol>
        </nav>

    </div>

    <div class="row layout-spacing">
        <div class="col-lg-12 col-12">
            @include('layouts.admin.partials.alert')
        </div>
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <table id="datatable" class="table style-3 dt-table-hover non-hover">
                        <thead>
                        <tr>
                            <th>username</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th class="text-center dt-no-sorting">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $item)
                            <tr>
                                <td>
                                    {{ $item->username}}
                                </td>
                                <td>
                                    {{ $item->name ?? ""}}
                                </td>
                                
                                <td>
                                    @if ($item->role == 1)
                                    <span class="shadow-none badge badge-success">
                                        Administrateur
                                    </span>
                                    @else
                                    <span class="shadow-none badge badge-secondary">
                                        Agent depot
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <ul class="table-controls">
                                        <li>
                                            <a href="{{ route('agent.show',[ 'id' => $item->id ]) }}"  data-toggle="tooltip" data-placement="top" title="voir">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </a>
                                            @if($item->role == 2)
                                                <a href="{{ route('agent.delete',[ 'id' => $item->id ]) }}"  data-toggle="tooltip" data-placement="top" title="delete" class="mx-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>
                                            
                                            @endif
                                        </li>
                                    </ul>
                                </td>
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
                "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5 
        });
    </script>
@endsection
