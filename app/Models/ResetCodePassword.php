<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Twilio\Rest\Client;
class ResetCodePassword extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'created_at',
    ];
// protected $guard=[];
    /**
     * check if the code is expire then delete
     *
     * @return void
     */
    // public function reset(){
    //     return $this->belongsTo(User::class);
    // }
    public function isExpire()
    {
        if ($this->created_at > now()->addHour()) {
            $this->delete();
        }
    }
//     public function sendSMS($receiverNumber){
//         $message="This is otp forget password".$this->otp;
//         try{
//             $account_id=getenv("TWILIO_SID");
//             $token =getenv("TWILIO_TOKEN");
//             $number=getenv("TWILIO_FROM");
//             $client = new Client($account_id,$token);
//             $client->messages->create($receiverNumber,[
//                 'from'=>$number,
//                 'body'=>$message
//             ]);
//             info('sms berhasil di kirim');

//         }catch(\Exception $e){
// info('Error: '.$e->getMessage());
//         }
//     }
}
