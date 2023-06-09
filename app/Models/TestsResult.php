<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestsResult extends Model
{
    use HasFactory;
    protected $fillable = ['test_id', 'user_id', 'test_result'];

    public function answers()
    {
        return $this->hasMany('App\Models\TestsResultsAnswer');
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }
}
