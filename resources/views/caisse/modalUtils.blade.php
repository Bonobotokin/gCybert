<div class="modal fade" id="payed_{{ $data['numero'] }}" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Payement de la facture de {{ $data['client'] }}</h5>
                <form class="form-sample" action="{{ route('payed.payement') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$data['numero']}}">
                    <input type="hidden" name="client" value="{{$data['client']}}">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <!-- <i class="notika-icon notika-calculator"></i> -->
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" id="montant" name="montant" class="form-control @error('montant') is-invalid @enderror" value="<?php if ($data['reste'] == 0.0) {
                                                                                                                                                            echo $data['montant'];
                                                                                                                                                        } else {
                                                                                                                                                            echo $data['reste'];
                                                                                                                                                        } ?>" placeholder="montant Payer" autocomplete="client" />
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

<div class="modal fade" id="update_{{ $data['numero'] }}" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h5>Payement de la facture de {{ $data['client'] }}</h5>
                <form class="form-sample" action="{{ route('update.payement', $data['numero'] ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$data['numero']}}">
                    <input type="hidden" name="client" value="{{$data['client']}}">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group ic-cmp-int">
                                <div class="form-ic-cmp">
                                    <!-- <i class="notika-icon notika-calculator"></i> -->
                                </div>
                                <div class="nk-int-st">
                                    <input type="text" id="montant" name="montant" class="form-control" value="{{ $data['montant'] }}" placeholder="montant Payer" />
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

<!-- Supression -->
<div class="modal fade" id="delete_{{$data['numero']}}" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form class="form-sample" action="{{ route('delete.payement', $data['numero']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                        <div class="col-lg-12">
                        <p>Vous voullez supprimer le {{$data['description']}} creer par {{$data['salarier']}} </p>
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