<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\User;
use App\Models\Developer;
use App\Models\Technology;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Sponsors;

class ApiController extends Controller
{
    public function index(){
        $developers = Developer::with('user', 'technologies', 'ratings', 'reviews', 'sponsors')->limit(25)->get();
        return response()->json([
            'success' => true,
            'response' => [
                'developers' => $developers,
            ]
        ]);
    }

    public function filter(Request $request){
        $data = $request->all();
        $developers=Developer::with('user', 'technologies', 'ratings', 'reviews', 'sponsors')
        ->whereHas('user', function($query) use ($data){
            $query->where('name', 'like', '%' .$data['nFilter'] .'%')
                ->where('last', 'like', '%' .$data['lFilter'] .'%');
        })
        ->limit(25)->get();
        return response()->json([
            'success' => true,
            'response' => [
                'developers' => $developers,
            ]
        ]);
    }
}
