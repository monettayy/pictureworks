<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::find($id);

        if(!$user)
            return response()->json('User not found', 404);

        return view('user', compact('user'));
    }
}
