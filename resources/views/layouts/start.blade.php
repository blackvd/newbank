<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} | Ouvrir un compte</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/jquery-step/jquery.steps.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('plugins/autocomplete/autocomplete.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('plugins/sweetalerts/promise-polyfill.js')}}"></script>
    <link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #formValidate .wizard > .content {min-height: 25em;}
        #example-vertical.wizard > .content {min-height: 24.5em;}
        .wizard > .content{
            background: transparent;
        }
    </style>
    <!--  END CUSTOM STYLE FILE  -->
</head>
<body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="100">

    <div class="main-container" id="container">

        <div class="overlay"></div>

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <div class="title">
                            <h3>NewBank</h3>
                        </div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"  aria-current="page"><a href="javascript:void(0);">Ouvrir un compte</a></li>
                        </ol>
                    </nav>
                </div>
                
                @yield('content')
            </div>
        </div>
    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="{{asset('plugins/jquery-step/jquery.steps.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-step/custom-jquery.steps.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/autocomplete/jquery.mockjax.js')}}"></script>
    <script src="{{asset('plugins/autocomplete/jquery.autocomplete.js')}}"></script>
    <script src="{{asset('plugins/autocomplete/countries.js')}}"></script>
    <script src="{{asset('plugins/autocomplete/demo.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/input-mask/input-mask.js')}}"></script>
    <script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalerts/sweetalert2.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalerts/custom-sweetalert.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        //First upload
        var photo = new FileUploadWithPreview('photo')
        var photoPieceRecto = new FileUploadWithPreview('photoPieceRecto')
        var photoPieceVerso = new FileUploadWithPreview('photoPieceVerso')
        var factureEau = new FileUploadWithPreview('factureEau')
        var factureElectricite = new FileUploadWithPreview('factureElectricite')
        var certificatResi = new FileUploadWithPreview('certificatResi')
        var signature = new FileUploadWithPreview('signature')
    </script>
</body>
</html>