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
            <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">Demande {{$client->track_id}}</a></li>
        </ol>
    </nav>
</div>

<div class="row layout-spacing">
    <div class="col-lg-12 col-12">
        @include('layouts.user.partials.alert')
    </div>

    <!-- Content -->
    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
        <div class="user-profile layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Informations</h3>
                    <div class="mt-2">
                        @if($client->statut_ouverture_compte == \App\Models\Client::STATUT['OUVERT'])
                        <h6><span class="badge badge-success"> OUVERT </span></h6>
                        @else
                        <h6><span class="badge badge-danger"> REJÉTÉ </span></h6>
                        @endif
                    </div>
                </div>
                <div class="text-center user-info">
                    <img src="{{ substr($client->identification->photo,5)==".jpg" ? asset('storage/clients/pieces/'.$client->track_id.'/PHOTO.jpg') : asset('storage/clients/pieces/'.$client->track_id.'/PHOTO.png') }}" style="height: 150px; width: 150px;" alt="avatar">
                    <p class="">{{$client->nom}} {{$client->prenoms}}</p>
                </div>

                <div class="user-info-list">

                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->photo)}}" download="PHOTO {{$client->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> PHOTO
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->piece_recto)}}" download="PIECE RECTO {{$client->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> PIECE RECTO
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->piece_verso)}}" download="PIECE VERSO {{$client->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> PIECE VERSO
                                </a>
                            </li>
                            @if($client->identification->facture_electricite != null)
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->fature_electricite)}}" download="FACTURE D'ELECTRICITE {{$client->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> FACTURE D'ELECTRICITE
                                </a>
                            </li>
                            @endif
                            @if($client->identification->facture_eau != null)
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->facture_eau)}}" download="FACTURE D'EAU {{$client->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> FACTURE D'EAU
                                </a>
                            </li>
                            @endif
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->certificat_residence)}}" download="CERTIFICAT DE RESIDENCE {{$client->track_id}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg> CERTIFICAT DE RESIDENCE
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <a href="{{asset('storage/clients/pieces/'.$client->track_id.'/'.$client->identification->signature)}}" download="SIGNATURE {{$client->track_id}}">
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
                            @foreach($client->comptes as $compte)
                                <tr>
                                    <td>{{$compte->numero_compte}}</td>
                                    <td>{{$compte->rib}}</td>
                                    <td>{{$compte->solde}}</td>
                                    <td>
                                        {{-- type_compte = 2 = epargne --}}
                                        @if($compte->type_compte == 2)
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
                    <div class="form-group col-3">
                        <label for="">Nationnalité</label>
                        <input type="text" class="form-control" id="" value="{{$client->nationalite}}" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Pays de résidence</label>
                        <input type="text" class="form-control" id="" value="{{$client->pays_residence}}" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Ville</label>
                        <input type="text" class="form-control" id="" value="{{$client->ville}}" readonly>
                    </div>
                    <div class="form-group col-3">
                        <label for="">Lieu de residence</label>
                        <input type="text" class="form-control" id="" value="{{$client->lieu_residence}}" readonly>
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="form-group col-4">
                        <label for="">Agence de livraison</label>
                        <input type="text" class="form-control" id="" value="{{$commande->adresseLivraison->description}}" readonly>
                    </div>

                    <div class="form-group col-4">
                        <label for="">Numero commande</label>
                        <input type="text" class="form-control" id="" value="{{$commande->no_commande}}" readonly>
                    </div>

                    <div class="form-group col-4">
                        <label for="">Date de la commande</label>
                        <input type="text" class="form-control" id="" value="{{$commande->created_at}}" readonly>
                    </div>
                </div>

                

                <div class="form-row col-8">
                    @if ($commande->statut == 1)
                        <div class="form-group col-4">
                            <form action="{{ route('cartes.livraison',['id'=>$commande->no_commande]) }}" method="post" >
                                @csrf
                                <button type="submit" id="pretEliBtn" class="btn btn-info">Livrer</button>
                            </form>
                        </div>                        
                    @endif
                    @if ($commande->statut == 2)
                        <div class="form-group col-4">
                            <form action="{{ route('cartes.delivrer',['id'=>$commande->no_commande]) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-success" value="Delivrer">
                            </form>
                        </div>
                    @endif
                    <div class="form-group col-4">
                        <form action="{{ route('cartes.block',['id'=>$commande->no_commande]) }}" method="get" >
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Bloquer">
                        </form>
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