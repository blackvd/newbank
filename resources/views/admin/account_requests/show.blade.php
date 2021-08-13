@extends('layouts.admin.app')

@section('title', 'Détails de la demande')
    
@section('styles')
<link href="{{asset('assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('plugins/sweetalerts/promise-polyfill.js')}}"></script>
<link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('css-apply-to-body', 'sidebar-noneoverflow')

@section('content')
<div class="page-header">
    <nav class="breadcrumb-one" aria-label="breadcrumb">
        <div class="title">
            <h3>NewBank</h3>
        </div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.account_requests')}}">Demandes</a></li>
            <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">Demande {{$account->track_id}}</a></li>
        </ol>
    </nav>
</div>

<div class="row layout-spacing">

    <!-- Content -->
    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
        <div class="user-profile layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Informations</h3>
                    <div class="mt-2">
                        @if($account->statut_ouverture_compte == \App\Models\Client::STATUT['EN ATTENTE'])
                        <button class="btn btn-success" id="validateBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </button>

                        <button class="btn btn-danger" id="rejectBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        </button>

                        <form class="d-none" action="{{route('admin.account_requests.change_status', $account->track_id)}}" id="changeStatusForm" method="post">
                            @csrf
                            <input type="text" id="status" name="status">
                        </form>
                        @elseif($account->statut_ouverture_compte == \App\Models\Client::STATUT['VALIDATION'])
                        <button class="btn btn-success" id="activateBtn">
                            Activer le compte
                        </button>

                        <form class="d-none" action="{{route('admin.account_requests.activate_account', $account->track_id)}}" id="activateForm" method="post">
                            @csrf
                        </form>
                        @elseif($account->statut_ouverture_compte == \App\Models\Client::STATUT['OUVERT'])
                        <h6><span class="badge badge-success"> OUVERT </span></h6>
                        @else
                        <h6><span class="badge badge-danger"> REJÉTÉ </span></h6>
                        @endif
                    </div>
                </div>
                <div class="text-center user-info">
                    <img src="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->photo )}}" style="height: 150px; width: 150px;" alt="avatar">
                    <p class="">{{$account->nom}} {{$account->prenoms}}</p>
                </div>

                <div class="user-info-list">

                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->photo)}}" download="PHOTO {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> PHOTO
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->piece_recto)}}" download="PIECE RECTO {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> PIECE RECTO
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->piece_verso)}}" download="PIECE VERSO {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> PIECE VERSO
                                </a>
                            </li>
                            @if($account->identification->facture_electricite != null)
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->fature_electricite)}}" download="FACTURE D'ELECTRICITE {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> FACTURE D'ELECTRICITE
                                </a>
                            </li>
                            @endif
                            @if($account->identification->facture_eau != null)
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->facture_eau)}}" download="FACTURE D'EAU {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> FACTURE D'EAU
                                </a>
                            </li>
                            @endif
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->certificat_residence)}}" download="CERTIFICAT DE RESIDENCE {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> CERTIFICAT DE RESIDENCE
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$account->track_id.'/'.$account->identification->signature)}}" download="SIGNATURE {{$account->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> SIGNATURE
                                </a>
                            </li>
                        </ul>
                    </div>                                    
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">


        <div class="bio layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Informations compte(s)</h3>
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <thead>
                            <tr>
                                <th>Numéro de compte</th>
                                <th>RIB</th>
                                <th>Solde</th>
                                <th class="text-center">Type de compte</th>
                                <th>Identifiant Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($account->comptes as $compte)
                                <tr>
                                    <td>{{$compte->numero_compte}}</td>
                                    <td>{{$compte->rib}}</td>
                                    <td>{{$compte->solde}}</td>
                                    <td>
                                        @if($compte->type_compte == \App\Models\Compte::TYPE_COMPTE['EPARGNE'])
                                        <span class="text-secondary">Compte épargne</span>
                                        @else
                                        <span class="text-primary">Compte courant</span>
                                        @endif
                                    </td>
                                    <td>{{$compte->client->customer_num}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="skills layout-spacing ">
            <div class="widget-content widget-content-area">
                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" id="" value="{{$account->sexe}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="civilite">Civilite</label>
                        <input type="text" class="form-control" id="" value="{{$account->civilite}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-md-6">
                        <label for="">Date de naissance</label>
                        <input type="text" class="form-control" id="" value="{{$account->date_naissance}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Lieu de naissance</label>
                        <input type="text" class="form-control" id="" value="{{$account->lieu_naissance}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-3">
                        <label for="">Nationnalité</label>
                        <input type="text" class="form-control" id="" value="{{$account->nationalite}}" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Pays de résidence</label>
                        <input type="text" class="form-control" id="" value="{{$account->pays_residence}}" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Ville</label>
                        <input type="text" class="form-control" id="" value="{{$account->ville}}" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Lieu de residence</label>
                        <input type="text" class="form-control" id="" value="{{$account->lieu_residence}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-4">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="" value="{{$account->email}}" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Numéro de téléphone 1</label>
                        <input type="text" class="form-control" id="" value="{{$account->numero_telephone1}}" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Numéro de téléphone 2</label>
                        <input type="text" class="form-control" id="" value="{{$account->numero_telephone2}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-12">
                        <label for="">Statut marital</label>
                        <input type="text" class="form-control" id="" value="{{$account->statut_marital}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-6">
                        <label for="">Secteur d'activité</label>
                        <input type="text" class="form-control" id="" value="{{$account->secteur_activite}}" readonly>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Profession</label>
                        <input type="text" class="form-control" id="" value="{{$account->profession}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-12">
                        <label for="">Objet du compte</label>
                        <input type="text" class="form-control" id="" value="{{$account->objet_compte}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>

<script>
    $('#validateBtn').click(function(){
        swal({
            title: 'Êtes-vous sûr(e)',
            text: "Vous vous apprêtez à confirmer l'ouverture de ce compte.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $('#status').val(2)
                $('#changeStatusForm').submit()
            }
        })
    })

    $('#rejectBtn').click(function(){
        swal({
            title: 'Êtes-vous sûr(e)',
            text: "Vous vous apprêtez à annuler l'ouverture de ce compte.",
            type: 'error',
            showCancelButton: true,
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $('#status').val(-1)
                $('#changeStatusForm').submit()
            }
        })
    })

    $('#activateBtn').click(function(){
        swal({
            title: 'Êtes-vous sûr(e)',
            text: "Vous vous apprêtez à activer ce compte.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                $('#activateForm').submit()
            }
        })
    })
</script>
@endsection