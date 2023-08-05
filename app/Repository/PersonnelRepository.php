<?php 

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Personnel;
use App\Models\PayementPersonnel;
use App\Interfaces\PersonnelRepositoryInterfaces;
use Illuminate\Support\Facades\DB;

class PersonnelRepository implements PersonnelRepositoryInterfaces
{
    public function getAll()
    {
        $data = Personnel::with('user')
                        ->get()
                        ->map(function ($data) {
                            return [
                                'id' => $data->id,
                                'nom' => $data->nom,
                                'sexe' => $data->sexe_personneles,
                                'telephone' =>is_null( $data->telephone)? "Pas de numero enregistrer" :  $data->telephone,
                                'adresse' => $data->adresse,
                                'salaire_base' => $data->salaire_base
                            ];
                        });

        return $data;
    }

    public function getSalaire($id)
    {
        $data = Personnel::where('id', $id)->get();

        return $data;
    }


    

    public function getAllPayement()
    {
        $payement = PayementPersonnel::with(['user', 'personnel'])
                    ->get()
                    ->map(function ($payement) {
                        
                        $date = Carbon::parse($payement->updated_at)->format('d M Y');

                        return [
                            'numero' => $payement->id,
                            'date' => $date,
                            'sexe' => $payement->personnel->sexe_personneles,
                            'personnel' => $payement->personnel->nom,
                            'salaire' => $payement->personnel->salaire_base."Ar",
                            'observation' => $payement->observation,
                            'payement' => $payement->payement."Ar",
                            'reste' => $payement->reste."Ar",
                            'etat' => $payement->etat
                        ];
                    });

        // dd($payement);          
        return $payement;
    }


    public function getAllPayementInYears()
    {
        $anneeMiseAJour = PayementPersonnel::with('personnel')->selectRaw('YEAR(updated_at) as annee, MONTH(updated_at) as mois, payement as montant, reste')
        ->groupBy(DB::raw('YEAR(updated_at), MONTH(updated_at), payement,reste'))
        ->orderByRaw('YEAR(updated_at), MONTH(updated_at)')
        ->get();
    return $anneeMiseAJour;
    }
}