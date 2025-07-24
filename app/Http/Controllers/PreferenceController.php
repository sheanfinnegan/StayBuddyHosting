<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    //
    public function index() {
        $preference = UserPreference::where('user_id', Auth::id())->first();
        // dd($preference);

    return view('preference', compact('preference'));
    }

    public function loadPreferenceContent()
{
    $preference = UserPreference::where('user_id', Auth::id())->first();
    return view('partials.preference_content', compact('preference'));
}
}
