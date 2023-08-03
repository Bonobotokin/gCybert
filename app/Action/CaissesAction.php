<?php 

namespace App\Action;

use App\Models\Caisse;
use App\Models\Encaissement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaissesAction 
{

    public function saveDefault($request)
    {
        try {
            $data = DB::transaction(function () use ($request){
                $userConnected = Auth::user()->id;
                
                $default = Encaissement::create([
                    'description' => 'default',
                    'montant'=> $request->montant,
                    'date' => Carbon::today(),
                    'user_id' => $userConnected
                ]);

                $caisse = Caisse::create([
                    'encaissement_id' => $default->id,
                    'solde' => $default->montant
                ]);

                return [
                    'data' => true,
                    'message' => 'Votre caisse est bien parametres'
                ];
            });
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

}