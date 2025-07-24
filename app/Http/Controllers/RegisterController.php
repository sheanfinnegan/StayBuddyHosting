<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register'); // Pastikan view sesuai
    }

    public function register(Request $request)
    {
        $randNum = rand(1, 10);
        // Validasi input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:20',
            'occupation' => 'required|in:Student,Worker,Businessman',
            'date' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:male,female',
        ]);

        // Gabungkan nama depan dan belakang
        $fullName = $validated['first_name'] . ' ' . $validated['last_name'];

        // Simpan user
        $user = User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'phone_num' => $validated['phone_number'],
            'occupation' => $validated['occupation'],
            'bod' => $validated['date'],
            'gender' => ucfirst($validated['gender']),
            'password' => Hash::make($validated['password']),
            'rating' =>  rand(35, 50) / 10,
            'profile_picture' => 'assets/user/user-' . $randNum . '.jpg'

        ]);
        Auth::login($user);

        return redirect('/questionnaire/1')->with('success', 'Registration successful!');
    }
}
