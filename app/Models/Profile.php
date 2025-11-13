<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'age',
        'address',
        'avatar',
    ];

    // 🔹 Relasi ke User (One to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
