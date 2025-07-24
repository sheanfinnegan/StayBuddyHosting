<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['profile', 'preference'])->get();
        // replace users DOB with actual age using carbon
        foreach ($users as $user) {
            if ($user->profile && $user->profile->DOB) {
                $user->profile->age = now()->diffInYears($user->profile->DOB);
            } else {
                $user->profile->age = null; // or set a default value
            }
        }

        return view('popup.rmdetailpopup', compact('users'));
    }
}
