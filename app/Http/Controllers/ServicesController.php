<?php

namespace App\Http\Controllers;

use App\Action\ServicesAction;
use App\Http\Requests\StoreServicesRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicesController extends Controller
{
    //


    public function store(StoreServicesRequest $request, ServicesAction $action) : RedirectResponse
    {
        $response =  $action->saveNewServices($request);
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
