<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

// Models
use App\Models\User;
use App\Models\Developer;
use App\Models\Technology;
use App\Models\Message;
use App\Models\Review;
use App\Models\Rating;
use App\Models\Sponsor;

$active_user = 0;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        
        $developer = Developer::find($user->id);
        
        Auth::logout();


        if(isset($developer->cv_path)){
            Storage::delete([$developer->cv_path]);
        }
        if(isset($developer->profile_path)){
            Storage::delete([$developer->profile_path]);
        }
        $developer->technologies()->sync([]);
        $developer->sponsors()->sync([]);
        $developer->reviews()->delete();
        $developer->ratings()->delete();
        $developer->messages()->delete();
        $developer->delete();
        $user->delete();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
