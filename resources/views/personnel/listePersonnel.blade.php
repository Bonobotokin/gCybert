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
                            <th> Salaire Base </th>
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
                            <td> {{$personnel['telephone']}} </td>
                            <td> {{$personnel['adresse']}} </td>
                            <td> {{ $personnel['salaire_base'] }} Ar</td>
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

@section('modal')
<div class="modal fade" id="newPersonnel" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Nouveaux Personnel</h2>
                <form class="form-sample" action="{{ route('personnel.save') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" :value="{{ old('nom') }}" placeholder="nom" autofocus autocomplete="nom" />
                                    @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <select class="form-control" name="sexe">
                                        <option>Sexe</option>
                                        <option value="0">Feminin</option>
                                        <option value="1">Masculin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="age" class="form-control  @error('age') is-invalid @enderror" :value="{{ old('age') }}" placeholder="ages">
                                    @error('age')
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
                                    <input type="number" name="salaire" class="form-control @error('salaire') is-invalid @enderror" :value="{{ old('salaire') }}" placeholder="salaire" autofocus autocomplete="salaire" />
                                    @error('salaire')
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
                                    <i class="notika-icon notika-tax"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="cin" class="form-control  @error('cin') is-invalid @enderror" :value="{{ old('cin') }}" data-mask="214 011 100 682" placeholder="cin" autofocus autocomplete="cin" />
                                    @error('cin')
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
                                    <i class="notika-icon notika-phone"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="telephone" class="form-control  @error('telephone') is-invalid @enderror" :value="{{ old('telephone') }}" data-mask="214 011 100 682" placeholder="telephone" autofocus autocomplete="telephone" />
                                    @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                            <div class="form-group ic-cmp-int form-elet-mg res-mg-fcs">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-house"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" :value="{{ old('adresse') }}" placeholder="adresse" autofocus autocomplete="adresse" />
                                    @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <code>{{ $message }}</code>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" name="name" id="pseudo" onkeyup="getEmail()" class="form-control @error('name') is-invalid @enderror" :value="{{ old('name') }}" placeholder="pseudo" autofocus autocomplete="name" />
                                    @error('name')
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
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" :value="{{ old('email') }}" placeholder="email" autofocus autocomplete="email" />
                                    @error('email')
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
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <input type="password" name="mdp" class="form-control @error('password') is-invalid @enderror" :value="{{ old('password') }}" placeholder="mot de passe" autofocus autocomplete="password" />
                                    @error('password')
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
                                    <i class="notika-icon notika-support"></i>
                                </div>
                                <div class="nk-int-st">
                                    <select name="role" class="form-control" id="">
                                        <option value=""> Role</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Moderateur</option>
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