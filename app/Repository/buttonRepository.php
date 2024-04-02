<?php 


namespace App\Repository;

use App\Interfaces\buttonRepositoryInterfaces;
use App\Models\ButtonActive;

class buttonRepository implements buttonRepositoryInterfaces
{

    public function lookBtnActif()
    {
        $btn = ButtonActive::get()
                ->map(function ($btn)
                {
                    return [
                        'id' => $btn->id,
                        'nom' => $btn->nom,
                        'actif' => $btn->actif
                    ];
                });

        return $btn;
    }

}