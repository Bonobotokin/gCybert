<?php 

namespace App\Repository;

use App\Interfaces\PersonnelRepositoryInterfaces;
use App\Models\Personnel;

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
                                'telephone' => $data->telephone,
                                'adresse' => $data->adresse
                            ];
                        });

        return $data;
    }
}