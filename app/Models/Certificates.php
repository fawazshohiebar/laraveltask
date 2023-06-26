<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(Userss::class, 'user_certificates');
    }
}
