<?php


namespace App\Action;

use App\Models\Caisse;
use App\Models\Decaissement;
use App\Models\PayementPersonnel;
use App\Models\Personnel;
use App\Models\User;
use App\Repository\CaisseRepository;
use App\Repository\PersonnelRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonnelAction
{

    private $personnelRepository;
    private $caisseRepository;


    public function __construct(
        PersonnelRepository $personnelRepository,
        CaisseRepository $caisseRepository
    ) {

        $this->personnelRepository = $personnelRepository;
        $this->caisseRepository = $caisseRepository;
    }

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
            'password' => $data->mdp,
            'role' => $data->role
        ]);
        // dd($user);

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


    public function savePayementPersonnel($request)
    {
        try {
            $data = DB::transaction(function () use ($request) {

                $idPersonnel = $request->personnels;
                $payement = $request->payement;
                $salaire = $this->personnelRepository->getSalaire($idPersonnel);
                $personneleNom = $salaire[0]['nom'];
                $salaireReel = $salaire[0]['salaire_base'];
                $userConnected = Auth::user()->id;
                $solde = $this->caisseRepository->getSumCaiss();

                if ($payement > $salaireReel) {
                    return [
                        'data' => null,
                        'message' => 'desoler la salaire de ce personnels est de ' . $salaireReel . 'Ar alors que votre payement est de ' . $payement . 'Ar.'
                    ];
                }
                // else if($solde <= 200000){
                //     return [
                //         'data' => null,
                //         'message' => ' veuillez verrifier votre caisse car elle est < 200000Ar '
                //     ];
                // }

                else {
                    $calculeppp = $salaireReel - $payement;


                    $payement = PayementPersonnel::Create([
                        'personnel_id' =>  $idPersonnel,
                        'payement' => $payement,
                        'reste' => $salaireReel - $payement,
                        'observation' => $request->observation,
                        'etat' => 0,
                        'user_id' => $userConnected
                    ]);

                    // dd("Reglement de ".$personneleNom."; OBS: ".$payement->observation);


                    return [
                        'data' => true,
                        'message' => "Le demande payement de $personneleNom est bien valider"
                    ];
                }
            });

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }

    public function personnelPayementValidate($request)
    {
        try {

            $data = DB::transaction(function () use ($request) {

                $updatePayement = PayementPersonnel::find((int) $request->id)->get();

                foreach ($updatePayement as $data) {

                    $data->etat = 1;
                    $data->save();
                }


                $idPersonnel = $updatePayement[0]['personnel_id'];
                $salaire = $this->personnelRepository->getSalaire($idPersonnel);
                $personneleNom = $salaire[0]['nom'];

                $userConnected = Auth::user()->id;

                $decaissement = Decaissement::create([
                    'description' => "Reglement de " . $personneleNom . "; OBS: " . $updatePayement[0]['observation'],
                    'payement_personnel_id' => $request->id,
                    'montant'  => $updatePayement[0]['payement'],
                    'user_id' => $userConnected
                ]);



                $caisse = Caisse::create([
                    'decaissement_id' => $decaissement->id,
                    'solde' => -(float) $decaissement->montant
                ]);

                return [
                    'data' => true,
                    'message' => "Le payement de $personneleNom a etatit bien effectuer"
                ];
            });


            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }



    public function updatePersonnel($request, $id)
    {

        try {
            //code...

            $data = DB::transaction(function () use ($request, $id) {

                $personnel = Personnel::findOrFail($id);
                $personnel->nom = $request->nom;
                $personnel->sexe_personneles = $request->sexe;
                
                $personnel->age = $request->age;
                
                $personnel->salaire_base = $request->salaire;
                
                $personnel->telephone = $request->telephone;
                
                $personnel->adresse = $request->adresse;
                $personnel->cin = $request->cin;
                $personnel->save();

                $user_id = $personnel->user_id;
                
                $user = User::findOrFail($user_id);
                $user->name = $request->name;
                $user->save();

                return [
                    'data' => true,
                    'message' => "Mises a jour resussit"
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deletePersonnel($id)
    {

        try {
            //code...

            $data = DB::transaction(function () use ($id) {

                $personnel = Personnel::findOrFail($id);
                
                $user = User::where('id', $personnel['user_id'])->delete();
                $personnel->delete();

                return [
                    'data' => true,
                    'message' => "Suppresssion resussit"
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
