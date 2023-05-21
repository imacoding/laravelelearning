<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Certificate extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $appends = ['certificate_link'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function getCertificateLinkAttribute(){
        if ($this->url != null) {
            return url('storage/certificates/'.$this->url);
        }
        return NULL;
    }
}
