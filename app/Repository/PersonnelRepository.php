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
                    'age' => $data->age,
                    'telephone' => is_null($data->telephone) ? "Pas de numero enregistrer" :$data->telephone,
                    'adresse' => $data->adresse,
                    'cin' => $data->cin,
                    'salaire_base' => $data->salaire_base,
                    'nom_user' => is_null($data->user)? " " : $data->user->name,
                    'email' => is_null($data->user)? " " : $data->user->email,
                    'password' => is_null($data->user)? " " : $data->user->password,
                    'role' => is_null($data->user)? " " : $data->user->role,
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
                    'salaire' => $payement->personnel->salaire_base . "Ar",
                    'observation' => $payement->observation,
                    'payement' => $payement->payement . "Ar",
                    'reste' => $payement->reste . "Ar",
                    'etat' => $payement->etat
                ];
            });

        // dd($payement);          
        return $payement;
    }


    public function getAllPayementInYears()
    {
        $anneeMiseAJour = PayementPersonnel::selectRaw('YEAR(payement_personnels.updated_at) AS annee,
                                        MONTH(payement_personnels.updated_at) AS mois,
                                        SUM(payement_personnels.payement) AS montant,
                                        personnels.nom AS nom_personnel')
            ->join('personnels', 'payement_personnels.personnel_id', '=', 'personnels.id')
            ->groupBy(DB::raw('YEAR(payement_personnels.updated_at), MONTH(payement_personnels.updated_at), payement_personnels.personnel_id, personnels.nom'))
            ->orderByRaw('YEAR(payement_personnels.updated_at), MONTH(payement_personnels.updated_at)')
            ->get();
        return $anneeMiseAJour;
    }
}
