@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
    <div class="data-table-list">
        <div class="basic-tb-hd">
            <h2>Liste des materiels en stock</h2>
        </div>
        <div class="btn-list">

            <!-- <button type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newPersonnel">Noveaux Personnel</button> -->
        </div>
        <div class="table-responsive mg-t-10">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> Code </th>
                        <th> Designation </th>
                        <th> Conditionnement </th>
                        <th> Quantite </th>
                        <th class="text-center"> Action </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($stock as $data)
                    <tr>
                        <td>{{ $data['code'] }}</td>
                        <td>{{ $data['designation'] }}</td>
                        <td>{{ $data['conditionnement'] }}</td>
                        <td>{{ $data['quantite'] }}</td>
                        <td class="material-design-btn text-center">
                            <button type="button" class="btn notika-btn-indigo waves-effect" data-toggle="modal" data-target="#approvisionnement_{{$data['code']}}">Reapprovisonnement</button>
                        </td>
                    </tr>
                    <!-- Reapprovisionnement -->

                    <div class="modal fade" id="approvisionnement_{{$data['code']}}" role="dialog">
                        <div class="modal-dialog modal-large">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <h2>Modifier de {{$data['designation']}}</h2>
                                    <form class="form-sample" action="{{ route('approvisionnement', $data['code']) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">

                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <div class="form-group ic-cmp-int">
                                                    <div class="form-ic-cmp">
                                                        <i class="notika-icon notika-edit"></i>
                                                    </div>
                                                    <div class="nk-int-st">
                                                        <input type="text" id="inputMateriels" name="designation" class="form-control" value="{{$data['designation']}}" placeholder="designation" />
                                                        @error('designation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <code>{{ $message }}</code>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <div class="form-group ic-cmp-int">
                                                    <div class="form-ic-cmp">
                                                        <i class="notika-icon notika-star"></i>
                                                    </div>
                                                    <div class="nk-int-st">
                                                        <input type="text" id="inputMaterielsCondit" name="conditionnement" class="form-control  @error('conditionnement') is-invalid @enderror" value="{{$data['conditionnement']}}" placeholder="conditionnement">
                                                        @error('conditionnement')
                                                        <span class="invalid-feedback" role="alert">
                                                            <code>{{ $message }}</code>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <div class="form-group ic-cmp-int">
                                                    <div class="form-ic-cmp">
                                                        <i class="notika-icon notika-dollar"></i>
                                                    </div>
                                                    <div class="nk-int-st">
                                                        <input type="text" name="quantite" class="form-control  @error('quantite') is-invalid @enderror" value="" placeholder="quantite">
                                                        @error('totale')
                                                        <span class="invalid-feedback" role="alert">
                                                            <code>{{ $message }}</code>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
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
                                                    Mettre a jour
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