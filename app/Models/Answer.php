<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'user_id',
        'body',
    ];

    // 🔹 Relasi ke Question (Many to One)
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // 🔹 Relasi ke User (Many to One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
