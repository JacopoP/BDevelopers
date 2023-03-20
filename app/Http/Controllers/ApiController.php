<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\User;
use App\Models\Developer;
use App\Models\Technology;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Sponsors;

class ApiController extends Controller
{

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
        ->get();

        foreach($developers as $index => $developer){
            $delete = false;
            
            $reviewN = 0;
            $reviews = Review::groupBy('developer_id')->having('developer_id', '=', $developer->id)->select('developer_id', DB::raw('count(*) as total'))->get();
            if(count($reviews) > 0)  $reviewN = $reviews[0]->total;
            
            $avg= 0;
            foreach($developer->ratings as $rating){
                $avg += $rating->value; 
            }
            if(count($developer->ratings)) $avg /= count($developer->ratings);
            
            if($reviewN < $data['reviewFilter']) $delete = true;
            if($avg < $data['ratingFilter']) $delete = true;

            if(array_key_exists('techFilter', $data)){
                $techIds=[];
                forEach($developer->technologies as $technology){
                    $techIds[]=$technology->id;
                }
                if(count(array_intersect($techIds, $data['techFilter'])) != count($data['techFilter'])) $delete = true;
            }

            if($delete) unset($developers[$index]);
        }
        return response()->json([
            'success' => true,
            'response' => [
                'developers' => $developers,
            ]
        ]);
    }

    public function getImgProfile($id){
        $developer = Developer::find($id);
        
        return response()->json([
            'success' => true,
            'response' => [
                'path' => $developer->profile_path,
            ]
        ]);

    }
}
