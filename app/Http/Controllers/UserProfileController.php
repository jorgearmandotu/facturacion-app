<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:profile')->only(['show']);
    }

    public function show(Request $request)
    {
        return view('profile.show', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}
