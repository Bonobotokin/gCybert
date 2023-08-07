@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert-list">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="notika-icon notika-close"></i></span>
                </button>
                <strong>Bienvenue, </strong> <a href="" class="alert-link">Sur votre Poste de travaille.</a>
            </div>
        </div>
    </div>
</div>

@php
$user = auth()->user();
$userRole = auth()->user()->role;
@endphp
@if ($userRole == 0)
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>Caisse</h2>
            </div>
            <div class="btn-list">
                <div class="row">
                    <a href="{{route('encaissement')}}" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #2196F3;">
                            <div class="website-traffic-ctn">
                                <p class="text-center" style="color:white">Encaissement</p>
                                <h2 style="color:white"><span class="counter" style="color:white"> {{ $encaissement }} </span>Ar</h2>

                            </div>
                        </div>
                    </a>
                    <a href="{{route('decaissement')}}" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #8b0c29;">
                            <div class="website-traffic-ctn">
                                <p class="text-center" style="color:white">Decaissement</p>
                                <h2 style="color:white"><span class="counter" style="color:white"> {{ $decaissement }} </span>Ar</h2>

                            </div>
                        </div>
                    </a>
                    <a href="{{route('livreCaisse')}}" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #0ca3b3;">
                            <div class="website-traffic-ctn">
                                <p class="text-center" style="color:white">Solde</p>
                                <h2 style="color:white"><span class="counter" style="color:white"> {{ $solde }} </span>Ar</h2>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
            <div class="rc-it-ltd">
                <div class="recent-items-ctn">
                    <div class="recent-items-title">
                        <h2>Dernier Action dans l'encaissement</h2>
                    </div>
                </div>
                <div class="recent-items-inn table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Montant</th>
                                <th>Reste</th>
                                <th style="width: 60px">Etat</th>
                                <th>Personnel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yesterDayEncaissement as $key => $data)
                            <tr>
                                <td class="f-500 c-cyan">{{ $data['description'] }}</td>
                                <td>{{ $data['montant'] }}Ar</td>
                                <td class="f-500 c-cyan">{{ $data['montant'] }}Ar</td>
                                <td class="material-design-btn ">
                                    @if ($data['etat'] == " " || $data['etat'] == 0)
                                    <button class="btn notika-btn-deeporange waves-effect">Ouverture</button>
                                    @elseif ($data['etat'] == 1)
                                    <button class="btn notika-btn-red waves-effect">Non payer</button>
                                    @elseif ($data['etat'] == 2)
                                    <button class="btn notika-btn-purple waves-effect">Reste non payer</button>
                                    @elseif ($data['etat'] == 3)
                                    <button class="btn notika-btn-lightgreen waves-effect">Payer mais avec reste</button>
                                    @elseif ($data['etat'] == 4)
                                    <button class="btn notika-btn-lightgreen waves-effect">Payer</button>
                                    @endif
                                </td>
                                <td class="f-500 c-cyan">{{ $data['salarier'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
            <div class="rc-it-ltd">
                <div class="recent-items-ctn">
                    <div class="recent-items-title">
                        <h2>Etat de caisse Mensuel</h2>
                    </div>
                </div>
                <div class="recent-items-inn table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Annee</th>
                                <?php
                                // Récupérer l'année actuelle ou spécifier une année particulière

                                // Boucle pour afficher les noms des mois de l'année
                                for ($mois = 1; $mois <= 12; $mois++) {
                                    $nomMois = date('F', mktime(0, 0, 0, $mois, 1));
                                ?>
                                    <th><?= $nomMois ?></th>
                                <?php

                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($annee as $anneeMois)
                            <tr>
                                <td>{{ $anneeMois->annee }}</td>
                                @for ($mois = 1; $mois <= 12; $mois++) <td>
                                    @if ($anneeMois->mois == $mois)
                                    {{ $anneeMois->montant }}Ar
                                    @endif
                                    </td>
                                    @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
            <div class="rc-it-ltd">
                <div class="recent-items-ctn">
                    <div class="recent-items-title">
                        <h2>Personnel Payement</h2>
                    </div>
                </div>
                <div class="recent-items-inn table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Annee</th>
                                <?php
                                // Récupérer l'année actuelle ou spécifier une année particulière

                                // Boucle pour afficher les noms des mois de l'année
                                for ($mois = 1; $mois <= 12; $mois++) {
                                    $nomMois = date('F', mktime(0, 0, 0, $mois, 1));
                                ?>
                                    <th><?= $nomMois ?></th>
                                <?php

                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($annePersonnel as $anneeMois)
                            <tr>
                                <td> {{ $anneeMois->nom_personnel }} </td>
                                <td>{{ $anneeMois->annee }}</td>
                                @for ($mois = 1; $mois <= 12; $mois++) <td>
                                    @if ($anneeMois->mois == $mois)
                                    {{ $anneeMois->montant }}Ar
                                    @endif
                                    </td>
                                    @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if ($userRole == 1)
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="recent-items-wp notika-shadow sm-res-mg-t-30">
            <div class="rc-it-ltd">
                <div class="recent-items-ctn">
                    <div class="recent-items-title">
                        <h2>Dernier Action dans l'encaissement</h2>
                    </div>
                </div>
                <div class="recent-items-inn table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Montant</th>
                                <th>Reste</th>
                                <th style="width: 60px">Etat</th>
                                <th>Personnel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($yesterDayEncaissement as $key => $data)
                            <tr>
                                <td class="f-500 c-cyan">{{ $data['description'] }}</td>
                                <td>{{ $data['montant'] }}Ar</td>
                                <td class="f-500 c-cyan">{{ $data['montant'] }}Ar</td>
                                <td class="material-design-btn ">
                                    @if ($data['etat'] == " " || $data['etat'] == 0)
                                    <button class="btn notika-btn-deeporange waves-effect">Ouverture</button>
                                    @elseif ($data['etat'] == 1)
                                    <button class="btn notika-btn-red waves-effect">Non payer</button>
                                    @elseif ($data['etat'] == 2)
                                    <button class="btn notika-btn-purple waves-effect">Reste non payer</button>
                                    @elseif ($data['etat'] == 3)
                                    <button class="btn notika-btn-lightgreen waves-effect">Payer mais avec reste</button>
                                    @elseif ($data['etat'] == 4)
                                    <button class="btn notika-btn-lightgreen waves-effect">Payer</button>
                                    @endif
                                </td>
                                <td class="f-500 c-cyan">{{ $data['salarier'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('script')

<script src="{{ asset ('assets/js/chosen/chosen.jquery.js')}}"></script>
<script src="{{ asset ('assets/js/data-table/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset ('assets/js/data-table/data-table-act.js')}}"></script>


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
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "order": [
                [1, "desc"]
            ],
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md4:eq(0)');
    });
</script>
<script>
    window.onload = () => {
        var currentUrl = window.location.href.split('/')[3]
        console.log(currentUrl);
        if (currentUrl == "home") {
            var homes = document.getElementById("homes");
            var Home = document.getElementById("Home");
            homes.setAttribute('class', 'active');
            Home.setAttribute('class', 'tab-pane in active notika-tab-menu-bg animated flipInX');
        } else if (currentUrl == "caisse") {
            var Caisses = document.getElementById("Caisses");
            var Caisse = document.getElementById("Caisse");
            Caisses.setAttribute('class', 'active');
            Caisse.setAttribute('class', 'tab-pane in active notika-tab-menu-bg animated flipInX');
        } else if (currentUrl == "parametres") {
            var Settings = document.getElementById("Settings");
            var Parametres = document.getElementById("Parametres");
            Settings.setAttribute('class', 'active');
            Parametres.setAttribute('class', 'tab-pane in active notika-tab-menu-bg animated flipInX');
        }
    };
</script>
@endsection