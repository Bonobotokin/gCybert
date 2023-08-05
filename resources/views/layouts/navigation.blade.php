<div class="main-menu-area mg-tb-20">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                    <li id="homes"><a href="{{ route('dashboard') }}"><i class="notika-icon notika-house"></i>tableaux de bord</a>
                    </li>
                    <li id="Caisses"><a data-toggle="tab" href="#Caisse"><i class="notika-icon notika-edit"></i>Caisse</a>
                    </li>
                    <li id="Ressources"><a data-toggle="tab" href="#RH"><i class="notika-icon notika-support"></i>Ressources hummaine</a>
                    </li>
                    <li id="Stock"><a data-toggle="tab" href="#Magasin"><i class="notika-icon notika-edit"></i>Magasin</a>
                    </li>
                    <li id="Settings"><a data-toggle="tab" href="#Parametres"><i class="notika-icon notika-settings"></i> Parametres</a>
                    </li>
                </ul>
                <div class="tab-content custom-menu-content">

                    <div id="Caisse" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('payement')}}">Payement</a>
                            </li>
                            <li><a href="{{route('encaissement')}}">Encaissement</a>
                            </li>
                            <li><a href="{{route('decaissement')}}">Decaissement</a>
                            </li>
                            <li><a href="{{route('livreCaisse')}}">Livres de caisse</a>
                            </li>
                        </ul>
                    </div>
                    <div id="RH" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('personnel.liste')}}">Personnel</a>
                            </li>
                            <li><a href=" {{ route('personnel.payement')}}"> Payement </a>
                            </li>
                        </ul>
                    </div>
                    <div id="Magasin" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{route('stock')}}">Stock</a>
                            </li>
                            <li><a href=" {{ route('etatStock') }} ">Etat de Stock</a>
                            </li>
                        </ul>
                    </div>
                    <div id="Parametres" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <!-- <li><a href="{{route('parametres.personnel')}}">Personnel</a>
                            </li> -->
                            <li><a href="{{route('parametres.application')}}">Applications</a>
                            </li>
                            <!-- <li><a href="{{route('parametres.caisse')}}">Caisses</a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
