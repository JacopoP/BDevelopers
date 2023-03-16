<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

// Models
use App\Models\User;
use App\Models\Developer;
use App\Models\Technology;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Sponsors;

class IndexController extends Controller
{
    public function goToIndex(Request $request){
        $data = $request->all();
        $technologies = Technology::all();
        return Inertia::render('Index', compact('data', 'technologies'));
    }

    public function welcome(){
        $technologies = Technology::all();
        $developers = Developer::with('user', 'ratings', 'reviews')
        ->join('developer_sponsor', 'developers.id', '=', 'developer_sponsor.developer_id')
        // ->whereDate('date_start', '<=', date('2021-01-01'))
        // ->whereDate('date_end', '>=', date('2021-01-01'))
        ->limit(50)
        ->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'technologies' => $technologies,
            'developers' => $developers,
        ]);
    }
}

