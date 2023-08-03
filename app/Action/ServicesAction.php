<?php 

namespace App\Action;

use App\Models\Service;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicesAction 
{

    private $userRepository;


    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function saveNewServices($request)
    {
        try {
            $data = DB::transaction(function () use ($request){

                $userConnected = Auth::user()->id;
                                
                $newService = Service::create([
                    'designation' => $request->designation,
                    'materiels_id' => $request->materiels_id,
                    'prix' => $request->prix,
                    'user_id' => $userConnected
                ]);

                
                return [
                    'data' => true,
                    'message' => 'La nouvelle services est bien enregistrer'
                ];
            });
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    
}