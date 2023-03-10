<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;

use App\Models\Technology;

class IndexController extends Controller
{
    public function goToIndex(){
        $technologies = Technology::all();
        return Inertia::render('Index', compact('technologies'));
    }
}
