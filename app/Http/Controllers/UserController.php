<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ImageStoreRequest;
use App\Http\Resources\UserResource;
use App\Models\Image;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Mail\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Nette\Schema\Helpers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuthUserTrait;
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
        return auth()->shouldUse('api');
    }
    public function register(Request $request) {

        $validator = Validator::make(request()->all(),[
            'name'=>'required',
            'phone'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'roles'=>'user',
            'image'     => 'required|image|mimes:png,jpg,jpeg'
        ]);

if($validator -> fails()){
    return response()->json($validator->messages(),401);
}
if ($request->has("image")) {
    $image_path = public_path("storage/images/" . $request->image);
    $file = $request->image;
    if (File::exists($image_path)) {
    }
    $imageName = url("storage/images/" . time() . "_" . $file->getClientOriginalName());
    $file->move(public_path("storage/images/"), $imageName);
}
        $user = User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'password'=>Hash::make(request('password')),
            'roles'=>'user',
            'image' => $imageName
        ]);
    //    $token = auth::user();
      //    $token = Str::random(60);
      $credentials = request(['email', 'password']);
      if(! $token = auth()->attempt($credentials)){
          return response()->json(['error' => 'Unauthorized'], 401);
      }
        return response()->json([
        //    'status'=>[
        //         'message'=>'Register Akun Berhasil'
        //     ],
            'token'=>$token,
            ]);
    }

    // login
    public function login(){
        $credentials = request(['email', 'password']);
        if(! $token = auth()->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }



    // get profile
    public function get_profile(){
        $loggeduser = auth()->user();
if(auth()->user()== true){
    return $loggeduser;
    // return response([
    //     $loggeduser

    // ], 200);
}else{
    return response([
        'message' => 'User Unauthorized',
    ], 401);
}

    }

    // logout
    public function logout(){
        return response()->json(['message'=>'logout berhasil'],201);
    }

    //refresh token
    public function refresh(){
        return $this->respondWithToken(auth()->refresh(true, true));
    }


//change password
    public function change_password(Request $request){
        try{
               $request->validate([
                    'password'         =>'required|min:6|max:30',
        'confirm_password' =>'required|same:password'
               ]);
               $user = auth()->user();
               if($user->password=Hash::make($request->password)){
               $user->save();
           return response()->json([
                'message'=>'update password berhasil'
       ], 200);
               }
           }catch(Exception $e){
               return response()->json(["status"=>$e->getMessage()
               ],400);
       }
    // $validator=Validator::make($request->all(),[
    //     'old_password'        =>'required',
    //     'new_password'         =>'required|min:8|max:30',
    //     'confirm_password' =>'required|same:new_password'
    //  ]);
    //  if ($validator->fails()) {
    //     return response()->json([
    //        'message'=>'validations fails',
    //        'errors' =>$validator->errors()
    //     ],422);
    //  }
    //  $user=$request->user();

    //  if (Hash::check($request->old_password,$user->password)) {
    //     $user->update([
    //        'password'=>Hash::make($request->new_password)
    //     ]);

    //     // $credentials = request(['email', 'password']);
    //     // if(! $token = auth()->attempt($credentials)){
    //     //     return response()->json(['error' => 'Unauthorized'], 401);
    //     // }
    //     return response()->json([
    //        'message'=>'update password berhasil'
    //     //    'errors' =>$validator->errors()
    //     ],200);
    //  }
    //  else
    //  {
    //     return response()->json([
    //        'message'=>'old password does not match',
    //     //    'errors' =>$validator->errors()
    //     ],422);
    //  }
    }



     // upload image
     public function upload_image(Request $request)
     {
        // $validator = Validator::make($request->all(), [
        //     'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        //  ]);
        //  if ($validator->fails()) {
        //     return response()->json(['error'],422);
        //  }
        //  $uploadFolder = 'use';
        //  $image = $request->file('image');
        //  $image_uploaded_path = $image->store($uploadFolder, 'public');
        //  $uploadedImageResponse = array(
        //     "image_name" => basename($image_uploaded_path),
        //     "image_url" => Storage::disk('public')->url($image_uploaded_path),
        //     "mime" => $image->getClientMimeType()
        //  );
        //  return response()->json(['succes'=>$uploadedImageResponse],201);
        // try {
        //     $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
        //     Image::create([
        //         'image' => $imageName,
        //     ]);
        //     Storage::disk('public')->put($imageName, file_get_contents($request->image));
        //     return response()->json([
        //         'message' => "upload image succes",
        //     ],200);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => "unauthorized"
        //     ],500);
        // }
     }

    //  public function getImage($path)
    //  {
    //      $image = Storage::get($path);
    //      return response($image, 200)->header('Content-Type', Storage::getMimeType($path));
    //  }


     private function getValidationAttribute(){
        return [
                       'image' => 'required|image|mimes:jpg,png,jpeg',
                'name'=>'required',
                'phone'=>'required',
                'email'=>'required',
                'password'=>'required',
        ];
    }
//update profile

     public function update(Request $request,User $user) {
 $user = Auth::user();
$request->validate([
    'name' => 'required|max:255|string',
    'email' =>'required|string|email|max:255|unique:users,email,' . $user->id,
    'image' => 'nullable|mimes:png,jpg,jpeg,webp',
    'phone' => 'required',
    // 'password' => 'required'
]);
// if ($request->hasFile('images')) {
//     $uploadedFile = $request->file('images');
//     $filename = time() . '_' . $uploadedFile->getClientOriginalName();
//     Storage::putFileAs('public/images', $uploadedFile, $filename);
//     if ($user->images) {
//         Storage::delete('public/images/' . basename($user->images));
//     }
//     $user->images = 'storage/images/' . $filename;
// }
// $user->name = $request->name;
// $user->email = $request->email;
// $user->phone = $request->phone;
// if($request->has('image')){
//     $file = $request->file('image');
//     $extension = $file->getClientOriginalExtension();
//     $filename = url(time().'.'.$extension);
//     $path = 'public/storage/images/';
//     // $url = Storage::url($path);
//     $file->move($path, $filename);
//     if(File::exists($user->image)){
//         File::delete($user->image);
//     }
// }
// if ($request->hasFile('image')) {
//     $image = $request->file('image')->store('public');
// }
 // menyimpan data file yang diupload ke variabel $file

//  if ($request->hasFile('image')) {
//     $user->image = url(''.$user->image);
//     // $images = $request->file('image')->store('/images');
//     // $user->image = $user;
//    }
// if($request->hasFile('image'))
// {
//     $fileNameExt = $request->file('image')->getClientOriginalName();
//     $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
//     $fileExt = $request->file('image')->getClientOriginalExtension();
//     $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
//     $pathToStore = url($request->file('image')->storeAs('storage/images',$fileNameToStore));
// }

// if($request->hasFile('image')){
// //             $user->image = $fileNameToStore;
// $images = $request->image;
// foreach ($images as $key => $image) {
//     $nameFile = time() . $key . '.' . $image->getClientOriginalExtension();
//     $path = public_path('upload/images');
//     $image->move($path, $nameFile);
// }
//       }

//  $file = $request->file('image');
//  $nama_file = $file->getClientOriginalName();
//  $filename = time().'.'.$nama_file;
//  $tujuan_upload = 'data_file';
//  $file->move($tujuan_upload,$filename);
// $fileName = time() . '.' . $request->image->extension();
// $request->image->storeAs('storage/', $fileName);
// $user->image = $filename;
// $user->save();
if ($request->has("image")) {
    $image_path = public_path("storage/images/" . $user->image);
    if (File::exists($image_path)) {
        unlink($image_path);
    }
    $file = $request->image;
    $imageName = url("storage/images/" . time() . "_" . $file->getClientOriginalName());
    $file->move(public_path("storage/images/"), $imageName);
    $user->image = $imageName;
}

$user->update([
    'image'   => $user->image,
    'name'              => $request->name,
    'phone'              => $request->phone,
    'email'             => $request->email,
    // 'password'             => $request->password,
]);
// $credentials = request(['email', 'password']);
//       if(! $token = auth()->attempt($credentials)){
//           return response()->json(['error' => 'Unauthorized'], 401);
//       }
//         return response()->json([
//         //    'status'=>[
//         //         'message'=>'Register Akun Berhasil'
//         //     ],
//             'token'=>$token,
//             ]);
        return response()->json([
            'message' => "upload profile succes",
            'data'=>$user
        ],200);
    }



//

  public function forgot_password(Request $request){

    $request->validate([
        'email' => 'required|email',
    ]);
    $email = $request->email;
    $user = User::where('email', $email)->first();
    // if(!$user){
    //     return response([
    //         'message'=>'Email doesnt exists',
    //         'status'=>'failed'
    //     ], 404);
    // }

    $token = Str::random(60);
    PasswordReset::create([
        'email'=>$email,
        'token'=>$token,
        'created_at'=>Carbon::now()
    ]);

    Mail::send('reset', ['token'=>$token], function(Message $message)use($email){
        $message->subject('Reset Your Password');
        $message->to($email);
    });
    return response([
        'message'=>'Password Reset Email Sent... Check Your Email',
        'status'=>'success'
    ], 200);
    }

//









    //respon token
     public function respondWithToken($token){
        return response()->json([
                  'token' => $token,
            // 'status'=>'login berhasil',
            // 'data'=>[
            //     'token' => $token,
            //     'token_type'=>'bearer',
            //     'expires_in'=>auth()->factory()->getTTL() * 60
            // ]

        ]);
    }


    //

    public function place_api_autocomplete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_text' => 'required',
        ]);

        if ($validator->errors()->count()>0) {
            return response()->json(['errors' => 'data tidak ada'], 403);
        }
        $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json?input='.$request['search_text'].'&key='.'AIzaSyDVcR2dzl7R5I7IK0-w_FR_O6SY8XlIFXo');
        return $response->json();
    }
}
