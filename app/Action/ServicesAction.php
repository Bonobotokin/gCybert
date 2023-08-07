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

    public function updateServices($request,$id)
    {
        try {
            $data = DB::transaction(function () use ($request,$id){
                $userConnected = Auth::user()->id;
                $service = Service::findOrFail($id);
                $service->designation = $request->designation;
                $service->materiels_id = $request->materiels_id;
                $service->prix = $request->prix;
                $service->user_id = $userConnected;

                $service->save();

                // dd($service);
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

    public function deleteService($id)
    {
        try {
            $data = DB::transaction(function () use ($id){
                $service = Service::findOrFail($id);
                $service->delete();
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

    
}