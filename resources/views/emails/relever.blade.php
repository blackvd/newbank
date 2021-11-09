<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>NewBank || Relever</title>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
</head>

<body class="sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="140">
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
        <!--  BEGIN CONTENT AREA  -->
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Relever Banquaire NewBank du compte : {{$compte->numero_compte}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-4">
                                    <thead>
                                        <tr>
                                            <th> Date </th>
                                            <th> Ref </th>
                                            <th> Credit </th>
                                            <th> Solde </th>
                                            <th> Agent </th>
                                            <th> Libelle </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($trans) < 1)
                                            <tr>
                                                <td colspan="6" class="text-center">Aucune donnee pour cette periode</td>
                                            </tr>
                                        @else
                                            @foreach ($trans as $item)
                                                <tr>
                                                    <td>{{ $item->from_date }}</td>
                                                    <td>{{ $item->ref }}</td>
                                                    <td>{{ $item->credit }}</td>
                                                    <td>{{ $item->solde }}</td>
                                                    <td>
                                                        @if ($item->agent == 0)
                                                        proprietaire du compte
                                                        @else
                                                        {{ $item->admin->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->libelle }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function () {
            App.init();
        });
    </script>
    <script src="plugins/highlight/highlight.pack.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="assets/js/scrollspyNav.js"></script>
    
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>

</html>