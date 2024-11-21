<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    // Definisikan relasi dengan model User

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
