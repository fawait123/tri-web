<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observable extends Model
{
    use HasFactory;

    protected $fillable = [
        's',
        'ss',
        'ts',
        'sts',
        'type',
        'user_id',
        'answer',
        'number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
