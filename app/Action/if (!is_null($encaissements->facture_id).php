if (!is_null($encaissements->facture_id)) {
                    $userConnected = Auth::user()->id;

                    $somme_montant = 0;
                    $id_facture = [];
                    $nombre = (int) $request->nombrePayement;
                    $translateDurerr = "";
                    for ($i = 0; $i < $nombre; $i++) {
                        $service = $request[$i]['service'];

                        // if ($service == 1) {

                        $minute = $request[$i]['quantite'];
                        $quantite = $request[$i]['quantite'];

                        if($service == 1)
                        {
                            $quantiteOrMinute = $minute;
                        }
                        else{
                            $quantiteOrMinute = $quantite;
                        }

                        $translateDurerr = $this->detecterHeuresMinutes($quantiteOrMinute);

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


                        $factures = facture::where('id', $request[$i]['idFacture'])->get();
                        
                        foreach ($factures as $dataFactures) {
                            $dataFactures->description = $descriptionEntrant->designation;
                            $dataFactures->service_id = $service;
                            $dataFactures->quantite = $minute;
                            $dataFactures->montant = $nombreArrondi;

                            $dataFactures->date = Carbon::today();
                            $dataFactures->client = $request->client;
                            $dataFactures->personnel_id = $request->personnels;
                            $dataFactures->save();
                        }

                        $id_facture[] = $factures[$i]['id'];
                        $somme_montant += $factures[$i]['montant'];
                    }
                    dd($factures);

                    $ids_concatenated = implode(',', $id_facture);
                    // dd($ids_concatenated);
                    $id = $id_facture;

                    // dd($translateDurerr);

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
                    $newDescription = " ";
                    if (is_null($translateDurerr)) {
                        $newDescription = $translateDurerr;
                    } else {
                        $newDescription =  is_null($encaissements->facture_id) ? " Payement de la facture de " . (is_null($request->clienet) ? " " :  " " . $request->client) : "Payement de facture numero " . $encaissements->facture_id;
                    }


                    $encaissements->description = $newDescription;
                    $encaissements->montant = $somme_montant;
                    $encaissements->date = Carbon::today();
                    $encaissements->ispayed = 1;
                    $encaissements->user_id = $userConnected;
                    $encaissements->save();
                    $caisse = Caisse::where('encaissement_id', $encaissements->id)->first();

                    if (!is_null($caisse)) {

                        $caisse->solde = $encaissements->montant;
                        $caisse->save();
                    }

                    return [
                        'data' => true,
                        'message' => 'Votre mises a jour est bien reussit'
                    ];
                }

