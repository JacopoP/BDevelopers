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

    public function filter(Request $request){
        $data = $request->post;
        $techN=0;
        $techList=[];

        if(array_key_exists('techFilter', $data)){
            $techList=$data['techFilter'];
            $techN=count($data['techFilter']);
        }
        
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
        // filter per review number
        ->Has('reviews', '>=', $data['reviewFilter'])
        // filter per rating avg
        ->withAvg('ratings as avg_rating', 'value')
        ->when($data['ratingFilter'] != 0, function($query) use ($data){
            $query->having('avg_rating', '>=', $data['ratingFilter']);
        })
        // filter per technologies
        ->whereHas('technologies', function($query) use ($techList){
            $query->whereIn('id', $techList);
        }, '>=', $techN)
        ->paginate(24);

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
