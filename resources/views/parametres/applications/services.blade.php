<div class="btn-list">

    <button type="button" class="btn btn-primary waves-effect " data-toggle="modal" data-target="#newServices">Noveaux Services</button>
</div>
<div class="table-responsive mg-t-10">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> num </th>
                <th> Designation </th>
                <th> Materiels </th>
                <th> Prix </th>
                <th> Createur </th>
                <th> Date </th>
                <th class="text-center"> Action </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($liste as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['designation']}}</td>
                <td> {{$data['materiels']}} </td>
                <td>{{$data['prix']}} Ar</td>
                <td>{{$data['personnel']}} </td>
                <td>{{$data['date']}} </td>
                <td class="material-design-btn text-center">
                    <button type="button" class="btn notika-btn-indigo waves-effect" data-toggle="modal" data-target="#updateService_{{$data['id']}}">Modifier</button>
                    <button type="button" class="btn notika-btn-red waves-effect" data-toggle="modal" data-target="#deleteService_{{$data['id']}}">Supprimer</button>

                </td>
            </tr>

            <div class="modal fade" id="updateService_{{$data['id']}}" role="dialog">
                <div class="modal-dialog modal-large">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h2>Mises a jour de {{$data['designation']}}</h2>
                            <form class="form-sample" action="{{ route('update.service', $data['id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="notika-icon notika-edit"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" id="inputService" name="designation" class="form-control" placeholder="designation" value="{{$data['designation']}}" />


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
                                                    @foreach ($materiels as $valeu)
                                                    @if ($valeu['designation'] == $data['materiels'])
                                                    <option selected value="{{$valeu['id']}}">{{$valeu['designation']}}</option>
                                                    @else
                                                    <option value="{{$valeu['id']}}">{{$valeu['designation']}}</option>
                                                    @endif
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
                                                <input type="text" name="prix" class="form-control" value="{{$data['prix']}}" placeholder="prix">
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


            <!-- Supression -->
            <div class="modal fade" id="deleteService_{{$data['id']}}" role="dialog">
                <div class="modal-dialog modal-large">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form class="form-sample" action="{{ route('delete.service', $data['id']) }}" method="POST">
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