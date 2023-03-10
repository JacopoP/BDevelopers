<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

// Models
use App\Models\User;
use App\Models\Developer;
use App\Models\Technology;

class DeveloperController extends Controller
{
        // DeveloperSettings
        public function DevCreate(){
            // $user = User::with('developer') -> find($id);
            $technologies = Technology::all();  
            $developer = Developer::find(Auth::id());
            $developerTechnology = $developer -> technologies() -> get();

            return Inertia::render('Profile/DeveloperSettings', compact('technologies', 'developer', 'developerTechnology'));
        }
    
        public function DevStore(Request $request){
            
            // Run validations
            $data = $request -> validate([
                'address' => 'nullable|string',
                'phone_number' => 'nullable|string|max:32',
                'profile_path' => 'nullable|mimes:jpg,bmp,png,svg,jpeg,gif,webp|max:2048',
                'cv_path' => 'nullable|mimes:pdf,docx,jpeg,png,jpg|max:2048',
                'portfolio_url' => 'nullable|string',
                'about_me' => 'nullable|string',
                'performances' => 'nullable|string',
            ]);
    
            // Get currently logged developer
            $developer = Developer::find(Auth::id());
    
            // Files update logics
            if(isset($data['profile_path'])){
                $profile_path = Storage::put('uploads/profile_photo', $data['profile_path']);
                $data['profile_path'] = $profile_path;
            }else{
                $data['profile_path'] = $developer -> profile_path;
            }
            if(isset($data['cv_path'])){
                $cv_path = Storage::put('uploads/profile_cv', $data['cv_path']);
                $data['cv_path'] = $cv_path;
            }else{
                $data['cv_path'] = $developer -> cv_path;
            }
            
            $developer -> update($data);

            // Technologies update
            $developer -> technologies() -> sync($request->developer_technologies);
    
            return redirect() -> route('dashboard');
        }
    
        public function DevDelete(){
    
            $data = [
                'address' => null,
                'phone_number' => null,
                'profile_path' => null,
                'cv_path' => null,
                'portfolio_url' => null,
                'about_me' => null,
                'performances' => null,
            ];
    
            $developer = Developer::find(Auth::id());
    
            if(isset($developer->cv_path)){
                Storage::delete([$developer->cv_path]);
            }
            if(isset($developer->profile_path)){
                Storage::delete([$developer->profile_path]);
            }
            
            $developer -> update($data);
    
            return redirect() -> route('dashboard');
        }        
}
