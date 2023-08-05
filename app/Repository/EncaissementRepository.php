<?php

namespace App\Repository;

use App\Interfaces\EncaissementRepositoryInterfaces;

use App\Models\Encaissement;
use App\Models\facture;
use Carbon\Carbon;

class EncaissementRepository implements EncaissementRepositoryInterfaces
{
    public function getDefault()
    {
        $data = Encaissement::with(['caisse', 'user'])
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->updated_at)->format('d/m/Y H:i:s');
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
                    // 'client' => $data->client,
                ];
            });

        return $data;
    }

    public function getAllToDay()
    {

        $aujourdhuit =  Carbon::today();

        $data = Encaissement::where('date', $aujourdhuit)
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->updated_at)->format('d/m/Y');
                $heure = Carbon::parse($data->updated_at)->format('H:i:s');


                $facture = $this->getFacture($data->facture_id);

                // Vérifier si la facture existe dans le tableau retourné par getFacture()
                if (isset($facture[0])) {
                    $descriptionFacture = $facture[0]['description'];
                    $quantiteFacture = $facture[0]['quantite'];
                    $clientFacture = $facture[0]['client'];
                    $personnelFacture = $facture[0]['personnel']['nom'];
                    // Vous pouvez accéder à d'autres détails de la facture de la même manière
                } else {
                    // La facture n'a pas été trouvée (gérer le cas où la facture n'existe pas)
                    $descriptionFacture = " ";
                    $quantiteFacture = " ";
                    $clientFacture  = " ";
                    $personnelFacture = " ";
                    // ... d'autres valeurs par défaut ou actions que vous voulez effectuer
                }

                return [
                    'numero' => $data->id,
                    'heure' => $heure,
                    'description' => $data->description,
                    'quantite' => $quantiteFacture,
                    'reste' => $data->reste,
                    'payer' => $data->payer,
                    'etat' => $data->ispayed,
                    'personnel' => $data->user->name,
                    'montant' => $data->montant,
                    'date' => $date,
                    'client' =>  $clientFacture,
                    'description' => $data->description, // Ajouter le détail de la facture ici
                    'salarier' => $personnelFacture, // Ajouter le détail de la facture ici
                    // ... les autres attributs que vous voulez inclure
                ];
            });

        // dd($data);
        return $data;
    }


    static function getFacture($id)
    {

        $facture = facture::with('personnel')->whereIn('id', explode(',', $id))->get();

        return $facture;
    }

    public function getRecetteToDay()
    {
        $aujourdhuit =  Carbon::today();
        // $recette = Encaissement::where('date', $aujourdhuit)->where('description', '!=', 'default')->sum('montant');
        $recette = Encaissement::where('date', $aujourdhuit)->sum('montant');
        return $recette;
    }

    public function getLastMvm()
    {

        $dateHier =  Carbon::today();

        $data = Encaissement::where('date', $dateHier)
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->updated_at)->format('d/m/Y');
                $heure = Carbon::parse($data->updated_at)->format('H:i:s');


                $facture = $this->getFacture($data->facture_id);

                // Vérifier si la facture existe dans le tableau retourné par getFacture()
                if (isset($facture[0])) {
                    $descriptionFacture = $facture[0]['description'];
                    $quantiteFacture = $facture[0]['quantite'];
                    $clientFacture = $facture[0]['client'];
                    $personnelFacture = $facture[0]['personnel']['nom'];
                    // Vous pouvez accéder à d'autres détails de la facture de la même manière
                } else {
                    // La facture n'a pas été trouvée (gérer le cas où la facture n'existe pas)
                    $descriptionFacture = " ";
                    $quantiteFacture = " ";
                    $clientFacture  = " ";
                    $personnelFacture = " ";
                    // ... d'autres valeurs par défaut ou actions que vous voulez effectuer
                }

                return [
                    'numero' => $data->id,
                    'heure' => $heure,
                    'description' => $data->description,
                    'quantite' => $quantiteFacture,
                    'reste' => $data->reste,
                    'payer' => $data->payer,
                    'etat' => $data->ispayed,
                    'personnel' => $data->user->name,
                    'montant' => $data->montant,
                    'date' => $date,
                    'client' =>  $clientFacture,
                    'description' => $data->description, // Ajouter le détail de la facture ici
                    'salarier' => $personnelFacture, // Ajouter le détail de la facture ici
                    // ... les autres attributs que vous voulez inclure
                ];
            });

        return $data;
    }

    public function getResteToDay()
    {
        $aujourdhuit =  Carbon::today();
        // $recette = Encaissement::where('date', $aujourdhuit)->where('description', '!=', 'default')->sum('montant');
        $montReste = Encaissement::where('date', $aujourdhuit)->where('ispayed', 2)->sum('montant');
        $montNotpayed = Encaissement::where('date', $aujourdhuit)->where('ispayed', 1)->sum('montant');
        // $montDebut = Encaissement::where('date', $aujourdhuit)->where('ispayed', 0)->sum('montant');

        $credit = $montNotpayed + $montReste;
        return $credit;
    }

    public function getSumEncaissement()
    {
        $recette = Encaissement::sum('montant');

        return $recette;
    }

    public function getAllSumReste()
    {
        $montReste = Encaissement::where('ispayed', 2)->sum('montant');
        $montNotpayed = Encaissement::where('ispayed', 1)->sum('montant');
        $credit = $montNotpayed + $montReste;
        return $credit;
    }
}
