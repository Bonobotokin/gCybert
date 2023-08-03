<?php 


namespace App\Action;

use App\Models\Caisse;
use App\Models\Decaissement;
use App\Repository\CaisseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DecaissementAction 
{
    private $caisseRepository;

    public function __construct(
        CaisseRepository $caisseRepository
    )
    {
        $this->caisseRepository = $caisseRepository;
    }

    public function saveDecaissment($request)
    {
        try {
            $data = DB::transaction(function () use ($request) {

                $userConnected = Auth::user()->id;

                

                $decaissement = Decaissement::create([
                    'description' => $request->description,
                    'quantite'  => $request->quantite,
                    'montant'  => $request->montant,
                    'user_id' => $userConnected
                ]);

                $solde = $this->caisseRepository->getSolde();
                

                $caisse = Caisse::create([
                    'decaissement_id' => $decaissement->id,
                    'solde' => (double) $decaissement->montant
                ]);

                return [
                    'data' => true,
                    'message' => "Votre demande est enregistrer"
                ];


            });

            return $data;

        } catch (\Throwable $th) {
            return $th;
        }
    }

    

}