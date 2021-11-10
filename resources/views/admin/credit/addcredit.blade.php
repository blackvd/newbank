@extends('layouts.admin.app')

@section('title', 'Détails de la demande')
    
@section('styles')
<link href="{{asset('assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('plugins/sweetalerts/promise-polyfill.js')}}"></script>
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
        @include('layouts.admin.partials.alert')
    </div>

    <!-- Content -->
    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
        <div class="user-profile layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Informations</h3>
                    <div class="mt-2">
                        @if($client->statut_ouverture_compte == \App\Models\Client::STATUT['EN ATTENTE'])
                        <button class="btn btn-success" id="validateBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </button>

                        <button class="btn btn-danger" id="rejectBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        </button>

                        <form class="d-none" action="{{route('admin.account_requests.change_status', $client->track_id)}}" id="changeStatusForm" method="post">
                            @csrf
                            <input type="text" id="status" name="status">
                        </form>
                        @elseif($client->statut_ouverture_compte == \App\Models\Client::STATUT['VALIDATION'])
                        <button class="btn btn-success" id="activateBtn">
                            Activer le compte
                        </button>

                        <form class="d-none" action="{{route('admin.account_requests.activate_account', $client->track_id)}}" id="activateForm" method="post">
                            @csrf
                        </form>
                        @elseif($client->statut_ouverture_compte == \App\Models\Client::STATUT['OUVERT'])
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
            <div class="widget-content widget-content-area mb-3">
                <h3 class="">Informations compte(s)</h3>
                <button class="btn btn-dark mb-2" data-toggle="modal" data-target="#creditModal">credit le compte</button>
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
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="" value="{{$client->email}}" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Numéro de téléphone 1</label>
                        <input type="text" class="form-control" id="" value="{{$client->numero_telephone1}}" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="">Numéro de téléphone 2</label>
                        <input type="text" class="form-control" id="" value="{{$client->numero_telephone2}}" readonly>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="form-group col-12">
                        <label for="">Statut marital</label>
                        <input type="text" class="form-control" id="" value="{{$client->statut_marital}}" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade login-modal" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" id="loginModalLabel">
                    <h4 class="modal-title">Crediter un compte</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg></button>
                </div>
                <div class="modal-body">
                    <form class="mt-0" id="CreditCompte">
                        @csrf
                        <div class="form-group">
                            <label for="pswd">Montant</label>
                            <input type="text" class="form-control mb-4" id="montant" name="montant" placeholder="montant a crediter" required>
                        </div>
                        <input type="hidden" id="libelle" value="crediter mon compte dans une agence" name="libelle">
                        <div class="form-group">
                            <label for="compte">Numero Compte</label>
                            <select name="compte" id="compte" class="custom-select mb-4">
                                <option>Comptes</option>
                                @foreach ($client->comptes as $compte)
                                    <option value="{{ $compte->numero_compte}}">{{ $compte->numero_compte}} -- {{ $compte->type_compte ==1 ?"Courant":"Epargne" }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <button id="btnFormCrediter" class="btn btn-primary">Enregistrez</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('plugins/sweetalerts/sweetalert2.all.min.js')}}"></script>

<script>

    $('#btnFormCrediter').click(function(){
        let montant = $('#montant').val();
        let libeller = $('#libelle').val();
        let compte = $('#compte').val();
        Swal.fire({
            title: 'Crediter',
            html:"<p>Vous allez crediter le compte <strong class='text-primary'>" + compte +"</strong> de <strong class='text-danger'>"+montant + " </strong>Francs.</p>" ,
            showCancelButton: true,
            confirmButtonText: 'crediter',
            cancelButtonText: 'annulez',
            showLoaderOnConfirm: true,
            backdrop:true,
            preConfirm: (login) => {
              return axios.post('/admin/credit/crediter',{
                  montant:montant,
                  libelle: libeller,
                  compte: compte,
              }).then(response => {
                console.log(response.data); 
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 3000,
                }).then(result => {
                    console.log(result);
                    if (!result.isConfirmed) {
                        $("#montant").val("");
                        $("#compte").val(1)
                        window.location.reload()
                    }
                })
                window.location.reload
                })
                .catch(error => {
                    console.log(error.response.data.errors);
                    let erreur = "";
                    error.response.data.errors.montant.forEach(element =>{
                        erreur += "<p class='help-link'>" +element+"</p>"
                    })
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        html: erreur,
                        showConfirmButton: false,
                        timer: 3000
                      })
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
              Swal.fire({
            })
            }
          })
    })
</script>
@endsection