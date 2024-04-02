<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Repository\SearchDataInputRepository;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    //

    // private $searchDataInputRepository;

    // public function __construct(
    //     SearchDataInputRepository $searchDataInputRepository
    // )
    // {
    //     $this->searchDataInputRepository = $searchDataInputRepository;   
    // }



    public function searchDataService(Request $request)
    {
        $designation = $request->designation;

        $data = Service::where('designation', 'LIKE', '%' . $designation . '%')->pluck('designation');

        $results = [];
        foreach ($data as $designation) {
            $results[] = ['label' => $designation, 'value' => $designation];
        }

        return $results;
    }
}
