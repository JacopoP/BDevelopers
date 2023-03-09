<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Developer;
use App\Models\User;
use App\Models\Review;



class Emacontroller extends Controller
{
    public function DevShow($id)
    {
        $developer = Developer::with('user')->find($id);
        // return Inertia::render('Profile/DevShow', compact('developer'));
        $review = Review::with('developer')->find($id);
        return Inertia::render('DevShow', compact('developer', 'review'));
    }



    public function ReviewStore(Request $request, $id)
    {
        $data = $request->validate([
            'text' => 'string|max:255',
            'full_name' => 'nullable|string|max:128'
        ]);
        
        $developer = Developer::find($id);
        
        $review=Review::make($data);
        $review->developer()->associate($developer);
        $review->save();
        return redirect()->back();
    }
}
