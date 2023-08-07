<?php

namespace App\Http\Controllers;

use App\Action\PayementAction;
use App\Repository\EncaissementRepository;
use App\Repository\ServicesRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EncaissementController extends Controller
{
    //
    private $encaissementRepository;
    private $servicesRepository;

    public function __construct(
        EncaissementRepository $encaissementRepository,
        ServicesRepository $servicesRepository
    )
    {
        $this->encaissementRepository = $encaissementRepository;
        $this->servicesRepository = $servicesRepository;
    }

    public function index()
    {
        $default = $this->encaissementRepository->getDefault();
        $recette = $this->encaissementRepository->getSumEncaissement();
        $credit = $this->encaissementRepository->getAllSumReste();
        
        return view('caisse.encaissement', 
                    [
                        'default' => $default,
                        'recette' => $recette,
                        'credit' => $credit
                    ]
                );
    }

    public function storeDebutJournee(Request $request, PayementAction $action) : RedirectResponse
    {
        
        $response =  $action->saveDebutJourney($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }


    public function storeFinJournee(PayementAction $action) : RedirectResponse
    {
        $response =  $action->saveFinJourney();
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    
}
