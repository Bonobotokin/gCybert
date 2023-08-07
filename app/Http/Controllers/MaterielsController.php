<?php

namespace App\Http\Controllers;

use App\Action\MaterielsAction;
use App\Http\Requests\StoreMaterielsRequest;
use App\Repository\CaisseRepository;
use App\Repository\MaterielsRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MaterielsController extends Controller
{
    //
    private $materielsRepository;


    public function __construct(
        MaterielsRepository $materielsRepository
    )
    {
        $this->materielsRepository = $materielsRepository;
    }

    public function stock() : View
    {
        $stock = $this->materielsRepository->stock();
        return view('Magasin.stock',
                    [
                        'stock' => $stock
                    ]
                );
    }

    public function etatStock() : View
    {
        $etat = $this->materielsRepository->etatStock();
        return view('Magasin.etatStock',
                    [
                        'etatStock' => $etat
                    ]
                );
    }


    public function store(StoreMaterielsRequest $request, MaterielsAction $action) : RedirectResponse
    {
        $response =  $action->savecNewMateriels($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('parametres.application',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }

    public function update(Request $request, $id,MaterielsAction $action) : RedirectResponse
    {
        

        $response =  $action->updateMateriels($request, $id);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('parametres.application',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }

    }

    public function destroy($id,MaterielsAction $action) : RedirectResponse
    {
        // dd($id);
        $response =  $action->deleteMateriels($id);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('parametres.application',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }

    }


}
