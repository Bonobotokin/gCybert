<div class="btn-list">

    <button type="button" class="btn btn-info waves-effect " data-toggle="modal" data-target="#newMateriels">Noveaux materiels</button>
</div>
<div class="table-responsive mg-t-10">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> num </th>
                <th> Designation </th>
                <th> Conditionnement </th>
                <th> Totale </th>
                <th> Createur </th>
                <th> Date </th>
                <th class="text-center"> Action </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($materiels as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['designation']}}</td>
                <td>{{$data['conditionnement']}}</td>
                <td>{{$data['totale']}} </td>
                <td>{{$data['personnel']}} </td>
                <td>{{$data['date']}} </td>
                <td class="material-design-btn text-center">
                    <button type="button" class="btn notika-btn-indigo waves-effect" data-toggle="modal" data-target="#updateMateriels_{{$data['id']}}">Modifier</button>
                    <button type="button" class="btn notika-btn-red waves-effect" data-toggle="modal" data-target="#deleteMateriels_{{$data['id']}}">Supprimer</button>

                </td>
            </tr>
            <!-- update materiels -->

            <div class="modal fade" id="updateMateriels_{{$data['id']}}" role="dialog">
                <div class="modal-dialog modal-large">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h2>Modifier de {{$data['designation']}}</h2>
                            <form class="form-sample" action="{{ route('update.materiels', $data['id']) }}" method="POST">
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
                                                <input type="text" name="totale" class="form-control  @error('totale') is-invalid @enderror" value="{{$data['totale']}}" placeholder="totale">
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

            <!-- Supression -->
            <div class="modal fade" id="deleteMateriels_{{$data['id']}}" role="dialog">
                <div class="modal-dialog modal-large">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form class="form-sample" action="{{ route('delete.materiels', $data['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>Vous voullez supprimer {{$data['designation']}} </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                            <i class="mdi mdi-account-multiple-minus "></i>
                                            Non
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            <i class="mdi mdi-account-check "></i>
                                            Oui
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