<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// class UserController extends Controller
// {
//     //
//     public function signIn()
//     {
//         return view('login');
//     }

//     public function login(Request $request)
//     {
//         $validate = $request->validate([
//             'email' => 'required|email',
//             'password' => 'required|string',
//         ]);
//         if (auth()->attempt($validate)) {
//             return redirect()->route('tickets.index')->with('success', 'Logged in successfully.');
//         } else {
//             return back()->withErrors(['email' => 'Invalid credentials.']);
//         }
//     }

//     public function logout()
//     {
//         auth()->logout();
//         return redirect()->route('login')->with('success', 'Logged out successfully.');
//     }
// }
