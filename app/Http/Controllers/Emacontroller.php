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
        return Inertia::render('Profile/DevShow', compact('developer', 'review'));
    }



    public function ReviewStore($id, Request $request)
    {

        $data = $request->validate([
            'text' => 'string|max:254',
        ]);

        $developer = Developer::with('user')->find($id);


        $review = Review::find($id);

        if ($review) {
            $review->text = $data['text'];
            $review->save();
        }

        // $review = new Review();

        // $review->text = $data['text'];

        // $review->developer_id = 1;

        // $review->save();

        return Inertia::render('Profile/DevShow', compact('developer', 'review'));
    }
    // la cosa strana è che teoricamente è già reindirizzato a devshow
    // no va beh ero anche io che mi ero fermato a pensare

    // public function DevStore(Request $request)
    // {

    //     $data = $request->validate([
    //         'address' => 'nullable|string',
    //         'phone_number' => 'nullable|string|max:32',
    //         'profile_path' => 'nullable|mimes:jpg,bmp,png,svg,jpeg,gif,webp|max:2048',
    //         'cv_path' => 'nullable|mimes:pdf,docx,jpeg,png,jpg|max:2048',
    //         'portfolio_url' => 'nullable|string',
    //         'about_me' => 'nullable|string',
    //         'performances' => 'nullable|string',
    //     ]);

    //     $developer = Developer::find(Auth::id());

    //     if (isset($data['profile_path'])) {
    //         $profile_path = Storage::put('uploads/profile_photo', $data['profile_path']);
    //         $data['profile_path'] = $profile_path;
    //     } else {
    //         $data['profile_path'] = $developer->profile_path;
    //     }
    //     if (isset($data['cv_path'])) {
    //         $cv_path = Storage::put('uploads/profile_cv', $data['cv_path']);
    //         $data['cv_path'] = $cv_path;
    //     } else {
    //         $data['cv_path'] = $developer->cv_path;
    //     }


    //     $developer->update($data);

    //     $developer->save();

    //     return redirect()->back();
    // }
}
