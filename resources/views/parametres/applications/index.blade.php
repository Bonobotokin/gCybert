@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
<div class="widget-tabs-int mg-t-10">
    <div class="tab-hd">
        <h2>Parametres > Application</h2>
        <p><i>Dans ce partie vous parametrer les base de l'application</i></p>
    </div>
    <div class="widget-tabs-list">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home" aria-expanded="true">Services</a></li>
            <li class=""><a data-toggle="tab" href="#menu1" aria-expanded="false">Materiels</a></li>
            <!-- <li><a data-toggle="tab" href="#menu2">Tab Menu 3</a></li> -->
        </ul>
        <div class="tab-content tab-custom-st">
            <div id="home" class="tab-pane fade active in">
                <div class="tab-ctn">
                    @include('parametres.applications.services')
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="tab-ctn">
                    @include('parametres.applications.materiels')
                </div>
            </div>
            <!--<div id="menu2" class="tab-pane fade">
                <div class="tab-ctn">
                    <p>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nulla sit amet est. Praesent ac the massa at ligula laoreet iaculis. Vivamus aliquet elit ac nisl. Nulla porta dolor. Cras dapibus. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>
                    <p class="tab-mg-b-0">In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Nam eget dui. In ac felis quis tortor malesuadan of pretium. Phasellus consectetuer vestibulum elit. Duis lobortis massa imperdiet quam. Pellentesque commodo eros a enim. Vestibulum ante ipsum primis in faucibus orci the luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Phasellus a est. Pellentesque commodo eros a enim. Cras ultricies mi eu turpis hendrerit of fringilla. Donec mollis hendrerit risus. Vestibulum turpis sem, aliquet eget, lobortis pellentesque, rutrum eu, nisl. Praesent egestas neque eu enim. In hac habitasse plat.</p>
                </div>
            </div> -->
        </div>
    </div>
</div>

@endsection



@section('modal')
<div class="modal fade" id="newServices" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Nouveaux Services</h2>
                <form class="form-sample" action="{{ route('save.service') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" :value="{{ old('designation') }}" placeholder="designation" autofocus autocomplete="designation" />
                                    @error('designation')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <select name="materiels_id" class="form-control" id="">
                                        <option value=" "> Materiels</option>
                                        @foreach ($materiels as $data)
                                            <option value="{{$data['id']}}">{{$data['designation']}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-dollar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="prix" class="form-control  @error('prix') is-invalid @enderror" :value="{{ old('prix') }}" placeholder="prix">
                                    @error('prix')
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
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newMateriels" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Nouveaux Materiels</h2>
                <form class="form-sample" action="{{ route('save.materiels') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" :value="{{ old('designation') }}" placeholder="designation" autofocus autocomplete="designation" />
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
                                    <input type="text" name="conditionnement" class="form-control  @error('conditionnement') is-invalid @enderror" :value="{{ old('conditionnement') }}" placeholder="conditionnement">
                                    @error('conditionnement')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-dollar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="prix_vente" class="form-control  @error('prix_vente') is-invalid @enderror" :value="{{ old('prix_vente') }}" placeholder="Prix de vente">
                                    @error('prix_vente')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div> -->
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-dollar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="totale" class="form-control  @error('totale') is-invalid @enderror" :value="{{ old('totale') }}" placeholder="totale">
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