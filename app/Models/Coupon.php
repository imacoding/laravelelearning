<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function useByUser()
    {
        $count = Order::where('coupon_id', '=', $this->id)->where('user_id', '=', auth()->user()->id)->get()->count();
        return $count;
    }
}
