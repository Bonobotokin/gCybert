<?php 

namespace App\Repository;

use App\Interfaces\ServicesRepositoryInterfaces;
use App\Models\Service;
use Carbon\Carbon;

class ServicesRepository implements ServicesRepositoryInterfaces
{
    public function getAll()
    {
        $data = Service::with(['user', 'user.personnel', 'materiels'])
                        ->get()
                        ->map(function ($data) {

                            $date = Carbon::parse($data->created_at)->format('m/d/Y');

                            return [
                                'id' => $data->id,
                                'designation' => $data->designation,
                                'prix' => $data->prix,
                                'personnel' => $data->user->name,
                                'date' => $date,
                                'materiels' => is_null($data->materiels)? " " : $data->materiels->designation
                            ];

                        });
        // dd($data);
        return $data;
    }
}