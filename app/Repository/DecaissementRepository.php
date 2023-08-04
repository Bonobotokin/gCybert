<?php 

namespace App\Repository;

use App\Interfaces\DecaissementRepositoryInterfaces;
use App\Models\Decaissement;
use Carbon\Carbon;

class DecaissementRepository implements DecaissementRepositoryInterfaces
{
    public function getSumDecaissement()
    {
        $decaissement = Decaissement::sum('montant');
        
        return $decaissement;
    }

    public function getAll()
    {
        $decaisse = Decaissement::with(['user','materiels'])
                    ->get()
                    ->map(function ($decaisse) {
                        $date = Carbon::parse($decaisse->created_at)->format('d/m/Y');
                        return [
                            'num' => $decaisse->id,
                            'description' => $decaisse->description,
                            'montant' => $decaisse->montant,
                            'personnel' => "creer par". $decaisse->user->name,
                            'quantite' => $decaisse->quantite,
                            'date' => $date

                        ];
                    });

        return $decaisse;
    }
}