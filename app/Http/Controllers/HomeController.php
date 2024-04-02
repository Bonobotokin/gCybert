<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Repository\CaisseRepository;
use App\Repository\ServicesRepository;
use App\Repository\MaterielsRepository;
use App\Repository\PersonnelRepository;
use App\Repository\EncaissementRepository;

class HomeController extends Controller
{
    //
    private $servicesRepository;
    private $materielsRepository;
    private $encaissementRepository;
    private $personnelRepository;
    private $caisseRepository;

    public function __construct(
        ServicesRepository $servicesRepository,
        MaterielsRepository $materielsRepository,
        EncaissementRepository $encaissementRepository,
        PersonnelRepository $personnelRepository,
        CaisseRepository $caisseRepository,
    ) {
        $this->servicesRepository = $servicesRepository;
        $this->materielsRepository = $materielsRepository;
        $this->encaissementRepository = $encaissementRepository;
        $this->personnelRepository = $personnelRepository;
        $this->caisseRepository = $caisseRepository;
    }

    public function home(): View
    {
        $encaissement = $this->caisseRepository->getSumEncaissement();
        $decaissement = $this->caisseRepository->getSumDecaissement();
        $solde = $this->caisseRepository->getSolde();
        $livreCaisse = $this->caisseRepository->getCaisse();
        $mvmCaisseLast = $this->encaissementRepository->getLastMvm();
        $annee = $this->caisseRepository->getannee();
        $annePersonnel = $this->personnelRepository->getAllPayementInYears();
        // dd($annePersonnel);
        return view(
            'home',
            [
                'encaissement' => $encaissement,
                'decaissement' => $decaissement,
                'solde' => $solde,
                'livreCaisse' => $livreCaisse,
                'yesterDayEncaissement' => $mvmCaisseLast,
                'annee' => $annee,
                'annePersonnel' => $annePersonnel
            ]
        );
    }
}
