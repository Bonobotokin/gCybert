<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    //

    public function search(Request $request)
    {
        $term = $request->input('term');
        $results = YourModel::where('name', 'LIKE', '%'.$term.'%')->pluck('name');

        return response()->json($results);
    }

}
