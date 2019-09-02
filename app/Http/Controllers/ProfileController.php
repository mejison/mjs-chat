<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(Request $reqeust)
    {
        return response()->json([
            'data' => auth()->user()
        ]);
    }

    public function updatePhoto(Request $reqeust) {
        $photo = $reqeust->file('photo')->store('public/attached');
        $user = auth()->user();
        $user->photo = $photo;
        $user->save();

        return response()->json([
            'data' => [
                'url' => $user->photo,
            ],
            'status' => 'success',
            'message' => 'Successfuly update profile photo.'
        ]);
    }
}
