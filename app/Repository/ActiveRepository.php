<?php

namespace App\Repository;

use App\Interfaces\ActiveRepositoryInterface;
use App\Models\ButtonActive;
use Carbon\Carbon;

class ActiveRepository implements ActiveRepositoryInterface
{
    public function activeBtnDay()
    {
        $toDay = Carbon::today();

        // $data = ButtonActive::where
    }
}