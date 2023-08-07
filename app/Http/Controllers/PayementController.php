<?php

namespace App\Http\Controllers;

use App\Action\PayementAction;
use App\Http\Requests\StorePayementRequest;
use App\Repository\ActiveRepository;
use App\Repository\EncaissementRepository;
use App\Repository\MaterielsRepository;
use App\Repository\payementRepository;
use App\Repository\PersonnelRepository;
use App\Repository\ServicesRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    //
    private $servicesRepository;
    private $materielsRepository;
    private $encaissementRepository;
    private $personnelRepository;
    private $activeRepository;

    public function __construct(
        ServicesRepository $servicesRepository,
        MaterielsRepository $materielsRepository,
        EncaissementRepository $encaissementRepository,
        PersonnelRepository $personnelRepository,
        ActiveRepository $activeRepository
    )
    {
        $this->servicesRepository = $servicesRepository;
        $this->materielsRepository = $materielsRepository;
        $this->encaissementRepository = $encaissementRepository;
        $this->personnelRepository = $personnelRepository;
        $this->activeRepository = $activeRepository;
    }

    public function payement() : View
    {
        $service = $this->servicesRepository->getAll();
        $materiels = $this->materielsRepository->getAll();
        $dataPayement = $this->encaissementRepository->getAllToDay();
        // dd($dataPayement);
        $dateNow = Carbon::parse(now())->format('Y-m-d');
        $recette = $this->encaissementRepository->getRecetteToDay();
        $personnel = $this->personnelRepository->getAll();
        $credit = $this->encaissementRepository->getResteToDay();

        $btnStart = $this->activeRepository->activeBtnDay();
        // dd($dataPayement);
        return view('caisse.payement', 
                [
                    'service'=> $service,
                    'materiels' => $materiels,
                    'payementToday' => $dataPayement,
                    'dateNow' => $dateNow,
                    'recette' => $recette,
                    'liste' => $personnel,
                    'credit' => $credit
                ]);
    }

    public function store(StorePayementRequest $request, PayementAction $action) : RedirectResponse
    {
        $response =  $action->savePayement($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function storeMultiple(Request $request, PayementAction $action): RedirectResponse
    {
        $response =  $action->saveMultiple($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function storePayed(Request $request, PayementAction $action)
    {
        $response =  $action->updateEncaissement($request);
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
