<?php

namespace App\Http\Controllers;

use App\Action\DecaissementAction;
use App\Http\Requests\StoreDecaissmentRequest;
use App\Repository\CaisseRepository;
use App\Repository\DecaissementRepository;
use App\Repository\MaterielsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DecaissementController extends Controller
{
    //
    private $materielsRepository;
    private $caisseRepository;
    private $decaissementRepository;

    public function __construct(

        MaterielsRepository $materielsRepository,
        CaisseRepository $caisseRepository,
        DecaissementRepository $decaissementRepository
    ) {
        $this->materielsRepository = $materielsRepository;
        $this->caisseRepository = $caisseRepository;
        $this->decaissementRepository = $decaissementRepository;
    }

    public function decaissement()
    {
        $materiels = $this->materielsRepository->getAll();
        $decaissement = $this->decaissementRepository->getSumDecaissement();
        $decaissementListe = $this->decaissementRepository->getAll();
        // dd($decaissementListe);
        return view(
            'caisse.decaissement',

            [

                'materiels' => $materiels,
                'decaissement' => $decaissement,
                'decaissementListe' => $decaissementListe,
            ]

        );
    }

    public function store(StoreDecaissmentRequest $request, DecaissementAction $action) : RedirectResponse
    {
        $response =  $action->saveDecaissment($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('decaissement',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }
}
