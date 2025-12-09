<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Employees;

class AdminAuthController extends Controller
{
    public function login(){
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }
    public function postLogin(Request $request){
        // Validate the request
        $request->validate([
            'username' => 'required|string',
            'user_password' => 'required|string',
        ]);

        // Attempt to find the user by username
        $user = Employees::where('username', $request->username)->first();
        if (!$user) {
            return back()->withErrors([
                'username' => 'No user found with this username.',
            ])->withInput();
        }
        
        if (!Hash::check($request->user_password, $user->password)) {
            return back()->withErrors([
                'password' => 'The provided password does not match.',
            ])->withInput();
        }
        
        // Check if user exists and the password matches
        if ($user && Hash::check($request->user_password, $user->password)) {
            // Log the user in
            Auth::login($user);
            // Authentication passed
            return redirect()->intended('/dashboard'); // Redirect to intended page or home
        }

        // Authentication failed
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records',
        ])->withInput(); 
    }
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token to prevent session fixation attacks
        $request->session()->regenerateToken();

        // Redirect to login or another page
        return redirect('/login')->with('status', 'You have been logged out.');
    }
}
