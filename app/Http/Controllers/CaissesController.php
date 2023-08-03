<?php

namespace App\Http\Controllers;

use App\Action\CaissesAction;
use App\Http\Requests\StoreDefaultCaissesRequest;
use App\Repository\CaisseRepository;
use App\Repository\EncaissementRepository;
use App\Repository\ServicesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CaissesController extends Controller
{
    //
    private $encaissementRepository;
    private $servicesRepository;
    private $caisseRepository;

    public function __construct(
        EncaissementRepository $encaissementRepository,
        ServicesRepository $servicesRepository,
        CaisseRepository $caisseRepository
    )
    {
        $this->encaissementRepository = $encaissementRepository;
        $this->servicesRepository = $servicesRepository;
        $this->caisseRepository = $caisseRepository;
    }

    public function livreCaisse() : View
    {
        $encaissement = $this->caisseRepository->getSumEncaissement();
        $decaissement = $this->caisseRepository->getSumDecaissement();
        $solde = $this->caisseRepository->getSolde();
        $livreCaisse = $this->caisseRepository->getCaisse();
        
        return view('caisse.livreCiasse',
                    [
                        'encaissement' => $encaissement,
                        'decaissement' => $decaissement,
                        'solde' => $solde,
                        'livreCaisse' => $livreCaisse
                    ]
                );
    }

    public function store(StoreDefaultCaissesRequest $request, CaissesAction $action) : RedirectResponse
    {
        $response =  $action->saveDefault($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('parametres.caisse',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }
}
