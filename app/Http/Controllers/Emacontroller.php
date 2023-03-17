<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

// MODELS
use App\Models\Developer;
use App\Models\Review;
use App\Models\Message;
use App\Models\Rating;


class Emacontroller extends Controller
{
    public function DevShow($id)
    {

        $developer = Developer::with('user', 'ratings', 'reviews')->find($id);

        return Inertia::render('DevShow', compact('developer'));
    }



    public function ReviewStore(Request $request, $id)
    {
        $data = $request->validate([
            'text' => 'string|max:500',
            'full_name' => 'nullable|string|max:128'
        ]);

        $developer = Developer::find($id);

        $review = Review::make($data);
        $review->developer()->associate($developer);
        $review->save();
        return redirect()->back();
    }

    public function MessageStore(Request $request, $id)
    {
        $data = $request->validate([
            'text' => 'string|max:500',
            'email' => 'string|max:255',
            'full_name' => 'string|max:128'
        ]);

        $developer = Developer::find($id);

        $message = Message::make($data);
        $message->developer()->associate($developer);
        $message->save();
        return redirect()->back();
    }

    public function RatingStore(Request $request, $id)
    {
        $data = $request->all();

        $developer = Developer::find($id);

        $rating = Rating::find($data['rating']);
        $rating->developers()->attach($developer);
    }
    public function Dashboard()
    {

        // Get currently logged developer
        $developer = Developer::with('user', 'ratings', 'reviews', 'technologies', 'messages', 'sponsors')->find(Auth::id());

        // DEBUG
        // $developer = Developer::with('user', 'ratings', 'reviews', 'technologies', 'messages', 'sponsors')->find(1);

        return Inertia::render('Dashboard', compact('developer'));
    }
}
