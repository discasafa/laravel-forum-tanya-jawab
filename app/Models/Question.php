<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'image_path',
    ];

    // 🔹 Relasi ke User (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 Relasi ke Category (Many to One)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔹 Relasi ke Answer (One to Many)
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
