<?php

namespace App\Repository;

use App\Interfaces\EncaissementRepositoryInterfaces;

use App\Models\Encaissement;
use App\Models\facture;
use Carbon\Carbon;

class EncaissementRepository implements EncaissementRepositoryInterfaces
{

    public function getListeFacture($id)
    {
        $encaissement = Encaissement::where('id', $id)->first();


        $factureIds = explode(',', $encaissement->facture_id);
        $factures = Facture::with('service')->whereIn('id', $factureIds)->get();

        $facturesArray = $factures->map(function ($facture) {
            return [
                'id' => $facture->id,
                'description' => $facture->description,
                'service' => $facture->service->designation,
                'quantite' => $facture->quantite,
                'montant' => $facture->montant,
                'date' => $facture->date,
                'client' => $facture->client,
                'user_id' => $facture->user_id,
                'personnel_id' => $facture->personnel_id,
            ];
        });

        return $facturesArray;
    }

    public function factureById($id)
    {
        $encaissement = Encaissement::where('id', $id)->first();


        $factureIds = explode(',', $encaissement->facture_id);
        $factures = Facture::with('service', 'personnel')->whereIn('id', $factureIds)->get();


        $facturesArray = $factures->map(function ($facture, $nombreDeFactures) {

            return [
                'id' => $facture->id,
                'description' => $facture->description,
                'service' => $facture->service->designation,
                'quantite' => $facture->quantite,
                'montant' => $facture->montant,
                'date' => $facture->date,
                'client' => $facture->client,
                'user_id' => $facture->user_id,
                'personnel_id' => $facture->personnel_id,
            ];
        });

        return $facturesArray;
    }

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

        $aujourdhuit =  Carbon::today()->format('Y-m-d');

        $data = Encaissement::where('date', $aujourdhuit)
            // ->whereAnd('ispayed', 1)
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->updated_at)->format('d/m/Y');
                $heure = Carbon::parse($data->updated_at)->format('H:i:s');


                $facture = $this->getFacture($data->facture_id);

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

    public function getAllNotPayed()
    {

        $hier =  Carbon::yesterday()->format('Y-m-d');
        // dd($hier);

        $data = Encaissement::where(function ($query) {
            $query->where('ispayed', 1)
                ->orWhere('ispayed', 2);
        })
            ->where('date', $hier)
            ->orderByDesc('updated_at')
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->updated_at)->format('d/m/Y');
                $heure = $date;


                $facture = $this->getFacture($data->facture_id);

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


    static function getFacture($id)
    {

        $facture = facture::with('personnel')->whereIn('id', explode(',', $id))->get();

        return $facture;
    }

    public function getRecetteToDay()
    {
        $aujourdhuit =  Carbon::today();
        // $recette = Encaissement::where('date', $aujourdhuit)->where('description', '!=', 'default')->sum('montant');
        $encaissement = Encaissement::where(function($query) {
            $query->where('ispayed', 4)
            ->orWhere('ispayed', 0)
                  ->orWhere('ispayed', 3);
        })->where('date', $aujourdhuit)->sum('montant');

        $encaissementReste = Encaissement::where(function($query) {
            $query->where('ispayed', 3);
        })->where('date', $aujourdhuit)->sum('reste');
        // dd($encaissement);
        $data = $encaissement - $encaissementReste;
        return $data;
    }

    public function getLastMvm()
    {

        $dateHier =  Carbon::yesterday();

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
        $recette = Encaissement::where('ispayed', '1')->sum('montant');
        $montNotpayed = Encaissement::where('ispayed', 2)->sum('montant');
        // $montDebut = Encaissement::where('date', $aujourdhuit)->where('ispayed', 0)->sum('montant');

        $credit = $montNotpayed + $recette;
        return $credit;
    }

    public function getSumEncaissement()
    {
        $recette = Encaissement::sum('montant');

        return $recette;
    }

    public function getAllSumReste()
    {
        $montNotpayed = Encaissement::where(function($query) {
            $query->where('ispayed', 1)
                  ->orWhere('ispayed', 2);
        })->sum('montant');

        $credit = $montNotpayed;
        return $credit;
    }


    public function getDetailsFacture($id)
    {
        $encaissement = Encaissement::where('id', $id)->first();



        $factureIds = explode(',', $encaissement->facture_id);
        $factures = facture::with('service', 'personnel')->whereIn('id', $factureIds)->get();


        $facturesArray = $factures->map(function ($factures) use ($encaissement) {


            return [
                'id' => $factures->id,
                'description' => $factures->description,
                'service' => $factures->service->designation,
                'quantite' => $factures->quantite,
                'montant' => $factures->montant,
                'date' => $factures->date,
                'client' => $factures->client,
                'user_id' => $factures->user_id,
                'personnel_id' => $factures->personnel_id,
            ];
        });

        // dd($facturesArray);
        return $facturesArray;
    }


    public function getDetailsFactureTotalEncaissement($id)
    {
        $data = Encaissement::where('id', $id)
            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->updated_at)->format('d/m/Y');
                $heure = Carbon::parse($data->updated_at)->format('H:i:s');


                $facture = $this->getFacture($data->facture_id);

                if (isset($facture[0])) {
                    $descriptionFacture = $facture[0]['description'];
                    $quantiteFacture = $facture[0]['quantite'];
                    $clientFacture = is_null($facture[0]['client']) ? " " : $facture[0]['client'];
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



    public function allFacture()
    {

        $liste = facture::with('personnel')
                    ->get();


        $factureInfo = $liste->groupBy(function ($data){
            return 'facture';
        })->map(function ($groupedFactures, $key) {
            // $factures = $groupedFactures->first();

            return [
                'id' => $groupedFactures['id']
            ];
        });


        return $factureInfo;

    }
}
