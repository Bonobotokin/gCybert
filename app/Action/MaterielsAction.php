<?php

namespace App\Action;

use App\Models\EtatStockMateriels;
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

    public function updateMateriels($request, $id)
    {

        try {
            $data = DB::transaction(function () use ($request, $id) {
                // dd($id);
                $userConnected = Auth::user()->id;
                $materiel = Materiels::findOrFail($id);


                $materiel->designation = $request->designation;
                $materiel->conditionnement = $request->conditionnement;
                $materiel->totale = $request->totale;
                $materiel->user_id = $userConnected;
                $materiel->save();


                $stockMateriels = StockMateriels::findOrFail($materiel->id);


                $stockMateriels->materiels_id = $materiel->id;
                $stockMateriels->quantite = $materiel->totale;
                $stockMateriels->save();

                return [
                    'data' => true,
                    'message' => 'La mises a jour a etait bien effectuer '
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function deleteMateriels($id)
    {
        try {
            $data = DB::transaction(function () use ($id) {

                $materiel = Materiels::findOrFail($id);
                $stockMateriels = StockMateriels::where('materiels_id', $id)->delete();
                $materiel->delete();
                return [
                    'data' => true,
                    'message' => 'Votre demande a ette bien effectuer '
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function approvisionnement($request, $id)
    {
        try {
            $data = DB::transaction(function () use ($request, $id) {
                $userConnected = Auth::user()->id;
                $materiel = Materiels::findOrFail($id);
                // dd($request->quantite);
                $materiel->designation = $request->designation;                
                $materiel->conditionnement = $request->conditionnement;
                $materiel->totale = $materiel->totale + (int)$request->quantite;
                $materiel->user_id = $userConnected;
                $materiel->save();
                

                $stockMateriels = StockMateriels::findOrFail($materiel->id);


                $stockMateriels->materiels_id = $materiel->id;
                $stockMateriels->quantite = $materiel->totale;
                $stockMateriels->save();

                $etat = EtatStockMateriels::create([
                    'stock_materiels_id' => $stockMateriels->id,
                    'facture_id' => null,
                    'quantite' => $stockMateriels->quantite,
                    'observation' =>"Reapprovisionnement"
                ]);

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
