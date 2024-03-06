<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of AuthUserTrait
 */
trait AuthUserTrait {
    /**
     * Summary of getAuthUser
     * @return Illuminate\Contracts\Auth\Authenticatable|mixed
     */
    private function getAuthUser(){
    try{
        return auth()->userOrFail();
    } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
        response()->json(['message'=>'not authentication'],403)->send();
    exit;
    }
}
private function checkOwnership($owner){
    $user = $this->getAuthUser();
    if($user->id != $owner){
        response()->json(['message'=>'not authorized'],401)->send();
        exit;
    }
}


}
