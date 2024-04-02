@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">

@endsection


@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2> Liste des payement de personnel </h2>
            </div>
            <div class="btn-list">
                <div class="row">
                    <div class="col-lg-4">
                        <button id="btnpayed" type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newPayed">Nouveaux Payement </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive mg-t-10">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Date </th>
                            <th> Personnel </th>
                            <th> Observation </th>
                            <th> Salaire </th>
                            <th> Payer </th>
                            <th> Reste </th>
                            <th> Etat</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    @foreach ($payementListe as $payement)
                    <tr>
                        <td> {{$payement['date']}} </td>
                        <td>
                            @if($payement['sexe'] == FALSE)
                            <img src="{{asset('assets/images/faces-clipart/pic-3.png')}}" alt="image">
                            @else
                            <img src="{{asset('assets/images/faces-clipart/pic-8.png')}}" alt="image">
                            @endif
                            {{$payement['personnel']}}
                        </td>
                        <td> {{$payement['observation']}} </td>
                        <td> {{$payement['salaire']}} </td>
                        <td> {{$payement['payement']}} </td>
                        <td> {{$payement['reste']}} </td>
                        <td class="material-design-btn">
                            @if ($payement['etat'] == 0)
                            <button class="btn notika-btn-red waves-effect">Non payer</button>
                            @elseif ($payement['etat'] == 1)
                            <button class="btn notika-btn-lightgreen waves-effect">Payer</button>
                            @endif
                        </td>
                        <td class="material-design-btn">

                            @if ($payement['etat'] == 0)
                            <form class="form-sample" action="{{ route('payement.validate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$payement['numero']}}">
                                <button type="submit" class="btn notika-btn-purple btn-reco-mg btn-button-mg waves-effect">Payer</button>
                            </form>
                            @elseif ($payement['etat'] == 1)
                            <button class="btn notika-btn-indigo btn-reco-mg btn-button-mg waves-effect">Modifier</button>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('modal')

<div class="modal fade" id="newPayed" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Noueaux Payement</h5>
                <form class="form-sample" action="{{ route('payement.personnel') }}" method="POST">
                    @csrf
                    <div class="row">

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
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" name="payement" class="form-control" placeholder="montant" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="observation" class="form-control" placeholder="observation" autocomplete="client" />

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
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>


<script>
    function getEmail() {
        var pseudo = document.getElementById("pseudo");
        var email = document.getElementById("email");

        email.value = pseudo.value + "@cybert.app"
    }
</script>
@endsection