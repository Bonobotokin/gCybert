@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
    <div class="data-table-list">
        <div class="basic-tb-hd">
            <h2>Parametrs > Caisses</h2>
        </div>
        <div class="btn-list">

            <button type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#caisseDefault">Caisses Default</button>
        </div>
        <div class="table-responsive mg-t-10">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th> Description </th>
                        <th> Solde </th>
                        <th> creer </th>
                        <th> Date </th>
                        <th class="text-center"> Action </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($default as $default)
                    <tr>
                        <td>Initalisation de la caisse</td>
                        <td>{{$default['solde']}} Ar</td>
                        <td>Creer par {{$default['personnel']}}</td>
                        <td>{{$default['date']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="caisseDefault" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Generer l'etat de caisse par defaut</h2>
                <form class="form-sample" action="{{ route('save.default.caisse') }}" method="POST">
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