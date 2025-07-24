<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    //
    public function index() {
        $data = Auth::user();
        // dd($data);
        $loadPreference = session('loadPreference', false);
        $loadHistory = session('loadHistory', false);

        return view('profile', compact('data', 'loadPreference', 'loadHistory'));
    }



    public function loadProfileContent()
{
    $data = Auth::user();
    return view('partials.profile_content', compact('data'));
}

    public function update(Request $request, $id){
        // return response()->json($request->all());
        // dd($request->all());
        // dd($id);
        $validate = $request->validate([
            // 'desc' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            'phone_num' => 'required|string',
            'bod' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'occupation' => 'required|in:Student,Worker,Businessman',
        ]);

        

        $user = User::find($id);
        // return response()->json($request->all());

        $user->update($validate);

        return response()->json(['message' => 'User updated successfully']);
    }

}
