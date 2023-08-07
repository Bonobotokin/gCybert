<?php 


namespace App\Repository;

use APp\Interfaces\SearchDataInputRepositoryInterfaces;
use App\Models\Service;

class SearchDataInputRepository implements SearchDataInputRepositoryInterfaces
{

    public function lookNameServie($designation)
    {
        $results = Service::where('designation', 'LIKE', '%'.$designation.'%')->pluck('designation');

        return $results;
    }

}