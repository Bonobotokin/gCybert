@extends('layouts.app')
@section('content')

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
    <div class="data-table-list">
        <div class="basic-tb-hd">
            <h2>Liste de Decaissement</h2>
        </div>
        <div class="btn-list">
            <div class="row">
                <div class="col-lg-6">
                    <button type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newDecaissement">Decaissement</button>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 " style="background-color: #2196F3;">
                        <div class="website-traffic-ctn">
                        <p class="text-center" style="color:white">Decaissement</p>
                            <h2 style="color:white"><span class="counter" style="color:white"> {{ $decaissement }} </span>Ar</h2>
                            
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
                        <th> Description </th>
                        <th> Quantite </th>
                        <th> Montant </th>
                        <th> creer </th>
                        <th> Date </th>
                        <th class="text-center"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($decaissementListe as $data)
                        <tr>
                            <td> {{$data['num']}} </td>
                            <td> {{$data['description']}} </td>
                            <td> {{$data['quantite']}} </td>
                            <td> {{$data['montant']}} </td>
                            <td> {{$data['personnel']}} </td>
                            <td> {{$data['date']}} </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@section('modal')
<div class="modal fade" id="newDecaissement" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Noueaux Decaissement</h5>
                <form class="form-sample" action="{{ route('save.decaissement') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" :value="{{ old('description') }}" placeholder="Description" autofocus autocomplete="description" />

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <select name="materiels" id="" class="form-control">
                                        <option value=" ">Materiels</option>
                                        @foreach ($materiels as $data)
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
                                    <input type="number" id="quantite" name="quantite" class="form-control @error('quantite') is-invalid @enderror" :value="{{ old('quantite') }}" placeholder="quantite ou pages" autofocus autocomplete="quantite" />

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calculator"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="number" id="montant" name="montant" class="form-control @error('montant') is-invalid @enderror" :value="{{ old('montant') }}" placeholder="montant" autofocus autocomplete="montant" />

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