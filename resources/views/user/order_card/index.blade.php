@extends('layouts.user.app')

@section('title', 'Commande carte')

@section('styles')
    <link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
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
                    <button class="btn btn-secondary mb-4" data-toggle="modal" data-target="#orderCardModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        Commander une carte
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-4">
                            <thead>
                            <th>Numero commande</th>
                            <th>Date commande</th>
                            <th>Quantité</th>
                            <th>Compte associé</th>
                            <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderCardModal" tabindex="-1" role="dialog" aria-labelledby="orderCardModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderCardModalLabel">Commander une carte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group mb-4">
                            <label for="account_type">Compte(s)</label>
                            <select class="selectpicker form-control" id="account_type" multiple aria-describedby="chooseAccountHelp">
                                @foreach($user->comptes as $account)
                                    <option value="{{$account->type_compte}}">{{$account->type_compte == 1 ? 'Compte courant' : 'Compte épargne'}}</option>
                                @endforeach
                            </select>
                            <small id="chooseAccountHelp" class="form-text text-muted">Choisissez le(s) compte(s) à lier à(aux) cartes</small>
                        </div>
                        <div class="form-group mb-4">
                            <label for="inputAddress">Adresse de livraison</label>
                            <input type="text" class="form-control" id="address" placeholder="Yopougon toit rouge">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Annuler</button>
                    <button type="button" class="btn btn-primary">Commander</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
@endsection
