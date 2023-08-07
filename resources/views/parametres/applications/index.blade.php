@extends('layouts.app')
@section('title')
Parametres
@endsection
@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="autocomplet.css">
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
            <select style="display:none" name="" id="listeService">
                @foreach ($liste as $service)
                <option value="{{$service['designation']}}">{{$service['designation']}}</option>
                @endforeach
            </select>

            <select style="display:none" name="" id="listeMateriels">
                @foreach ($materiels as $datamateriels)
                <option value="{{$datamateriels['designation']}}">{{$datamateriels['designation']}}</option>
                @endforeach
            </select>
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
                                    <input type="text" id="inputService" name="designation" class="form-control" placeholder="designation" />


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
                                    <input type="text" id="inputMateriels" name="designation" class="form-control" placeholder="designation" />
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
<script>
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }


    /*An array containing all the country names in the world:*/

    var tableauValeurs = [];
    var tableauxMateriels = [];

    // Récupérer le sélecteur HTML
    var selectElement = document.getElementById("listeService");
    var selectElementMateriels = document.getElementById("listeMateriels");


    // Parcourir les options et ajouter les valeurs au tableau
    for (var i = 0; i < selectElement.options.length; i++) {
        tableauValeurs.push(selectElement.options[i].value);
    }

    for (var j = 0; j < selectElementMateriels.options.length; j++) {
        tableauxMateriels.push(selectElementMateriels.options[j].value);
    }

    var service = tableauValeurs;
    var materiels = tableauxMateriels;

    /*initiate the autocomplete function on the "inputService" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete(document.getElementById("inputService"), service);
    autocomplete(document.getElementById("inputMateriels"), materiels);
</script>
@endsection