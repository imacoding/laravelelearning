<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTimeline extends Model
{
    use HasFactory;
     protected $table = "course_timeline";
    protected $guarded = [];

    public function model()
    {
        return $this->morphTo();
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
