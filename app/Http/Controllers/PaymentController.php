<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\WaitingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    //
    public function show($payid) {
         $userId = Auth::id();
        $data = Payment::where('payment_id', $payid)
            ->with([
                'waitingList.homestay',
                'user',
            ])
            ->first();

        $html = view('popup.paymentpopup', compact('data'))->render();

        return response($html);
    }

    public function confirm(Request $request)
    {
        $userId = Auth::id();
        $paymentId = $request->payment_id;

        // Validasi input
        if (!$paymentId) {
            return redirect()->back()->withErrors(['error' => 'Payment ID is required']);
        }

        // Simpan data pembayaran ke database
        $data = Payment::find($paymentId)->where('user_id', $userId)->first();
        
        $data->paid = true;
        $data->save();
        // dd($data);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('profile')->with('loadHistory', true);
    }

    public function cancel(Request $request)
    {
        $paymentId = $request->payment_id;
        $payment = Payment::findOrFail($paymentId);

    // Cari user yang punya waiting list ini
    $userID = Auth::id(); // Atau $payment->user kalau ada relasinya
    $user = User::find($userID);

    // Validasi: Pastikan payment ini milik user
    if ($user->wlid != $payment->wlid) {
        return response()->json(['message' => 'Akses ditolak.'], 403);
    }

    // 1. Set user->wlid = null
    $user->wlid = null;
    $user->save();

    // 2. Hapus payment
    $payment->delete();

    return redirect()->route('profile')->with('loadHistory', true);
    
    }
}
