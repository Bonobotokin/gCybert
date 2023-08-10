<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset ('assets/images/cyberHub.ico')}}">
    <title>cyberHub |facture de {{$detailsTotal[0]['client']}}</title>
    <meta name="description" content="">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet"> -->
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/bootstrap.min.css')}}">
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/font-awesome.min.css')}}">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset ('assets/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{ asset ('assets/css/owl.transitions.css')}}">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/meanmenu/meanmenu.min.css')}}">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/animate.css')}}">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/normalize.css')}}">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/chosen/chosen.css')}}">
    <!-- jvectormap CSS
		============================================ -->
    <!-- <link rel="stylesheet" href="{{ asset ('assets/css/jvectormap/jquery-jvectormap-2.0.3.css')}}"> -->
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/notika-custom-icon.css')}}">



    <link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">

    <link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/wave/waves.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('assets/css/wave/button.css')}}">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/main.css')}}">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset ('assets/css/responsive.css')}}">

    <!-- modernizr JS
		============================================ -->
    <!-- <script src="{{ asset ('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script> -->
</head>
<style>
    .navbar-profile {
        display: flex;
        font-weight: normal;
        align-items: center;

    }

    .img-xs {
        width: 35px;
        height: 35px;
    }

    .rounded-circle {
        border-radius: 50% !important;
        margin: -25% 0 0 0;
    }

    .navbar-profile .navbar-profile-name {
        white-space: nowrap;
        margin-left: 1rem;
        font-size: 15px;
        color: white;
    }
</style>

<body>
    @guest
    @else
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
            <div class="data-table-list">
                <div class="basic-tb-hd">
                    <h2>Facture de {{$detailsTotal[0]['client']}} </h2>
                </div>
                <div class="table-responsive mg-t-10">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Num </th>
                                <th> Description </th>
                                <th> Quantite </th>
                                <th> Montant </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $info)
                            <tr>
                                <td colspan=""> {{$info['id']}} </td>
                                <td> {{$info['description']}} </td>
                                <td> {{$info['quantite']}} </td>
                                <td> {{$info['montant']}} </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                    <div class="col-lg-8">
                        
                    </div>
                    <div class="col-lg-4">
                        <table class="table">

                            <tfoot>
                                <tr>
                                    <th style="width: 50%;" class="text-center" colspan="3">Total</th>
                                    <th>{{$detailsTotal[0]['montant']}} Ar</th>
                                </tr>
                                <tr>
                                    <th style="width: 50%;" class="text-center" colspan="3">Payer</th>
                                    <th>{{$detailsTotal[0]['payer']}} Ar</th>
                                <tr>
                                    <th style="width: 50%;" class="text-center" colspan="3">Reste</th>
                                    <th>{{$detailsTotal[0]['reste']}} Ar</th>
                                </tr>
                                <tr>
                                    <th style="width: 50%;" class="text-center" colspan="3">Etat</th>
                                    <th class="material-design-btn">
                                        @if ($detailsTotal[0]['etat'] == " " || $detailsTotal[0]['etat'] == 0)
                                        <button class="btn notika-btn-deeporange waves-effect">Ouverture</button>
                                        @elseif ($detailsTotal[0]['etat'] == 1)
                                        <button class="btn notika-btn-red waves-effect">Non payer</button>
                                        @elseif ($detailsTotal[0]['etat'] == 2)
                                        <button class="btn notika-btn-purple waves-effect">Reste non payer</button>
                                        @elseif ($detailsTotal[0]['etat'] == 3)
                                        <button class="btn notika-btn-lightgreen waves-effect">Payer mais avec reste</button>
                                        @elseif ($detailsTotal[0]['etat'] == 4)
                                        <button class="btn notika-btn-lightgreen waves-effect">Payer</button>
                                        @elseif ($detailsTotal[0]['etat'] == 5)
                                        <button class="btn notika-btn-green waves-effect">Fermeture</button>
                                        @endif
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endguest

    <script src="{{ asset ('assets/js/chosen/chosen.jquery.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset ('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset ('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
          window.addEventListener("load", window.print());
    </script>


</body>

</html>