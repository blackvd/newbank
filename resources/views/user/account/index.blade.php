@extends('layouts.user.app')

@section('title', 'Mes comptes')

@section('styles')
<link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
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
                            <a class="dropdown-item"  id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false">Vers autres banques</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Demandes <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">RIB</a>
                            <a class="dropdown-item"  id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false">Relevé de compte</a>
                            <a class="dropdown-item"  id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false">Vers autres banques</a>
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
                                        @foreach($account_s as $account)
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
                                <div class="media">
                                    <img class="mr-3" src="assets/img/profile-32.jpg" alt="Generic placeholder image">
                                    <div class="media-body">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                                <p class="">
                                    Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection




@section('scripts')
@endsection
