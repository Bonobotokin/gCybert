<?php

namespace App\Repository;

use App\Interfaces\payementRepositoryInterfaces;
use App\Models\Encaissement;
use Carbon\Carbon;

class payementRepository implements payementRepositoryInterfaces
{
    public function getAllToDay()
    {
        
        $data = Encaissement::with('service')
                        ->get();
                        // ->map(function ($data) {
                            
                        //     $date = Carbon::parse($data->created_at)->format('m/d/Y');
                        //     dd($data);
                        //     return [
                        //         'serice' => $data->service->designation,
                        //         'materiels' => $data->materiels->designation,
                        //         'personnel' => $data->user->name,
                        //         'date' => $date,
                        //         'quantite' => $data->quantite,
                        //         'montant' => $data->montant
                        //     ];
                        // });
        dd($data);
        return $data;
    }

    public function getRecetteToDay()
    {
        $recette = Encaissement::sum('montant');
        
        return $recette;
    }
}