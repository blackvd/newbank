
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo11/ui_alerts.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Apr 2021 23:22:37 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>NewBank - Message de succès</title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/elements/alert.css')}}">
    <style>
        .btn-light { border-color: transparent; }
    </style>
    <!--  END CUSTOM STYLE FILE  -->
</head>
<body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="140">

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="row layout-top-spacing">
                <div id="alertDefault" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="alert alert-light-success border-0 mb-4" role="alert"> 
                                <strong> {{$client->civilite}} {{$client->nom}} {{$client->prenoms}}, bienvenue à NewBank!</strong> votre demande d'ouverture de compte a été envoyé avec succès. Vous recevrez un mail avec differentes instructions sous peu. <br>
                                Votre numéro d'identification est le <strong>{{$client->track_id}}</strong>, vous pouvez l'utiliser pour consulter l'état de votre demande. Pour tous renseignements appelez le +225 20 27 00 00 00. <br>
                                Vous serez rédirigez dans <span id="counter">5</span> secondes
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        var i = 5;
        setInterval(function() {
            if(i !== 0){
                i--
                $('#counter').text(i)
            }else{
                window.location.replace('http://localhost:8000/login')
            }
        }, 5000)
    </script>

</body>
</html>