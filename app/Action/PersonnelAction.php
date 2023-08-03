<?php


namespace App\Action;

use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PersonnelAction
{
    public function savePersonnel($data)
    {
        try {

            $data = DB::transaction(function () use ($data) {

                if (is_null($data->name)) {

                    $personnel = $this->personnelAdd($data, null);
                } else {

                    $user = $this->saveUser($data);
                    $personnel = $this->personnelAdd($data, $user);
                }
                
                return [
                    'data' => true,
                    'message' => "L'enregistrement de $personnel a etait bien effectuer"
                ];
            });
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function saveUser($data)
    {
        $user = User::create([
            'name'  => $data->name,
            'email'  => $data->email,
            'password' => $data->mdp
        ]);

        return $user->id;
    }

    public function personnelAdd($data, $userId)
    {


        $personnel = Personnel::create([
            'nom' => $data->nom,
            'sexe_personneles' => $data->sexe,
            'age' => $data->age,
            'salaire_base' => $data->salaire,
            'telephone' => $data->telephone,
            'adresse' => $data->adresse,
            'cin' => $data->cin,
            'user_id' => $userId
        ]);


        return $personnel->nom;
    }
}
