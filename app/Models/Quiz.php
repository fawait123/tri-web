<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizes';

    protected $fillable = [
        'user_id',
        'score',
        'grade',
        'answer',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
