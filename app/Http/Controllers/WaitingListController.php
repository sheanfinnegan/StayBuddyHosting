<?php

namespace App\Http\Controllers;

use App\Models\HomeDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class WaitingListController extends Controller
{
    //
    public function popup(Request $request)
{
    $wlid = $request->input('wlid');
    $users = User::where('wlid', $wlid)->with('preference')->get();
    $waitingList = WaitingList::where('wlid', $wlid)->first();
    $homeDetails = HomeDetail::where('fsq_id', $waitingList->homestay_id)->first();

    $userScores = $users->map(function ($user) {
        $user->score = rand(70, 95); // skor random 70 - 100
        return $user;
    });

    // Kirim ke Blade
    $html = view('popup.rmdetailpopup', [
        'wlid' => $wlid,
        'users' => $userScores,
        'home' => $homeDetails,
        'waitingList' => $waitingList
    ])->render();

    return response($html);
}

public function popupNew($fsq_id)
{

    
   
    $homeDetails = HomeDetail::where('fsq_id', $fsq_id)->first();

    // dd($homeDetails);

    // Kirim ke Blade
    $html = view('popup.rmdetailpopup', [
        'wlid' => null,
        'users' => collect(),
        'home' => $homeDetails,
        'waitingList' => null
    ])->render();

    return response($html);
}

public function joinBuddies(Request $request) {
        $userId = Auth::id();
        $homestayId = $request->homestay_id;
        $wlid = $request->wlid; 
       $user = User::with('preference')->find($userId);
    $age = \Carbon\Carbon::parse($user->bod)->age;
    if ($user->wlid) {
         return response()->json(['message' => 'Sudah join'], 400);
    }    
    
    $waitingList = null;
    if($wlid == null) {
        $waitingList = WaitingList::create([
            'homestay_id' => $homestayId,
            'user_id' => $userId,
            'created' => now(),
            'remaining_time' => now()->addHours(3), // contoh
            'done' => false,
        ]);

        $user->wlid = $waitingList->wlid;
        $user->save();
        // dd($waitingList);
    } else {
        
        $user->wlid = $wlid;
        $user->save();
        $waitingList = WaitingList::find($wlid);
    }
    
    $homestay = HomeDetail::where('fsq_id', $homestayId)->first();
    
    $price = round($homestay->price / $homestay->max_pax,2);

    Payment::create([
        'wlid' => $waitingList->wlid,
        'price' => $price,
        'deadline' => now()->addHours(3)->toTimeString(),
        'paid' => false,
        'user_id' => $userId
    ]);

    $users = User::where('wlid', $waitingList->wlid)->get();
    $ucount = $users->count();

    $data = WaitingList::where('homestay_id', $homestayId)->get();
    $datafull = $data->map(function ($wl) {
                $userCount = \App\Models\User::where('wlid', $wl->wlid)->count();
                return [
                    'wlid' => $wl->wlid,
                    'created' => $wl->created,
                    'done' => $wl->done,
                    'user_count' => $userCount
                ];
            });
    $joinedCount = 5 - $data->count();  


    // 5. Kembalikan data user baru untuk render ke kartu popup
    return response()->json([
        'user' => $user, // atau data user yang ingin ditampilkan
        'cnt'   => $ucount,
        'home' => $homestay,
        'joinedCount' => $joinedCount,
        'waitingList' => $datafull,
        'age' => $age
    ]);
}


}
