<?php

namespace App\Repository;

use App\Interfaces\EncaissementRepositoryInterfaces;

use App\Models\Encaissement;
use Carbon\Carbon;

class EncaissementRepository implements EncaissementRepositoryInterfaces
{
    public function getDefault()
    {
        $data = Encaissement::with(['caisse', 'user'])
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->created_at)->format('m/d/Y H:i:s');
                // dd($data);
                return [
                    'id' => $data->id,
                    'description' => $data->description,
                    'montant' => $data->montant,
                    'reste' => $data->reste,
                    'etat' => $data->ispayed,
                    'personnel' => $data->user->name,
                    'date' => $date,
                    'salarier' => is_null($data->personnel) ? " " : $data->personnel->nom,
                    'client' => $data->client,
                ];
            });

        return $data;
    }

    public function getAllToDay()
    {

        $aujourdhuit =  Carbon::today();
        $data = Encaissement::with('facture','facture.personnel')
            ->where('date', $aujourdhuit)
            // ->where('ispayed', 0)
            // ->where('description', '!=', 'default')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($data) {

                $date = Carbon::parse($data->created_at)->format('m/d/Y');

                // dd($data);
                
                return [
                    'serice' => is_null($data->facture) ? " " : $data->facture->service->designation,
                    'description' => $data->description,
                    // 'materiels' => is_null($data->materiels) ? " " : $data->materiels->designation,
                    'personnel' => $data->user->name,
                    'date' => $date,
                    'quantite' => is_null($data->facture) ? " " : $data->facture->quantite,
                    'montant' => $data->montant,
                    'payer' => $data->payer,
                    'salarier' => is_null($data->facture) ? " " : $data->facture->personnel->nom,
                    'client' => is_null($data->facture) ? " " : $data->facture->client,
                    'etat' => $data->ispayed,
                    'reste' => $data->reste,
                    'numero' => $data->id,
                    'heure' => Carbon::parse($data->created_at)->format('H:i:s')
                ];
            });

        // dd($data);
        return $data;
    }

    public function getRecetteToDay()
    {
        $aujourdhuit =  Carbon::today();
        // $recette = Encaissement::where('date', $aujourdhuit)->where('description', '!=', 'default')->sum('montant');
        $recette = Encaissement::where('date', $aujourdhuit)->sum('montant');
        return $recette;
    }

    public function getResteToDay()
    {
        $aujourdhuit =  Carbon::today();
        // $recette = Encaissement::where('date', $aujourdhuit)->where('description', '!=', 'default')->sum('montant');
        $credit = Encaissement::where('date', $aujourdhuit)->where('ispayed', 2)->sum('montant');
        return $credit;
    }

    public function getSumEncaissement()
    {
        $recette = Encaissement::sum('montant');

        return $recette;
    }

    public function getAllSumReste()
    {
        $credit = Encaissement::where('ispayed', 2)->sum('montant');

        return $credit;
        
    }


}
