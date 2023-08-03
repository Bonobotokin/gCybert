<?php

namespace App\Repository;

use App\Interfaces\MaterielsRepositoryInterfaces;
use App\Models\EtatStockMateriels;
use App\Models\Materiels;
use App\Models\StockMateriels;
use Carbon\Carbon;

class MaterielsRepository implements MaterielsRepositoryInterfaces
{

    public function getAll()
    {
        $data = Materiels::with(['user', 'user.personnel'])->get()
            ->map(function ($data) {

                $date = Carbon::parse($data->created_at)->format('m/d/Y');

                return [
                    'id' => $data->id,
                    'designation' => $data->designation,
                    'totale' => $data->totale,
                    'conditionnement' => $data->conditionnement,
                    'personnel' => $data->user->name,
                    'date' => $date
                ];
            });

        return $data;
    }


    public function stock()
    {
        $data = StockMateriels::with('materiels')
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->created_at)->format('m/d/Y');
                return [
                    'designation' => $data->materiels->designation,
                    'conditionnement' => $data->materiels->conditionnement,
                    'quantite' => $data->quantite,
                    'code' => $data->id,
                    'date' => $date

                ];
            });
          
        return $data;
    }

    public function etatStock()
    {
        
        $data = EtatStockMateriels::with(['stockMateriels','encaissement','encaissement.facture'])
                ->get()
                ->map(function($data) {
                    // dd($data->encaissement);
                    return [
                        'code' => $data->id,
                        'designation' => $data->stockMateriels->materiels->designation,
                        'conditionnement' => $data->stockMateriels->materiels->conditionnement,
                        'quantite' => $data->quantite,
                        'observation' => $data->observation
                    ];
                });

        // dd($data);
        return $data;
    }
}
