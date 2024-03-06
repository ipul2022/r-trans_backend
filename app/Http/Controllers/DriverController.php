<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverCodeRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\DriverResource;
use App\Mail\SendMailreset;
use App\Models\Receipt;
use App\Models\ResetCodePassword;
use Illuminate\Auth\AuthenticationException;
use App\Models\Driver;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;



class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthUserTrait;
     //
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = Driver::where('email', $request->email)->first();
try{
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['email incorrect']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['password incorrect']
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(
            [
                'token' => $token,

            ]
        );}catch (Exception $e){
            return response()->json(
                [
                    'messages' => 'email or password tidak sesuai',

                ],401
            );
        }

    }


   //



   //
    public function get_profile(){
        try{
            if ($user = auth()->user()) {
                return response()->json([
                    'data'=>$user
                ],201);
            }
        }catch (Exception){
            return response()->json(
                [
                    'messages' => 'user or email tidak valid',
                ],401
            );
        }


    }
    //


    //
    public function register(Request $request) {

        $validator = Validator::make(request()->all(),[
            'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'roles' => 'string',
        'jenis_kendaraan' => 'required',
        'nomor_kendaraan' => 'required',
        'phone' => 'string',
        'gender' => 'string',
        ]);

if($validator -> fails()){
    return response()->json($validator->messages(),401);
}
        $user = Driver::create([
                'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'jenis_kendaraan' => $request->jenis_kendaraan,
        'nomor_kendaraan' => $request->nomor_kendaraan,
        'roles' => $request->roles,
        'gender' => $request->gender,
        'phone' => $request->phone,
        ]);
        return response()->json([
       //     'status'=>[
                'message'=>'Register Akun Berhasil'
            // ],
            // 'data'=>$user
            ]);
    }


    // get detail driver
    public function get_order()
    {

    $user     = Auth::user();
    $receipt  = Receipt::where('driver_id',$user->id)
    ->where('status','Active')
    ->where('service','R-Ride')
    ->with('driver:id,name,phone,jenis_kendaraan,nomor_kendaraan',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,jadwal_pengantaran','order.user:id,name,phone')
    ->get();
    return response()->json(['data' => $receipt],201);

    }
    public function get_order_pickup()
    {

    $user     = Auth::user();
    $receipt  = Receipt::where('driver_id',$user->id)
    ->where('status','Active')
    ->where('service','R-Pickup')
    ->with('driver:id,name,phone,jenis_kendaraan,nomor_kendaraan',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,dana_talangan,jenis_barang,berat_barang','order.user:id,name,phone')
    ->get();
    return response()->json(['data' => $receipt],201);

    }
    public function get_order_shop()
    {

    $user     = Auth::user();
    $receipt  = Receipt::where('driver_id',$user->id)
    ->where('status','Active')
    ->where('service','R-Shop')
    ->with('driver:id,name,phone,jenis_kendaraan,nomor_kendaraan',
    'order:id,user_id,alamat_penjemputan,alamat_tujuan,dana_talangan,jenis_barang,jumlah_barang','order.user:id,name,phone')
    ->get();
    return response()->json(['data' => $receipt],201);

    }

// ganti password

public function update_password(Request $request){
    try{
           $request->validate([
            'password' => 'required|confirmed'
           ]);
           $user = auth()->user();
           if($user->password=Hash::make($request->password)){
           $user->save();
       return response([
       'message' => 'Update Password Berhasil',
    //    'status'=>'success',
   ], 200);
           }else{
               throw new Exception("Failed");
           }
       }catch(Exception $e){
           return response(["status"=>$e->getMessage()
           ],400);
   }}


//


// get list on order selesai

public function get_List_pickup()
{

$user     = Auth::user();
$receipt  = Receipt::where('driver_id',$user->id)
->where('status','Done')
->where('service','R-Pickup')
->select('id','jarak','tarif','status','driver_id','user_id','order_id','service','created_at')
->with('driver:id,name',
'order:id,user_id,alamat_penjemputan,alamat_tujuan,dana_talangan,jenis_barang,berat_barang','user:id,name')
->get();

return response()->json([
'status'=>[
    'message'=>'get data berhasil'
],
    'data'=>$receipt],201);
}


public function get_List_ride()
{

$user     = Auth::user();
$receipt  = Receipt::where('driver_id',$user->id)
->where('status','Done')
->where('service','R-Ride')
->select('id','jarak','tarif','status','driver_id','user_id','order_id','service','created_at')
->with('driver:id,name',
'order:id,user_id,alamat_penjemputan,alamat_tujuan,jadwal_pengantaran','user:id,name')
->get();

return response()->json([
'status'=>[
    'message'=>'get data berhasil'
],
    'data'=>$receipt],201);
}

public function get_List_shop()
{

$user     = Auth::user();
$receipt  = Receipt::where('driver_id',$user->id)
->where('status','Done')
->where('service','R-Shop')
->select('id','jarak','tarif','status','driver_id','user_id','order_id','service','created_at')
->with('driver:id,name',
'order:id,user_id,alamat_penjemputan,alamat_tujuan,dana_talangan,jenis_barang,jumlah_barang','user:id,name')
->get();

// $success['status']  =   "success";
// $success['data']    =   $receipt;


return response()->json([
'status'=>[
    'message'=>'get data berhasil'
],
    'data'=>$receipt],201);
}
//




// update profile
public function update(Request $request) {
    $user = Auth::user();
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'image' => 'nullable|image|mimes:jpg,png,jpeg'
    ]);
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->has("image")) {
        $image_path = public_path("storage/images/" . $user->image);
        if (File::exists($image_path)) {
            unlink($image_path);
        }
        // else{
        //           unlink($image_path);
        // }
        $file = $request->image;
        $imageName = url("storage/images/" . time() . "_" . $file->getClientOriginalName());
        $file->move(public_path("storage/images/"), $imageName);
        $user->image = $imageName;
    }

    $user->save();

    return response()->json([
        'message' => "upload profile succes",
        'data'=>$user
    ],200);

}




// get code reset password


public function get_code(DriverCodeRequest $request)
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


public function get_password(ResetPasswordRequest $request)
{
    $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

    if ($passwordReset->isExpire()) {
        return response()->json(['message'=>'code is expired'],422);
    }

    $user = Driver::firstWhere('email', $passwordReset->email);

    $user->update([
        "password" => Hash::make($request->password)
    ]);

    $passwordReset->where('code', $request->code)->delete();

    return response()->json([
        'status'=>[
            'message'=>'update password berhasil'
        ],
        'data'=>$user
       ],201);
}
//

//


public function update_status(Request $request)
{
    $validator =Validator::make($request->all(),[
        'status'=>'Done',
    ]);
// if($validator -> fails()){
// return response()->json($validator->messages());
// }
$user     = Auth::user();
$receipts  = Receipt::where('driver_id',$user->id);
$receipts->update([
    'status'=>'Done'
]);
$user = Driver::find($user->id);
        $user->status = 'off';
        $user->update();
return response()->json(['message'=>'orderan selesai']);
}
//
}
