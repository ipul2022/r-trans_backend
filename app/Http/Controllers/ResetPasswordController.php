<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function get_password(ResetPasswordRequest $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {
            return response()->json(['message'=>'code is expired'],422);
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update([
            "password" => Hash::make($request->password)
        ]);

        $passwordReset->where('code', $request->code)->delete();
        // $credentials = request(['email', 'password']);
        // if(! $token = auth()->attempt($credentials)){
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }
        return response()->json([
            'status'=>[
                'message'=>'update password berhasil'
            ],
            'data'=>$user
           ],201);
    }

}
