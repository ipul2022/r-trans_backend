<?php

namespace App\Models;

use App\Http\Enum\ServiceTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'service_type' => ServiceTypeEnum::class,
    ];


    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    // public function accepts(){
    //     return $this->hasMany(User::class);
    // }
    public function receipts(){
        return $this->hasMany(Receipt::class);
    }
}
