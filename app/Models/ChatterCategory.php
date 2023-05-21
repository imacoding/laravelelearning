<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatterCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parent(){

        return ChatterCategory::where('id','=',$this->parent_id)->first();
    }
}
