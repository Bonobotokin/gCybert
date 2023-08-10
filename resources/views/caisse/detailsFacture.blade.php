@extends('layouts.app')
@section('title')
facture de {{$detailsTotal[0]['client']}}
@endsection
@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">

<link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset ('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection


@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>Facture de {{$detailsTotal[0]['client']}} </h2>
                <a href="{{ route('get.print.facture', ['id' => $detailsTotal[0]['numero']]) }}" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
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

                        <tr>
                            <td class="text-right" colspan="3">Total</td>
                            <td>{{$detailsTotal[0]['montant']}} Ar</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3">Payer</td>
                            <td>{{$detailsTotal[0]['payer']}} Ar</td>
                        <tr>
                            <td class="text-right" colspan="3">Reste</td>
                            <td>{{$detailsTotal[0]['reste']}} Ar</td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="3">Etat</td>
                            <td class="material-design-btn">
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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')

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

<!-- <script src="{{ asset ('assets/dist/js/demo.js')}}"></script> -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "order": [
                [1, "desc"]
            ],
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    function getMontatnQuantite() {
        var quantite = document.getElementById("quantite");
        var montant = document.getElementById("montant");

        montant.value = quantite.value + "@cybert.app"
    }
</script>
@endsection