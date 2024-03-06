<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\SendMailreset;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{


    public function get_code(ForgotPasswordRequest $request)
    {
       ResetCodePassword::where('email', $request->email)->delete();

        $codeData =ResetCodePassword::create($request->data());

       Mail::to($request->email)->send(new SendMailreset($codeData->code));
        return response()->json([
            'status'=>[
                'message'=>'code berhasil di kirim'
            ],
            'data'=>$codeData
        ],201);
    }

    public function generate(Request $request){
// $request-> validate([
//     'phone'=> 'required|exists:users,phone'
// ]);
$userOtp = $this->generateOtp($request->phone);
$userOtp->sendSMS($request->phone);
return response()->json(['message'=> 'code berhasil di kirim',
'data'=>$userOtp]);
    }

    public function generateOtp($phone){
$user = User::where('phone',$phone)->first();
$userOtp = ResetCodePassword::where('user_id',$user->id)->latest()->first();
$now = now();
if($userOtp && $now->isBefore($userOtp->isExpire())){
return $userOtp;
}
return ResetCodePassword::create([
    'user_id'=>$user->id,
    'otp'=>rand(123456,999999),
]);

    }
}
