@extends('layouts.app')
@section('style')
@endsection
@section('content')
@if (session('status'))
<div class="alertDanger">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <strong>Danger!</strong> Erreur.

    {{ session('status') }}
</div>
@endif
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert-list">
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="notika-icon notika-close"></i></span>
                </button>
                <strong>Bienvenue, </strong> <a href="" class="alert-link">Sur votre Poste de travaille.</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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
</script>
@endsection