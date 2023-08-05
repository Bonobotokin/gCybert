<?php

namespace App\Repository;

use App\Interfaces\CaisseRepositoryInterfaces;
use App\Models\Caisse;
use App\Models\Decaissement;
use App\Models\Encaissement;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CaisseRepository implements CaisseRepositoryInterfaces
{

    public function getdefault()
    {
        $data = Caisse::with('encaissement')
            ->whereHas('encaissement', function ($query) {
                $query->whereNotNull('description', '=', 'default');
            })

            ->get()
            ->map(function ($data) {
                $date = Carbon::parse($data->created_at)->format('d/m/Y');
                return [
                    'description' => is_null($data) ? " " : $data->encaissement->description,
                    'solde' => is_null($data) ? " "  : $data->solde,
                    'personnel' => is_null($data) ? " " : $data->encaissement->user->name,
                    'date' => is_null($data) ? " " : $date

                ];
            });

        return $data;
    }

    public function lookResteClient(string $client)
    {
        $data = Encaissement::where('ispayed', false)->where('client', $client)->sum('reste');

        return $data;
    }

    public function getSumEncaissement()
    {
        $encaissement = Encaissement::sum('montant');

        return $encaissement;
    }

    public function getSumDecaissement()
    {
        $decaissment = Decaissement::sum('montant');

        return $decaissment;
    }

    public function getSolde()
    {
        $encaissement = Encaissement::sum('montant');
        $decaissment = Decaissement::sum('montant');

        $solde = $encaissement - $decaissment;

        return $solde;
    }


    public function getSumCaiss()
    {
        $caisse = Caisse::sum('solde');

        return $caisse;
    }


    public function getCaisse()
    {
        $livre = Caisse::with(['encaissement', 'decaissement'])
            ->get()
            ->map(function ($livre) {
                $date = Carbon::parse($livre->created_at)->format('d/m/Y');
                // dd($livre->encaissement->description);
                return [
                    'numero' => $livre->id,
                    'nume_facture' => is_null($livre->encaissement) ? "Decaissement" : $livre->encaissement->facture_id,
                    'type' => is_null($livre->encaissement) ? "Decaissement" : $livre->encaissement->description,
                    'montant' => $livre->solde,
                    'date' => is_null($livre) ? " " : $date

                ];
            });

        return $livre;
    }

    public function getannee()
    {

        $anneeMiseAJour = Caisse::selectRaw('YEAR(updated_at) as annee, MONTH(updated_at) as mois, SUM(solde) as montant')
            ->groupBy(DB::raw('YEAR(updated_at), MONTH(updated_at)'))
            ->orderByRaw('YEAR(updated_at), MONTH(updated_at)')
            ->get();
        return $anneeMiseAJour;
    }
}
