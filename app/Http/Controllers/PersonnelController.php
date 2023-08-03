<?php

namespace App\Http\Controllers;

use App\Action\PersonnelAction;
use App\Http\Requests\StorePersonnelRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    //
    public function store(StorePersonnelRequest $request, PersonnelAction $action) : RedirectResponse
    {
        $response =  $action->savePersonnel($request);
        // dd($response);
        if (!is_null($response['data'])) {
            // dd($response, 'receptionisteController');exit;
            return redirect()->route('parametres.personnel',['reponse'=>$response])->with('success', $response['message']);

        }else {
            // dd($response, 'receptionisteController');exit;
            return redirect()->back()->withErrors($response)->withInput();
        }
    }
}
