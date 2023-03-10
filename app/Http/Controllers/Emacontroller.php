<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Developer;
use App\Models\User;
use App\Models\Review;
use App\Models\Message;


class Emacontroller extends Controller
{
    public function DevShow($id)
    {
        $developer = Developer::with('user')->find($id);
        return Inertia::render('DevShow', compact('developer'));
    }



    public function ReviewStore(Request $request, $id)
    {
        $data = $request->validate([
            'text' => 'string|max:500',
            'full_name' => 'nullable|string|max:128'
        ]);
        
        $developer = Developer::find($id);
        
        $review=Review::make($data);
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
        
        $message=Message::make($data);
        $message->developer()->associate($developer);
        $message->save();
        return redirect()->back();
    }
}
