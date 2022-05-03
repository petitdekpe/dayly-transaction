<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        try {
            $user = User::find(auth()->user()->id);
            $user->tokens()->delete();
            return response([
                'message' => 'logout',
            ]);

        } catch (\Throwable$th) {
            return response($th->getMessage());
        }

    }
}
