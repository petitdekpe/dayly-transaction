<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
  public function register(RegisterRequest $request){

        try {
            $new_user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            if ($new_user) {
                $message = "Inscription reussie";
                $response = [
                    'user' => $new_user,
                    'message' => $message,
                ];

                return response($response);
            }
        } catch (\Throwable$th) {
            return response($th->getMessage());
        }
  }
}
