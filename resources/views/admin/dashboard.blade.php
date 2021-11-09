@extends('layouts.admin.app')

@section('title', 'Dashboard')
    
@section('styles')
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>

<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">

<link href="{{asset('assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('assets/css/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css" >  

<style class="dark-theme">
    #chart-2 path {
        stroke: #0e1726;
    }
    
    .widget-three .widget-content .summary-list.summary-income {
        background: rgb(152 251 152 / 34%);
        
    }
</style>
@endsection

@section('css-apply-to-body', 'alt-menu sidebar-noneoverflow')

@section('content')
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="page-header">
                    <div class="page-title">
                        <h3>Admin Dashboard</h3>
                    </div>
                </div>

                <div class="row layout-top-spacing">
                    {{-- Transactions test 1--}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Statut des Comptes</h5>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('admin.account_requests') }}">Toutes les comptes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div class="widget-content widget-content-area">
                                    <div id="compte-chart" class=""></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Statut pret--}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Statut des Prets</h5>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('pret.index') }}">Toutes les Prets</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div class="widget-content widget-content-area">
                                    <div id="pret-chart" class=""></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Liste statut cartes --}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-three">
                            <div class="widget-heading">
                                <h5 class="">Statut des cartes</h5>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('cartes.index') }}">Home</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content">
                                <div class="order-summary">
                                    <div class="summary-list summary-income">
                                        <div class="summery-info">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                            </div>
                                            <div class="w-summary-details">
                                                <div class="w-summary-info">
                                                    <h6>Carte Active <span class="summary-count">{{$carte_activ}}</span></h6>
                                                    {{-- <p class="summary-average">90%</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-list summary-profit">
                                        <div class="summery-info">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                                            </div>
                                            <div class="w-summary-details">

                                                <div class="w-summary-info">
                                                    <h6>Carte commander <span class="summary-count">{{$carte_commande}}</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-list summary-expenses">
                                        <div class="summery-info">
                                            <div class="w-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-stop-circle"><circle cx="12" cy="12" r="10"></circle><rect x="9" y="9" width="6" height="6"></rect></svg>
                                            </div>
                                            <div class="w-summary-details">
                                                <div class="w-summary-info">
                                                    <h6>Carte non actif<span class="summary-count">{{$carte_reject}}</span></h6>
                                                    {{-- <p class="summary-average">80%</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Transactions --}}
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Transactions</h5>
                                    <div class="task-action">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                                <a class="dropdown-item" href="javascript:void(0);">Toutes les transactions</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="widget-content">
                                @foreach ($transaction as $item)
                                <div class="transactions-list">
                                    <div class="t-item">
                                        <div class="t-company-name">
                                            <div class="t-icon">
                                                <div class="icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize-2"><polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>
                                                </div>
                                            </div>
                                            <div class="t-name">
                                                <h4>{{$item->libelle}}</h4>
                                                <p class="meta-date">{{$item->from_date}}</p>
                                            </div>

                                        </div>
                                        <div class="t-rate">
                                            <p><span>{{$item->credit}} Cfa</span></p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Agent depot --}}
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-one">
                            <div class="widget-heading">
                                <h5 class="">Agent depot</h5>
                               <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask" style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('agent.index') }}">Agents</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                {{-- {{dd($depot_agent)}} --}}
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">User name</div></th>
                                                <th><div class="th-content">Name</div></th>
                                                <th><div class="th-content">Role</div></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($depot_agent as $item)
                                                <tr>
                                                    <td><div class="td-content product-brand text-primary">{{$item->username}}</div></td>
                                                    <td><div class="td-content product-invoice">{{$item->name}}</div></td>
                                                    <td>
                                                        <div class="td-content">
                                                            <span class="badge badge-secondary">
                                                                @if ($item->role == 2)
                                                                    Agent depot
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com/">DesignReset</a>, All rights reserved.</p>
                    </div>
                </div>

            </div>
        </div>
        <!--  END CONTENT PART  -->
@endsection

@section('scripts')
    <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('plugins/apex/custom-apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dash_2.js') }}"></script>
    <script src="{{ asset('assets/js/widgets/modules-widgets.js') }}"></script>
    
    {{-- ststut des compte --}}
    <script>
        var donutChart = {
            colors:["#ffcc33","#33ffc2","#e60000"],
            chart: {
                height: 350,
                type: 'donut',
                toolbar: {
                  show: false,
                }
            },
            plotOptions:{
                pie:{
                    donut:{
                       labels:{
                           show:true,
                           total:{
                               show:true,
                               label:"Comptes"
                           }
                       }
                    }
                }
            },
            series: [{{$compte_en_cours}},{{$compte_ouvert}},{{$compte_bloquer}}],
            labels:['En attente','Ouvert','Rejeter'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }
        
        var donut = new ApexCharts(
            document.querySelector("#compte-chart"),
            donutChart
        );
        
        donut.render();
    </script>

    {{-- Statut pret --}}
    <script>
        var donutChart = {
            colors:["#ffcc33","#33ffc2","#e60000"],
            chart: {
                height: 350,
                type: 'donut',
                toolbar: {
                  show: false,
                }
            },
            plotOptions:{
                pie:{
                    donut:{
                       labels:{
                           show:true,
                           total:{
                               show:true,
                               label:"Pret Total"
                           }
                       }
                    }
                }
            },
            series: [{{$pret_en_cours}},{{$pret_accord}},{{$pret_reject}}],
            labels:['En attente','Accorder','Refuser'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        }
        
        var donut = new ApexCharts(
            document.querySelector("#pret-chart"),
            donutChart
        );
        
        donut.render();
    </script>
@endsection