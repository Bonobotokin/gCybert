@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>Journale de caisse </h2>
            </div>
            <div class="btn-list">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row">

                            <div class="col-lg-4">
                                <button id="btnStart" type="button" class="btn btn-success waves-effect " data-toggle="modal" data-target="#debut">Debut de la journee</button>
                            </div>
                            <div class="col-lg-4">
                                <button id="btnpayed" type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newPayedMultiple">Multiple Payement</button>
                            </div>
                            <div class="col-lg-4">

                                <form action="{{route('finJourney')}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger waves-effect " data-toggle="modal" data-target="#fin">Fin de la journee</button>
                                </form>
                            </div>
                            <!-- <button id="btnpayed" type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newPayed">Simple Payement </button> -->
                            
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #e31a6e;">
                            <div class="website-traffic-ctn">
                                <p class="text-center" style="color:white">credit</p>
                                <h2 style="color:white"><span class="counter" style="color:white"> {{ $credit }} </span>Ar</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #2196F3;">
                            <div class="website-traffic-ctn">
                                <p class="text-center" style="color:white">Recette</p>
                                <h2 style="color:white"><span class="counter" style="color:white"> {{ $recette }} </span>Ar</h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive mg-t-10">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Heure </th>
                            <th> Salarier </th>
                            <th> Description </th>
                            <th> Quantite </th>
                            <th> Montant </th>
                            <th> Payer </th>
                            <th> Reste </th>
                            <th> Etat</th>
                            <th> Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payementToday as $key => $data)
                        <tr>
                            <td> {{$data['heure']}} </td>
                            <td> {{ $data['salarier'] }}</td>
                            <td> {{ $data['description'] }} </td>
                            <td> {{ $data['quantite'] }} </td>
                            <td> {{ $data['montant'] }} Ar</td>
                            <td> {{ $data['payer'] }} Ar</td>
                            <td> {{ $data['reste'] }} Ar</td>
                            <td class="material-design-btn">
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
                                @elseif ($data['etat'] == 5)
                                <button class="btn notika-btn-green waves-effect">Fermeture</button>
                                @endif
                            </td>
                            <td class="material-design-btn">
                                @if ($data['etat'] == 0 || $data['etat'] == 3 || $data['etat'] == 4 || $data['etat'] == 5)
                                <button class="btn notika-btn-indigo btn-reco-mg btn-button-mg waves-effect">Modifier</button>

                                @else
                                <button data-toggle="modal" data-target="#payed_{{ $data['numero'] }}" class="btn notika-btn-purple btn-reco-mg btn-button-mg waves-effect">Payer</button>
                                <button class="btn notika-btn-indigo btn-reco-mg btn-button-mg waves-effect">Modifier</button>
                                @endif

                            </td>
                        </tr>

                        <div class="modal fade" id="payed_{{ $data['numero'] }}" role="dialog">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>Payement de la facture de {{ $data['client'] }}</h5>
                                        <form class="form-sample" action="{{ route('payed.payement') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data['numero']}}">
                                            <input type="hidden" name="client" value="{{$data['client']}}">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group ic-cmp-int">
                                                        <div class="form-ic-cmp">
                                                            <!-- <i class="notika-icon notika-calculator"></i> -->
                                                        </div>
                                                        <div class="nk-int-st">
                                                            <input type="text" id="montant" name="montant" class="form-control @error('montant') is-invalid @enderror" value="<?php if ($data['reste'] == 0.0) {
                                                                                                                                                                                    echo $data['montant'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo $data['reste'];
                                                                                                                                                                                } ?>" placeholder="montant Payer" autocomplete="client" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                                        <i class="mdi mdi-account-multiple-minus "></i>
                                                        Annuler
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                                        <i class="mdi mdi-account-check "></i>
                                                        Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('modal')
<div class="modal fade" id="debut" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Debut de la journee</h2>
                <form class="form-sample" action="{{ route('debutJourney') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-dollar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="montant" class="form-control  @error('montant') is-invalid @enderror" :value="{{ old('montant') }}" placeholder="montants">
                                    @error('montant')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                <i class="mdi mdi-account-multiple-minus "></i>
                                Annuler
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="mdi mdi-account-check "></i>
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newPayedMultiple" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Noueaux Payement</h5>
                <form class="form-sample" action="{{ route('save.payement.mutiple') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" id="nombreFormulaire" class="form-control" placeholder="nombre de facture " />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" id="client" name="client" class="form-control @error('client') is-invalid @enderror" :value="{{ old('client') }}" placeholder="client " autocomplete="client" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <select name="personnels" id="" class="form-control">
                                        <option value=" ">personnels</option>
                                        @foreach ($liste as $data)
                                        <option value="{{$data['id']}}">{{ $data['nom'] }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="elementFormulaire">

                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="material-design-btn">
                                <button type="button" onclick="addNewPayement()" class="btn notika-btn-teal waves-effect">confirmer</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mg-t-10">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                <i class="mdi mdi-account-multiple-minus "></i>
                                Annuler
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="mdi mdi-account-check "></i>
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newPayed" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Noueaux Payement</h5>
                <form class="form-sample" action="{{ route('save.payement') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <!-- <i class="notika-icon notika-calculator"></i> -->
                                </div>
                                <div class="nk-int-st">
                                    <select class="form-control" name="service">
                                        <option value="">Service</option>
                                        @foreach ($service as $data)
                                        <option value="{{$data['id']}}">{{ $data['designation'] }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" id="quantite" name="quantite" class="form-control @error('quantite') is-invalid @enderror" :value="{{ old('quantite') }}" placeholder="quantite ou pages" autocomplete="quantite" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" id="client" name="client" class="form-control @error('client') is-invalid @enderror" :value="{{ old('client') }}" placeholder="client " autocomplete="client" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <select name="personnels" id="" class="form-control">
                                        <option value=" ">personnels</option>
                                        @foreach ($liste as $data)
                                        <option value="{{$data['id']}}">{{ $data['nom'] }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                <i class="mdi mdi-account-multiple-minus "></i>
                                Annuler
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="mdi mdi-account-check "></i>
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
    function getMontatnQuantite() {
        var quantite = document.getElementById("quantite");
        var montant = document.getElementById("montant");

        montant.value = quantite.value + "@cybert.app"
    }

    function addNewPayement() {
        let nombreFormulaire = document.getElementById("nombreFormulaire");


        for (let i = 0; i < nombreFormulaire.value; i++) {
            let div = document.createElement("div");
            div.class = "row";
            div.innerHTML =
                `
            <input type="hidden" name="nombrePayement" value=${nombreFormulaire.value}">
        
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group ic-cmp-int">
                    <div class="form-ic-cmp">
                        <!-- <i class="notika-icon notika-calculator"></i> -->
                    </div>
                    <div class="nk-int-st">
                        <select class="form-control" name="${i}[service]">
                            <option value="">Service</option>
                            @foreach ($service as $data)
                            <option value="{{$data['id']}}">{{ $data['designation'] }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group ic-cmp-int">
                    <div class="form-ic-cmp">
                        <i class="notika-icon notika-calculator"></i>
                    </div>
                    <div class="nk-int-st">
                        <input type="number" id="quantite" name="${i}[quantite]" class="form-control @error('quantite') is-invalid @enderror" :value="{{ old('quantite') }}" placeholder="quantite ou pages" autocomplete="quantite" />

                    </div>
                </div>
            </div>
        
        `
            document.getElementById("elementFormulaire").appendChild(div)
        }


    }
</script>
@endsection