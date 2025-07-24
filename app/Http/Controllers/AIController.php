<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    

public function matchScore(Request $request)
{
    $fsq_id = $request->query('fsq_id');
    $wlid = $request->query('wlid');
     $userId = Auth::id();


    $user = User::with('preference')->find($userId);


    $authUser = [
         'id' => $user->id,
    'name' => $user->name, // ini penting buat prompt AI
    'preference' => [
        'smoking' => $user->preference->smoking,
        'alcoholic' => $user->preference->alcoholic,
        'tidiness' => $user->preference->tidiness,
        'prefered_age' => $user->preference->prefered_age,
        'routine_type' => $user->preference->routine_type,
        'room_type' => $user->preference->room_type,
        'socializing' => $user->preference->socializing,
        'cooking_freq' => $user->preference->cooking_freq,
        'room_temperature' => $user->preference->room_temperature,
        'work_type' => $user->preference->work_type,
        'noise_tolerance' => $user->preference->noise_tolerance,
        'music_genre' => $user->preference->music_genre,
    ]
    ];

    $otherUsers = WaitingList::where('wlid', $wlid)
    ->where('homestay_id', $fsq_id)
    ->with('users.preference') // eager load preference-nya
    ->first();

    $waitingListUsers = $otherUsers->users->map(function ($u) {
        return [
            'id' => $u->id,
        'name' => $u->name,
        'preference' => [
            'smoking' => $u->preference->smoking,
            'alcoholic' => $u->preference->alcoholic,
            'tidiness' => $u->preference->tidiness,
            'prefered_age' => $u->preference->prefered_age,
            'routine_type' => $u->preference->routine_type,
            'room_type' => $u->preference->room_type,
            'socializing' => $u->preference->socializing,
            'cooking_freq' => $u->preference->cooking_freq,
            'room_temperature' => $u->preference->room_temperature,
            'work_type' => $u->preference->work_type,
            'noise_tolerance' => $u->preference->noise_tolerance,
            'music_genre' => $u->preference->music_genre,
        ]
        ];
    })->values()->toArray();

    try {
        $response =  Http::timeout(1000000000)->post('http://127.0.0.1:5000/api/match-scores', [
            'auth_user' => $authUser,
            'waiting_list_users' => $waitingListUsers
        ]);

        if ($response->successful()) {
            return response()->json(['score' => $response['data']]);
        } else {
            return response()->json(['score' => 0, 'error' => 'Flask gagal respon'], 500);
        }
    } catch (\Exception $e) {
        return response()->json(['score' => 0, 'error' => $e->getMessage()], 500);
    }
}

}
