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
}
