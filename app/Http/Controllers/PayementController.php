<?php

namespace App\Http\Controllers;

use App\Action\PayementAction;
use App\Http\Requests\StorePayementRequest;
use App\Repository\ActiveRepository;
use App\Repository\buttonRepository;
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
    private $buttonRepository;

    public function __construct(
        ServicesRepository $servicesRepository,
        MaterielsRepository $materielsRepository,
        EncaissementRepository $encaissementRepository,
        PersonnelRepository $personnelRepository,
        ActiveRepository $activeRepository,
        buttonRepository $buttonRepository
    ) {
        $this->servicesRepository = $servicesRepository;
        $this->materielsRepository = $materielsRepository;
        $this->encaissementRepository = $encaissementRepository;
        $this->personnelRepository = $personnelRepository;
        $this->activeRepository = $activeRepository;
        $this->buttonRepository = $buttonRepository;
    }

    public function payement(): View
    {
        $service = $this->servicesRepository->getAll();
        $materiels = $this->materielsRepository->getAll();
        $dataPayement = $this->encaissementRepository->getAllToDay();
        $dateNotPayed = $this->encaissementRepository->getAllNotPayed();
        // dd($dataPayement);
        $dateNow = Carbon::today();
        $recette = $this->encaissementRepository->getRecetteToDay();
        $personnel = $this->personnelRepository->getAll();
        $credit = $this->encaissementRepository->getResteToDay();

        $btnStart = $this->buttonRepository->lookBtnActif();

        // dd($dataPayement);
        return view(
            'caisse.payement',
            [
                'service' => $service,
                'materiels' => $materiels,
                'payementToday' => $dataPayement,
                'dateNotPayed' => $dateNotPayed,
                'dateNow' => $dateNow,
                'recette' => $recette,
                'liste' => $personnel,
                'credit' => $credit,
                'btnStart' => $btnStart
            ]
        );
    }

    public function modificationFacture($id): View
    {

        $facture = $this->encaissementRepository->getListeFacture($id);
        $factureById = $this->encaissementRepository->factureById($id);
        // dd($factureById]);
        $service = $this->servicesRepository->getAll();
        $materiels = $this->materielsRepository->getAll();
        $dataPayement = $this->encaissementRepository->getAllToDay();
        
        $dateNow = Carbon::today();
        $recette = $this->encaissementRepository->getRecetteToDay();
        $personnel = $this->personnelRepository->getAll();
        $credit = $this->encaissementRepository->getResteToDay();

        $btnStart = $this->activeRepository->activeBtnDay();

        return view(
            'caisse.modificationFacture',
            [
                'dataId' => $id,
                'service' => $service,
                'materiels' => $materiels,
                'payementToday' => $dataPayement,
                'dateNow' => $dateNow,
                'recette' => $recette,
                'liste' => $personnel,
                'credit' => $credit,
                'facture' => $facture,
                'factureById' => $factureById[0]
            ]
        );
    }

    public function store(StorePayementRequest $request, PayementAction $action): RedirectResponse
    {
        $response =  $action->savePayement($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
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
            return redirect()->route('payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
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
            return redirect()->route('payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(Request $request, $id, PayementAction $action)
    {
        $response =  $action->updateData($request, $id);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function delePayement($id, PayementAction $action)
    {
        $response =  $action->deleteData($id);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('payement', ['reponse' => $response])->with('success', $response['message']);
        } else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function details(int $id): View
    {
        $details = $this->encaissementRepository->getDetailsFacture($id);
        $detailsTotal = $this->encaissementRepository->getDetailsFactureTotalEncaissement($id);
        // dd($detailsTotal);
        return view(
            'caisse.detailsFacture',
            [
                'data' => $details,
                'detailsTotal' => $detailsTotal
            ]


        );
    }

    public function print(int $id): View
    {
        $details = $this->encaissementRepository->getDetailsFacture($id);
        $detailsTotal = $this->encaissementRepository->getDetailsFactureTotalEncaissement($id);
        // dd($detailsTotal);
        return view(
            'caisse.printFacture',
            [
                'data' => $details,
                'detailsTotal' => $detailsTotal
            ]


        );
    }


    public function factureListe()
    {

        $facture = $this->encaissementRepository->allFacture();

        dd($facture);

        return view('caisse.facturesClient');
    }
}
