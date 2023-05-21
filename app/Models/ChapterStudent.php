<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterStudent extends Model
{
    use HasFactory;
    protected $table = "chapter_students";
    protected $guarded = [];

    public function model()
    {
        return $this->morphTo();
    }
}
