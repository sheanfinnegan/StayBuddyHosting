<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;
use App\Models\WaitingList;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function loadHistoryContent()
{
    $userId = Auth::id();

    // Ambil semua waiting list yang user login termasuk di dalamnya
    $waitingLists = WaitingList::whereHas('users', function ($query) use ($userId) {
    $query->where('id', $userId);
    })->with([
        'users',
        'homestay',
        'payment',         // semua payment untuk dihitung
        'paymentForUser'    // hanya payment user login
    ])->get();

    // dd($waitingLists);
    
    return view('partials.history_content', compact('waitingLists'));
}
}
