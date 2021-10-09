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
                <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">cartes</a></li>
            </ol>
        </nav>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-lg-12 col-12">
            @include('layouts.user.partials.alert')
        </div>
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-4">
                            <thead>
                                <th>Numero carte</th>
                                <th>Date commande</th>
                                <th>Compte associé</th>
                                <th>Type carte</th>
                                <th>statut</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                {{-- {{dd($compte->carte()->get())}} --}}
                                @foreach ($compte->carte()->get() as $carte)
                                <tr>
                                    <td>{{ $carte->no_carte }}</td>
                                    <td>{{ $carte->created_at }}</td>
                                    <td>COURANT</td>
                                    <td>{{ $carte->type_carte == 2 ? "VISA":"AUtre" }}</td>
                                    <td>{{ $carte->statut == 1 ? "activer":"desactiver"}}</td>
                                    <td >
                                    @if ($carte->statut == 1 )
                                        <a href="#" id="bloqueBtn" role="button" title="Bloquer la carte">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield-off"><path d="M19.69 14a6.9 6.9 0 0 0 .31-2V5l-8-3-3.16 1.18"></path><path d="M4.73 4.73L4 5v7c0 6 8 10 8 10a20.29 20.29 0 0 0 5.62-4.38"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                        </a>
                                        <input type="hidden" value="{{$carte->no_carte}}" id="carte_no">                                            
                                    @else
                                        <p class="text-danger">
                                            vous avez desactiver cette carte
                                        </p>
                                    @endif
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
@endsection

@section('scripts')
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>

    <script>
        $("#bloqueBtn").on("click",function(){            
            Swal.fire({
                title: 'Attention',
                text: "Voulez vous desactiver cette carte",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                confirmButtonText: 'Bloquer la carte',
                cancelButtonColor: '#bbb',
                cancelButtonText: "Annuler",
                showLoaderOnConfirm: true,
                preConfirm:(carte)=>{
                    var carte = document.getElementById('carte_no').value;
                    return axios.post("/block-card",{numero:carte
                    }).then(function(response){
                        console.log(response);
                        if(response.status == 500){
                            throw new Error(response.data)
                        }
                        return response.data;
                    }).catch(function(error){
                        console.log(error.statustext)
                        Swal.showValidationMessage(
                                `La requete a echouer: Votre carte a ete deja desactiver`
                            ),
                        console.log(error);
                    });
                },
                allowOutsideClick:()=> !Swal.isLoading(),
                backdrop: `rgba(0,0,123,0.4)`,
              }).then((result) => {
                if (result.isConfirmed) {
                    console.log(result.value)
                  Swal.fire(
                    'Bloquer!',
                    `${result.value.message}`,
                    'success'
                  ).then((result)=>{
                        if(result.isConfirmed){
                            window.location.reload()
                        }
                    })
                }
              })
        });

    </script>
@endsection
