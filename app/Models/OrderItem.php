<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = [];

//    public function course(){
//        return $this->belongsTo(Course::class);
//    }
//
//    public function bundle(){
//        return $this->belongsTo(Bundle::class);
//    }
//

    public function course(){
        return $this->hasManyThrough(Course::class,User::class);
    }

    public function item()
    {
        return $this->morphTo();
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
