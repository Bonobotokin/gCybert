@extends('layouts.app')
@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
    <div class="data-table-list">
        <div class="basic-tb-hd">
            <h2>Livre de caisse</h2>
        </div>
        <div class="btn-list">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #2196F3;">
                        <div class="website-traffic-ctn">
                            <p class="text-center" style="color:white">Encaissement</p>
                            <h2 style="color:white"><span class="counter" style="color:white"> {{ $encaissement }} </span>Ar</h2>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #8b0c29;">
                        <div class="website-traffic-ctn">
                            <p class="text-center" style="color:white">Decaissement</p>
                            <h2 style="color:white"><span class="counter" style="color:white"> {{ $decaissement }} </span>Ar</h2>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #0ca3b3;">
                        <div class="website-traffic-ctn">
                            <p class="text-center" style="color:white">Solde</p>
                            <h2 style="color:white"><span class="counter" style="color:white"> {{ $solde }} </span>Ar</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive mg-t-10">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nnumero</th>
                        <th> Type </th>
                        <th> facture </th>
                        <th> Montant </th>
                        <th> Date </th>
                        <th class="text-center"> Action </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($livreCaisse as $data)
                    <tr>
                        <td> {{ $data['numero'] }} </td>
                        <td> {{ $data['type'] }} </td>
                        <td> {{ $data['nume_facture'] }} </td>
                        <td> {{ $data['montant'] }} </td>
                        <td> {{ $data['date'] }} </td>
                    </tr>
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

    function getEmail() {
        var pseudo = document.getElementById("pseudo");
        var email = document.getElementById("email");

        email.value = pseudo.value + "@cybert.app"
    }
</script>
@endsection