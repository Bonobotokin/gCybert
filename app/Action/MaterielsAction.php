<?php 

namespace App\Action;

use App\Models\Materiels;
use App\Models\StockMateriels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterielsAction 
{
    public function savecNewMateriels($request)
    {
        try {
            $data = DB::transaction(function () use ($request) {
                $userConnected = Auth::user()->id;

                $newMateriel = Materiels::create([
                    'designation' => $request->designation,
                    'totale' => $request->totale,
                    // 'prix_vente' => $request->prix_vente,
                    'conditionnement' => $request->conditionnement,
                    'user_id' => $userConnected
                ]);
                
                $stock = StockMateriels::create([
                    'materiels_id' => $newMateriel->id,
                    'quantite' => $request->totale
                ]);
                // dd($stock);
                return [
                    'data' => true,
                    'message' => 'L\'enregistrement a etait bien effectuer'
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}