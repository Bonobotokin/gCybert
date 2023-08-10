<?php

namespace App\Action;

use Carbon\Carbon;
use App\Models\Caisse;
use App\Models\facture;
use App\Models\Service;
use App\Models\Payement;
use App\Models\Materiels;
use App\Models\ButtonActive;
use App\Models\Encaissement;
use App\Models\StockMateriels;
use App\Models\EtatStockMateriels;
use Illuminate\Support\Facades\DB;
use App\Repository\CaisseRepository;
use Illuminate\Support\Facades\Auth;

class PayementAction
{

    private $caisseRepository;

    public function __construct(
        CaisseRepository $caisseRepository
    ) {
        $this->caisseRepository = $caisseRepository;
    }



    public function savePayement($request)
    {
        try {

            $data = DB::transaction(function () use ($request) {
                // dd($request);
                $montantDefault = $this->getMontant($request->service);

                $userConnected = Auth::user()->id;

                $montantPayement = $request->quantite * $montantDefault;

                $descriptionEntrant = Service::find((int) $request->service);


                $facture = facture::Create([
                    'description' => $descriptionEntrant->designation,
                    'service_id' => $request->service,
                    'quantite' => $request->quantite,
                    'montant' => $montantPayement,
                    'payer' => $montantPayement,
                    'reste' => 0,
                    'date' => Carbon::today(),
                    'client' => $request->client,
                    'user_id' => $userConnected,
                    'ispayed' => 1,
                    'personnel_id' => $request->personnels
                ]);

                // dd($facture->description);
                $encaissement = Encaissement::Create([
                    'description' => $descriptionEntrant->designation,
                    'facture_id' => $facture->id,
                    'montant' => $facture->montant,
                    'date' => Carbon::today(),
                    'user_id' => $userConnected,
                ]);

                return [
                    'data' => true,
                    'message' => 'L\'enregistrement de votre payement est bien reussit'
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }

    public function saveMultiple($request)
    {
        try {

            $data = DB::transaction(function () use ($request) {

                if(is_null($request->personnels))
                {
                    return [
                        'data' => null,
                        'message' => "Delorer veuille renseigne le personnel"
                    ];
                }

                $userConnected = Auth::user()->id;

                $somme_montant = 0;
                $id_facture = [];
                $nombre = (int) $request->nombrePayement;
                $translateDurerr = "";
                for ($i = 0; $i < $nombre; $i++) {
                    $service = $request[$i]['service'];

                    if ($service == 1) {

                        $minute = $request[$i]['quantite'];

                        $translateDurerr = $this->detecterHeuresMinutes($minute);

                        $montantDefault = $this->getMontant($service);
                        $montantPayement = $minute * $montantDefault;
                        // dd($montantPayement);
                        if ($minute <= 500) {
                            # code...
                            $montantPayement = 500;
                        }
                        $deuxDerniersChiffres = $montantPayement % 100;
                        if ($deuxDerniersChiffres >= 50) {
                            // Arrondir le montant au multiple de 100 supérieur le plus proche
                            $nombreArrondi = ceil($montantPayement / 100) * 100;
                        } else {
                            // Arrondir le montant au multiple de 100 inférieur le plus proche
                            $nombreArrondi = floor($montantPayement / 100) * 100;
                        }
                        $descriptionEntrant = Service::find((int)$service);
                        // translateDurerr
                        // dd($descriptionEntrant->designation);
                        $facture = Facture::create([
                            'description' => $descriptionEntrant->designation . " durer " . $translateDurerr,
                            'service_id' => $service,
                            'quantite' => $minute,
                            'montant' => $nombreArrondi,
                            'date' => Carbon::today(),
                            'client' => $request->client,
                            'user_id' => $userConnected,
                            'personnel_id' => $request->personnels
                        ]);
                    } else {
                        $quantite = $request[$i]['quantite'];

                        $montantDefault = $this->getMontant($service);
                        $montantPayement = $quantite * $montantDefault;


                        // Extraire les deux derniers chiffres du nombre
                        $deuxDerniersChiffres = $montantPayement % 100;


                        if ($deuxDerniersChiffres >= 50) {
                            // Arrondir le montant au multiple de 100 supérieur le plus proche
                            $nombreArrondi = ceil($montantPayement / 100) * 100;
                        } else {
                            // Arrondir le montant au multiple de 100 inférieur le plus proche
                            $nombreArrondi = floor($montantPayement / 100) * 100;
                        }

                        // dd($nombreArrondi);

                        $descriptionEntrant = Service::find((int)$service);

                        $facture = Facture::create([
                            'description' => $descriptionEntrant->designation,
                            'service_id' => $service,
                            'quantite' => $quantite,
                            'montant' => $nombreArrondi,
                            'date' => Carbon::today(),
                            'client' => $request->client,
                            'user_id' => $userConnected,
                            'personnel_id' => $request->personnels
                        ]);
                        // dd($facture);
                    }

                    $id_facture[] = $facture->id;
                    $somme_montant += $facture->montant;
                }
                $ids_concatenated = implode(',', $id_facture);
                $id = $id_facture;

                $encaissement = Encaissement::Create([
                    'description' => is_null($request->client) ? "Payement de " . $descriptionEntrant->designation . (is_null($translateDurerr) ? " " : " " . $translateDurerr) : "Payement de facture de " . $request->client,

                    'facture_id' => $ids_concatenated,
                    'montant' => $somme_montant,
                    'payer' => 0,
                    'reste' => 0,
                    'ispayed' => 1,
                    'date' => Carbon::today(),
                    'user_id' => $userConnected,
                ]);

                //  dd($encaissement);   


                // dd($facture->description);


                return [
                    'data' => true,
                    'message' => 'L\'enregistrement de votre payement est bien reussit'
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }

    public function getMontant($data)
    {

        $prix_default = Service::find((int) $data);

        return $prix_default->prix;
    }


    public function updateEncaissement($request)
    {

        try {

            $data = DB::transaction(function () use ($request) {

                // $lookIfResteCilent = $this->caisseRepository->lookResteClient($request->client);

                $userConnected = Auth::user()->id;

                $data = Encaissement::find((int) $request->id);
                // dd($data->facture_id);
                $lookFactureArrayId = Encaissement::where('facture_id', $data->facture_id)->get();
                // dd($lookFactureArrayId[0]);

                $factureLook = facture::find((int) $data->facture_id);


                $factureId = $data->facture_id;

                $searchService = facture::whereIn('id', explode(',', $factureId))->get();

                if ($data->montant == $request->montant) {

                    // Update encaissement  

                    // dd($data->ispayed);

                    if ($data->ispayed  == 1) {
                        // dd('aa');
                        $updateStock = $this->stock($searchService, $data->description);
                    }
                    // dd('ee');
                    $data->payer = $request->montant;
                    $data->date = Carbon::today();
                    $data->ispayed = 4;
                    $data->user_id = $userConnected;
                    $data->save();

                    $caisse = Caisse::create([
                        'encaissement_id' => $data->id,
                        'solde' => $data->montant
                    ]);


                    return [
                        'data' => true,
                        'message' => 'Le payement a etait bien effecetuer'
                    ];
                } elseif ($request->montant < $data->montant) {

                    $reste = $data->montant - $request->montant;
                    // Encaissement
                    if ($data->ispayed  == 1) {
                        // dd('aa');
                        $updateStock = $this->stock($searchService, $data->description);
                    }

                    // dd("ooo");
                    $data->payer = $request->montant;
                    $data->date = Carbon::today();
                    $data->ispayed = 3;
                    $data->reste = $reste;
                    $data->user_id = $userConnected;
                    $data->save();


                    $caisse = Caisse::create([
                        'encaissement_id' => $data->id,
                        'solde' => $request->montant
                    ]);

                    $encaissement = Encaissement::Create([
                        'description' => "Reste de la facture de " . $request->client . " numero [" . $data->facture_id . "]",
                        'facture_id' => $data->facture_id,
                        'montant' => $reste,
                        'payer' => 0,
                        'reste' => 0,
                        'ispayed' => 2,
                        'date' => Carbon::today(),
                        'user_id' => $userConnected,
                    ]);
                    // dd($encaissement);
                    return [
                        'data' => true,
                        'message' => 'Le paeymenent a etait beine effectuer mais le client doit encore payer' . $reste
                    ];
                }
            });

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }


    public function updateData($request, $id)
    {

        try {

            $data = DB::transaction(function () use ($request, $id) {

                // $lookIfResteCilent = $this->caisseRepository->lookResteClient($request->client);

                $userConnected = Auth::user()->id;


                $encaissements = Encaissement::findOrFail($id);


                if (!is_null($encaissements->facture_id)) {

                    $somme_montant = 0;
                    $translateDurerr = null;
                    $factures = facture::where('id', $request['idFacture'])->get();

                    $factureId = explode(',', $encaissements->facture_id);



                    $factures = facture::whereIn('id', explode(',', $encaissements->facture_id))->get();

                    // dd(count($factures));
                    for ($i = 0; $i < count($factures); $i++) {
                        $service = $request[$i]['service'];

                        if ($service == 1) {

                            $minute = $request[$i]['quantite'];

                            $translateDurerr = $this->detecterHeuresMinutes($minute);

                            $montantDefault = $this->getMontant($service);
                            $montantPayement = $minute * $montantDefault;
                            // dd($montantPayement);
                            if ($minute <= 500) {
                                # code...
                                $montantPayement = 500;
                            }
                            $deuxDerniersChiffres = $montantPayement % 100;
                            if ($deuxDerniersChiffres >= 50) {
                                // Arrondir le montant au multiple de 100 supérieur le plus proche
                                $nombreArrondi = ceil($montantPayement / 100) * 100;
                            } else {
                                // Arrondir le montant au multiple de 100 inférieur le plus proche
                                $nombreArrondi = floor($montantPayement / 100) * 100;
                            }
                            $descriptionEntrant = Service::find((int)$service);
                            // dd($nombreArrondi,'connexiont');
                            $facture = facture::findOrFail((int)$request[$i]['idFacture']);

                            $facture->description = $descriptionEntrant->designation;
                            $facture->service_id = $service;
                            $facture->quantite = $minute;
                            $facture->montant = $nombreArrondi;

                            $facture->date = Carbon::today();
                            $facture->client = $request->client;
                            $facture->personnel_id = $request->personnels;
                            $facture->save();
                        } else {
                            $quantite = $request[$i]['quantite'];

                            $montantDefault = $this->getMontant($service);
                            $montantPayement = $quantite * $montantDefault;


                            // Extraire les deux derniers chiffres du nombre
                            $deuxDerniersChiffres = $montantPayement % 100;


                            if ($deuxDerniersChiffres >= 50) {
                                // Arrondir le montant au multiple de 100 supérieur le plus proche
                                $nombreArrondi = ceil($montantPayement / 100) * 100;
                            } else {
                                // Arrondir le montant au multiple de 100 inférieur le plus proche
                                $nombreArrondi = floor($montantPayement / 100) * 100;
                            }

                            // dd($nombreArrondi,'pas connexiont');

                            $descriptionEntrant = Service::find((int)$service);

                            $facture = facture::findOrFail((int)$request[$i]['idFacture']);

                            $facture->description = $descriptionEntrant->designation;
                            $facture->service_id = $service;
                            $facture->quantite = $quantite;
                            $facture->montant = $nombreArrondi;

                            $facture->date = Carbon::today();
                            $facture->client = $request->client;
                            $facture->personnel_id = $request->personnels;

                            $facture->save();
                        }

                        $id_facture[] = $facture->id;
                        $descriptionAll[] = $facture->description;
                        $somme_montant += $facture->montant;
                    }


                    // dd($descriptionAll);


                    $descriptionInfo = implode(' , ', $descriptionAll);
                    $newDescription = " ";
                    $newDescription =  is_null($request->client) ? " Payement de  " . $descriptionInfo :
                        "Payement de " . $descriptionInfo . " de " . $request->client;




                    $encaissements->description = $newDescription;
                    $encaissements->montant = $somme_montant;
                    $encaissements->date = Carbon::today();
                    $encaissements->ispayed = 1;
                    $encaissements->user_id = $userConnected;
                    $encaissements->save();
                    $caisse = Caisse::where('encaissement_id', $encaissements->id)->first();

                    return [
                        'data' => true,
                        'message' => 'Votre mises a jour est bien reussit'
                    ];
                } else {

                    $encaissements->montant = $request->montant;
                    $encaissements->date = Carbon::today();
                    $encaissements->ispayed = 0;
                    $encaissements->user_id = $userConnected;
                    $encaissements->save();

                    $caisse = Caisse::where('encaissement_id', $encaissements->id)->first();

                    $caisse->solde = $encaissements->montant;
                    $caisse->save();


                    return [
                        'data' => true,
                        'message' => 'Votre mises a jour est bien reussit'
                    ];
                }
            });

            return $data;
        } catch (\Throwable $th) {

            return $th;
        }
    }


    public function deleteData($id)
    {
        try {
            $data = DB::transaction(function () use ($id) {

                $encaissement = Encaissement::findOrFail($id);



                $factures = facture::whereIn('id', explode(',', $encaissement->facture_id))->delete();
                $encaissement->delete();
                return [
                    'data' => true,
                    'message' => "Vous avez supprimer le payement de facture $encaissement->facture_id "
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function stock($data, $description)
    {

        $valinne = [];
        foreach ($data as $item) {

            $serviceId = $item->service_id;

            $service = Service::with('materiels')->where('id', $serviceId)->get();

            if (is_null($service[0]['materiels_id'])) {
                continue; // Passer au prochain enregistrement si le service n'est pas trouvé
            }

            $materiel = Materiels::where('id', $service[0]->materiels_id)->first(); // Supposons qu'un service ait un seul matériel associé.

            if (!$materiel) {
                continue; // Passer au prochain enregistrement si le matériel n'est pas trouvé
            }
            $stockMateriels = StockMateriels::where('materiels_id', $materiel->id)->first();
            // dd($stockMateriels);
            if (!$stockMateriels) {
                continue; // Passer au prochain enregistrement si le stock du matériel n'est pas trouvé
            }

            $stockMateriels->quantite -= (int) $item->quantite;
            $stockMateriels->save();
            // dd($item);
            $etatStock = EtatStockMateriels::create([
                'stock_materiels_id' => $stockMateriels->materiels_id,
                'facture_id' =>  $item->id,
                'quantite' => $item->quantite,
                'observation' => 'payement du service ' . $description,
            ]);
            // dd($stockMateriels);

            $valinne[] = $etatStock->id;
        }
        return $valinne;
    }


    public function saveDebutJourney($request)
    {
        // dd($request);
        try {
            $data = DB::transaction(function () use ($request) {
                $userConnected = Auth::user()->id;


                $encaissement = Encaissement::Create([
                    'facture_id' => null,
                    'description' => 'Debut de la journee',
                    'montant' => $request->montant,
                    'date' => Carbon::today(),
                    'user_id' => $userConnected
                ]);
                // dd($encaissement);

                $caisse = Caisse::create([
                    'encaissement_id' => $encaissement->id,
                    'solde' => $encaissement->montant
                ]);

                $btnStart = ButtonActive::findOrFail((int) $request->btnActif);
                
                $btnStart->actif = 0;
                $btnStart->save();
                
                $btnEnd = ButtonActive::findOrFail((int) 2);
                $btnEnd->actif = 1;
                $btnEnd->save();
                
                

                return [
                    'data' => true,
                    'message' => 'Votre Caisse est est bien demarer'
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }


    public function saveFinJourney()
    {
        // dd($request);
        try {
            $data = DB::transaction(function () {

                $dateDay = Carbon::today();

                $userConnected = Auth::user()->id;
                $recetteToDay = Encaissement::where('date', $dateDay)->sum('montant');



                $endDay = Encaissement::create([
                    'description' => 'Fin du caisse a la somme de ' . $recetteToDay . 'Ar',
                    'montant' => $recetteToDay,
                    'date' => $dateDay,
                    'user_id' => $userConnected,
                ]);

                $caisse = Caisse::create([
                    'encaissement_id' => $endDay->id,
                    'solde' => 0
                ]);


                $btnStart = ButtonActive::findOrFail((int) 1);
                
                $btnStart->actif = 1;
                $btnStart->save();
                
                $btnEnd = ButtonActive::findOrFail((int) 2);
                $btnEnd->actif = 0;
                $btnEnd->save();

                return [
                    'data' => true,
                    'message' => "Fin de la journey, vous avez collecte de  $recetteToDay Ar "
                ];
            });

            return $data;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function detecterHeuresMinutes($chaine)
    {
        // $chaine = "20";
        $expressionReguliere = '/(\d{1,2})[:;,|&](\d{1,2})|(\d{1,3})/';
        $resultat = preg_match($expressionReguliere, $chaine, $correspondances);
        // dd($correspondances);
        if ($resultat) {
            if (isset($correspondances[1]) && isset($correspondances[2]) && $correspondances[1] != "" && $correspondances[2] != "") {
                // Le cas où le nombre est au format "heures:minutes"
                $heures = (int)$correspondances[1];
                $minutes = (int)$correspondances[2];

                if ($heures >= 0 && $heures <= 23 && $minutes >= 0 && $minutes <= 59) {
                    return "$heures" . "h" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . "mn";
                }
            } elseif (isset($correspondances[3])) {
                // Le cas où le nombre est sans format spécifique (uniquement un nombre entier)
                $nombre = (int)$correspondances[3];

                if ($nombre >= 0 && $nombre < 60) {
                    // Le nombre est considéré comme des minutes
                    return "0h" . str_pad($nombre, 2, "0", STR_PAD_LEFT) . "mn";
                } elseif ($nombre >= 60 && $nombre < 1000) {
                    // Le nombre est considéré comme des heures et des minutes
                    $heures = floor($nombre / 100);
                    $minutes = $nombre % 100;

                    if ($heures >= 0 && $heures <= 23 && $minutes >= 0 && $minutes <= 59) {
                        return "$heures" . "h" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . "mn";
                    }
                }
            }
        }

        return "Aucune heure et minute détectée.";
    }
}
