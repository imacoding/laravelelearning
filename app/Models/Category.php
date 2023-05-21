<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use SoftDeletes, HasFactory;

    protected $guarded = [];

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function bundles(){
        return $this->hasMany(Bundle::class);
    }

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

    public function faqs(){
        return $this->hasMany(Faq::class);
    }


}
