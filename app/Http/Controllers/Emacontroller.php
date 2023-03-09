<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Developer;
use App\Models\User;



class Emacontroller extends Controller
{
    public function DevShow($id)
    {
        // $dato = [12];
        // dd($dato);
        $developer = Developer::with('user')->find($id);
        return Inertia::render('Profile/DevShow', compact('developer'));
    }

}