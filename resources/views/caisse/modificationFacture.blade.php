@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset ('assets/css/jquery.dataTables.min.css')}}">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-t-10">
        <div class="data-table-list">
            <div class="basic-tb-hd">
                <h2>Modification du facture</h2>
            </div>
            <form class="form-sample" action="{{ route('save.payement.mutiple') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calculator"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" id="nombreFormulaire" class="form-control" value="" placeholder="nombre de facture " />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calculator"></i>
                            </div>
                            <div class="nk-int-st">
                                <input type="text" id="client" value="{{$factureById['client']}}" name="client" class="form-control @error('client') is-invalid @enderror" :value="{{ old('client') }}" placeholder="client " autocomplete="client" />

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group ic-cmp-int">
                            <div class="form-ic-cmp">
                                <i class="notika-icon notika-calculator"></i>
                            </div>
                            <div class="nk-int-st">
                                <select name="personnels" id="" class="form-control">
                                    @foreach ($liste as $data)
                                    @if ($data['id'] == $factureById['personnel_id'])

                                    <option value="{{$data['id']}}">{{ $data['nom'] }}</option>
                                    @else
                                    <option value="{{$data['id']}}">{{ $data['nom'] }}</option>

                                    @endif
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($facture as $key => $datas)
                <input type="hidden" name="nombrePayement" value="{{ $key }}">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group ic-cmp-int">
                        <div class="form-ic-cmp">
                            <!-- <i class="notika-icon notika-calculator"></i> -->
                        </div>
                        <div class="nk-int-st">
                            <select class="form-control" name="{{ $key }}[service]">
                                <option value="">Service</option>
                                @foreach ($service as $data)
                                @if ($datas['service'] == $data['designation'])
                                <option selected value="{{ $data['id'] }}">{{ $data['designation'] }}</option>
                                @else
                                <option value="{{ $data['id'] }}">{{ $data['designation'] }}</option>
                                @endif
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
                            <input type="number" id="quantite" name="{{ $key }}[quantite]" class="form-control @error('quantite') is-invalid @enderror" value="{{ $datas['quantite'] }}" placeholder="quantite ou pages" autocomplete="quantite" />
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="row mg-t-10">
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

@endsection



@section('script')


<script>
    function getMontatnQuantite() {
        var quantite = document.getElementById("quantite");
        var montant = document.getElementById("montant");

        montant.value = quantite.value + "@cybert.app"
    }
</script>
@endsection