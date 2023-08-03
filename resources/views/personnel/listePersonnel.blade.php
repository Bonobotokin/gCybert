@extends('layouts.app')


@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>Liste Personnels</h2>
            </div>
            <div class="btn-list">

                <button type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newPersonnel">Noveaux Personnel</button>
            </div>
            <div class="table-responsive mg-t-10">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Image </th>
                            <th> Nom & prenom </th>
                            <th> Telephone </th>
                            <th> Adresse </th>
                            <th class="text-center"> Action </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($liste as $personnel)
                        <tr>
                            <td class="py-1">
                                @if($personnel['sexe'] == FALSE)
                                <img src="{{asset('assets/images/faces-clipart/pic-3.png')}}" alt="image">
                                @else
                                <img src="{{asset('assets/images/faces-clipart/pic-8.png')}}" alt="image">
                                @endif
                            </td>
                            <td> {{$personnel['nom']}} </td>
                            <td> +261 {{$personnel['telephone']}} </td>
                            <td> {{$personnel['adresse']}} </td>
                            <td class="material-design-btn">

                                <a class="btn notika-btn-cyan waves-effect">Details</a>
                                <a class="btn notika-btn-indigo waves-effect">Modifier</a>
                                <a class="btn notika-btn-red waves-effect">Supprimer</a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th> Image </th>
                            <th> Nom & prenom </th>
                            <th> Telephone </th>
                            <th> Adresse </th>
                            <th class="text-center"> Action </th>
                        </tr>
                    </tfoot>
                </table>
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