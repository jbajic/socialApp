<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class SearchController extends Controller
{
   public function getResults(Request $request)
   {
        //also possible to do it like that
        $search_string = $request->input('search_string');
        
        if( !$search_string )
        {
            return redirect()->route('home');
        }
        else
        {
            $users = User::where(DB::raw("CONCAT(first_name, ' ',last_name)"), "LIKE", "%".$search_string."%")
                            ->orWhere("username", "LIKE", "%".$search_string."%")
                            ->get();

        }
        return view('search.results', ['users' => $users]);
   }
}
