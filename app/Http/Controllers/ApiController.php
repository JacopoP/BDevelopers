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
        $developers = Developer::with('user', 'technologies', 'ratings', 'reviews', 'sponsors')->limit(100)->get();
        return response()->json([
            'success' => true,
            'response' => [
                'developers' => $developers,
            ]
        ]);
    }

    public function filter(Request $request){
        $data = $request->all();

        // filter per name
        $developers=Developer::with('user', 'technologies', 'ratings', 'reviews', 'sponsors')
        ->whereHas('user', function($query) use ($data){
            $query->where('name', 'like', '%' .$data['nFilter'] .'%')
                ->where('last', 'like', '%' .$data['lFilter'] .'%')
                ->orWhere(function($query) use ($data) {
                    $query->where('name', 'like', '%' .$data['lFilter'] .'%')
                          ->where('last', 'like', '%' .$data['nFilter'] .'%');
                });
        })
        ->limit(100)->get();

        foreach($developers as $index => $developer){
            $delete = false;
            $techIds=[];
            forEach($developer->technologies as $technology){
                $techIds[]=$technology->id;
            }
            // $reviewN = Review::groupBy('developer_id')->having('developer_id', '=', $developer->id)->count();
            if (count(array_intersect($techIds, $data['techFilter'])) != count($data['techFilter'])) $delete = true;
            // if($reviewN < $data['reviewFilter']) $delete= true;
            if($delete) unset($developers[$index]);
        }
        return response()->json([
            'success' => true,
            'response' => [
                'developers' => $developers,
            ]
        ]);
    }
}
