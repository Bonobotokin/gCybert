<?php

namespace App\Http\Controllers;

use App\Action\PersonnelAction;
use App\Http\Requests\StorePersonnelRequest;
use App\Repository\PersonnelRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    //
    private $personnelRepository;


    public function __construct(
        PersonnelRepository $personnelRepository,
    ) {

        $this->personnelRepository = $personnelRepository;
    }


    public function listePersonnel(): View
    {

        $personnel = $this->personnelRepository->getAll();
        return view(
            'personnel.listePersonnel',
            [
                'liste' => $personnel
            ]
        );
    }


    public function store(StorePersonnelRequest $request, PersonnelAction $action): RedirectResponse
    {
        $response =  $action->savePersonnel($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('parametres.personnel', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function storePersonnel(StorePersonnelRequest $request, PersonnelAction $action): RedirectResponse
    {
        $response =  $action->savePersonnel($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('personnel.liste', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }


    public function payementPersonnel(): View
    {
        $personnel = $this->personnelRepository->getAll();

        $payement = $this->personnelRepository->getAllPayement();

        return view(
            'personnel.payementPersonnel',
            [
                'liste' => $personnel,
                'payementListe' => $payement
            ]
        );
    }


    public function payementStorePersonnel(Request $request, PersonnelAction $action): RedirectResponse
    {
        $response =  $action->savePayementPersonnel($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('personnel.payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }


    public function validatePayement(Request $request, PersonnelAction $action) : RedirectResponse
    {
        $response =  $action->personnelPayementValidate($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('personnel.payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

}
