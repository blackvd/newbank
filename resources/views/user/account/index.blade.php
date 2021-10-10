@extends('layouts.user.app')

@section('title', 'Mes comptes')

@section('styles')
<link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/elements/alert.css')}}">
<link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
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
    <div class="col-lg-12 col-12">
        @include('layouts.user.partials.alert')
    </div>
    <div class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4></h4>
                    </div>
                </div>
            </div>

            <div class="widget-content widget-content-area simple-tab">
                <ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Solde</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Virements <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Compte à compte</a>
                            <a class="dropdown-item"  id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Entre comptes NewBank</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Demandes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="rib-tab" data-toggle="tab" href="#rib" role="tab" aria-controls="rib" aria-selected="false">RIB</a>
                            <a class="dropdown-item"  id="bilan-tab" data-toggle="tab" href="#bilan" role="tab" aria-controls="bilan" aria-selected="false">Relevé de compte</a>
                            <a class="dropdown-item"  id="loan-tab" data-toggle="tab" href="#loan" role="tab" aria-controls="loan" aria-selected="false">Prêt</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li> --}}
                </ul>
                        <div class="tab-content" id="simpletabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <thead>
                                            <tr>
                                                <th>Numéro de compte</th>
                                                <th>Type de compte</th>
                                                <th>Solde</th>
                                                <th class="text-center">Statut</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($client->comptes as $account)
                                            <tr>
                                                <td>{{$account->numero_compte}}</td>
                                                <td>{{$account->type_compte == 1 ? "Courant" : "Épargne"}}</td>
                                                <td>{{$account->solde}}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @if(count($client->comptes) <= 1)
                                    <div class="alert alert-light-danger border-0 mb-4" role="alert">
                                        <strong>Fonctionnalité indisponible ! </strong> vous n'avez qu'un seul compte
                                    </div>
                                @else
                                    <form action="">
                                        <div class="form-group row mb-4">
                                            <label for="account_debit" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Compte à débiter</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <select name="account_debit" id="account_debit" class="form-control selectpicker">
                                                    @foreach($client->comptes as $account)
                                                        <option value="{{$account->id}}">{{$account->numero_compte}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="account_credit" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Compte à créditer</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <select name="account_credit" id="account_credit" class="form-control selectpicker">

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="amount" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Montant(FCFA)</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="number" class="form-control" id="amount" placeholder="12000">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary mt-3">Valider</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                <form action="">
                                    <div class="form-group row mb-4">
                                        <label for="account_debit" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Compte à débiter</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select name="account_debit" id="account_debit" class="form-control selectpicker">
                                                @foreach($client->comptes as $account)
                                                    <option value="{{$account->id}}">{{$account->numero_compte}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="account_credit" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Compte à créditer</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" class="form-control" name="account_credit" id="account_credit">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="amount" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Montant(FCFA)</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="number" class="form-control" id="amount" placeholder="12000">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary mt-3">Valider</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="rib" role="tabpanel" aria-labelledby="rib-tab">
                                <form action="">
                                    <div class="form-group row mb-4">
                                        <label for="options" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Options</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select id="options" name="options" class="selectpicker form-control">
                                                <option>Télécharger</option>
                                                <option>Recevoir par mail</option>
                                                <option>Télécharger & recevoir par mail</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Soumettre</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="bilan" role="tabpanel" aria-labelledby="bilan-tab">
                                <form action="" class="form-inline justify-content-center">
                                    <label for="period" class="mr-2">Période</label>
                                    <input id="period" class="form-control flatpickr flatpickr-input active mr-2" type="text" placeholder="Select Date..">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="loan" role="tabpanel" aria-labelledby="loan-tab">
                                <form action="{{ route('pret.ask') }}" method="Post" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group row mb-4">
                                                <label for="amount" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Montant du prêt</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <input id="amount" type="text" value="" name="amount" required pattern="[0-9]{6,}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group row mb-4">
                                                <label for="agence" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Agence</label>
                                                <div class="col-xl-10 col-lg-9 col-sm-10">
                                                    <select id="agence" name="agence" class="selectpicker form-control" required>
                                                        <option value="abobo">Abobo</option>
                                                        <option value="yopougon">Yopougon</option>
                                                        <option value="angre">Angré</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="reason" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Motif de la demande</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <textarea class="form-control" id="reason" name="reason" rows="3" ></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user" value="{{$client->id}}">
                                    <button type="submit" class="btn btn-primary">Soumettre</button>
                                </form>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/input-mask/input-mask.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
    <script>
        $("#account_credit").inputmask({mask:"CI221019999999999"});
        var period = flatpickr($("#period"), {
        mode: 'range',
        })

        $("input[name='amount']").TouchSpin({
            verticalbuttons: true,
            min:200000,
            max:4999999,
            step:10000,
            buttondown_class: "btn btn-classic btn-outline-info",
            buttonup_class: "btn btn-classic btn-outline-danger"
        });
    </script>
@endsection