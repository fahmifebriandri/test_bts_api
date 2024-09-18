<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecurityUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    // Login Method
    public function login(Request $request)
    {
        // Validasi input login secara manual
        if (!$request->has('username') || !$request->has('password')) {
            return response()->json([
                'message' => 'Username and password are required'
            ], 400); // Bad Request
        }

        // Cek apakah username dan password sesuai
        $user = SecurityUser::where('username', $request->input('username'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Jika berhasil login
            Auth::login($user); // Menggunakan Laravel Auth untuk login
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'auth_check' => Auth::check(),
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid username or password'
            ], 401); // Unauthorized
        }
    }


    // Register Method
    public function register(Request $request)
    {
        // Validasi input register secara manual
        if (!$request->has('email') || !$request->has('username') || !$request->has('password')) {
            return response()->json([
                'message' => 'Email, username, and password are required'
            ], 400); // Bad Request
        }

        // Cek format email
        if (!filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'message' => 'Invalid email format'
            ], 400); // Bad Request
        }

        // Cek jika email atau username sudah ada
        if (SecurityUser::where('email', $request->input('email'))->exists()) {
            return response()->json([
                'message' => 'Email is already taken'
            ], 409); // Conflict
        }

        if (SecurityUser::where('username', $request->input('username'))->exists()) {
            return response()->json([
                'message' => 'Username is already taken'
            ], 409); // Conflict
        }

        // Cek panjang password
        if (strlen($request->input('password')) < 6) {
            return response()->json([
                'message' => 'Password must be at least 6 characters long'
            ], 400); // Bad Request
        }

        // Membuat user baru
        $user = new SecurityUser();
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password')); // Enkripsi password
        $user->save();

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201); // Created
    }


    // Logout Method
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    // Check if user is logged in
    public function isLoggedIn(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user(); // Mengambil informasi pengguna yang sedang login
            return response()->json([
                'message' => 'User is logged in',
                'user' => $user,
            ]);
        } else {
            return response()->json(['message' => 'User is not logged in'], 401);
        }
    }
}
