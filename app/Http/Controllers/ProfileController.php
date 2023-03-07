<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

// Models
use App\Models\User;
use App\Models\Developer;
use App\Models\Technology;

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

        Auth::logout();
        
        $user -> developer() -> delete();
        $user->delete();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // DeveloperSettings
    public function DevCreate(){
        // $user = User::with('developer') -> find($id);
        $technologies = Technology::all();  
        $developer = Developer::find(Auth::id());
        $developerTechnology = $developer -> technologies();
        return Inertia::render('Profile/DeveloperSettings', compact('technologies', 'developer', 'developerTechnology'));
    }

    public function DevStore(Request $request){
        
        $data = $request -> validate([
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:32',
            'profile_path' => 'nullable|mimes:jpg,bmp,png,svg,jpeg,gif,webp|max:2048',
            'cv_path' => 'nullable|mimes:pdf,docx,jpeg,png,jpg|max:2048',
            'portfolio_url' => 'nullable|string',
            'about_me' => 'nullable|string',
            'performances' => 'nullable|string',
        ]);

        if(isset($data['profile_path'])){
            $profile_path = Storage::put('uploads/profile_photo', $data['profile_path']);
            $data['profile_path'] = $profile_path;
        }
        if(isset($data['profile_cv'])){
            // $cv_path = Storage::put('uploads/profile_cv', $data['cv_path']);
            $cv_path = Storage::disk('public/storage') -> put('uploads/profile_cv', $data['cv_path']);
            $data['cv_path'] = $cv_path;
        }

        $developer = Developer::find(Auth::id());

        $developer -> update($data);

        $developer -> save();

        return redirect() -> back();
    }
    
}
