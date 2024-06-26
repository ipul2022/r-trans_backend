<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function driver(){
        return $this->belongsTo(Driver::class,'driver_id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
