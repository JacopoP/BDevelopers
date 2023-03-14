<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Models\Developer;
use App\Models\Sponsor;

class SponsorController extends Controller
{
    public function SponsorCreate(Request $request){

        $data = $request -> all();

        $sponsor = Sponsor::find($data['id']);  
        $sponsorTime = $sponsor -> length;

        $developer = Developer::with('sponsors')->find(Auth::id());

        $start_date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        
        foreach($developer->sponsors as $sponsor){
            if($start_date <= $sponsor->date_end) $start_date = $sponsor->date_end;
        }
        
        $end_date = $developer -> addSponsorship($start_date, $sponsorTime);

        $developer->sponsors()->attach($sponsor, [
            'date_start' => $start_date,
            'date_end' => $end_date
        ]);

        return Inertia::render('Profile/DeveloperSettings', compact('developer', 'sponsor'));
    }
}
