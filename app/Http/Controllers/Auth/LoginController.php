<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {



        try {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response(['errors_message' => 'Veillez entrer des informations corrects.']);
            }
            $token = $user->createToken('access_token')->plainTextToken;
            $message = "Connexion reussie";

            $response = [
                'user' => $user,
                'token' => $token,
                'message'=> $message
            ];
            return response($response);
        } catch (\Throwable $th) {
            return response(['errors_message' =>$th->getMessage()]);
        }

    }
}
