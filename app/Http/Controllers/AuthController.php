<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        session(['admin_id' => $user->id]);

        return redirect()->route('students.index')->with('success', 'Logged in successfully!');
    }

    public function logout()
    {
        session()->forget('admin_id');

        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
