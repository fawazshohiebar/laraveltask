<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userss extends Model
{
    use HasFactory;
    public function certificates()
{
    return $this->belongsToMany(Certificates::class, 'user_certificates');
}

}
