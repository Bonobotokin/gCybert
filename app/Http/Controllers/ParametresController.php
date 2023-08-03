<?php

namespace App\Http\Controllers;

use App\Repository\CaisseRepository;
use App\Repository\MaterielsRepository;
use App\Repository\PersonnelRepository;
use App\Repository\ServicesRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParametresController extends Controller
{
    //
    private $personnelRepository;
    private $servicesRepository;
    private $materielsRepository;
    private $caisseRepository;

    public function __construct(
        PersonnelRepository $personnelRepository,
        ServicesRepository $servicesRepository,
        MaterielsRepository $materielsRepository,
        CaisseRepository $caisseRepository
    ) {
        $this->personnelRepository = $personnelRepository;
        $this->servicesRepository = $servicesRepository;
        $this->materielsRepository = $materielsRepository;
        $this->caisseRepository = $caisseRepository;
    }

    public function  personnel(): View
    {
        $personnel = $this->personnelRepository->getAll();

        return view(
            'parametres.personnel.index',
            [
                'liste' => $personnel
            ]
        );
    }

    public function applications(): View
    {
        $services = $this->servicesRepository->getAll();
        $materiels = $this->materielsRepository->getAll();
        return view(
            'parametres.applications.index',
            [
                'liste' => $services,
                'materiels' => $materiels
            ]
        );
    }

    /**
     * 
     * parametres de generalisation de la caisse
     * */

    public function caisses(): View
    {
        $defaultCaise = $this->caisseRepository->getdefault();
        // dd($defaultCaise);
        return view(
            'parametres.caisses.index',
            [
                'default' => is_null($defaultCaise)? " " : $defaultCaise
            ]
        );
    }
}
