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
    ) {
        $this->caisseRepository = $caisseRepository;
    }

    public function saveDecaissment($request)
    {
        try {
            $data = DB::transaction(function () use ($request) {

                $userConnected = Auth::user()->id;






                $sumCaisse = $this->caisseRepository->getSumCaiss();

                if ($request->montant > $sumCaisse) {

                    return [
                        'data' => null,
                        'message' => 'Votre Caisse ne peut pas accepter ce demande'
                    ];
                } else {

                    $solde = $this->caisseRepository->getSolde();

                    $decaissement = Decaissement::create([
                        'description' => $request->description,
                        'quantite'  => $request->quantite,
                        'materiels_id' => $request->materiels,
                        'montant'  => $request->montant,
                        'user_id' => $userConnected
                    ]);

                    $caisse = Caisse::create([
                        'decaissement_id' => $decaissement->id,
                        'solde' => - (float) $decaissement->montant
                    ]);

                    // dd($caisse);

                    return [
                        'data' => true,
                        'message' => "Votre demande est enregistrer"
                    ];
                }
            });

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
