<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrushingTeeth extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'note', 'is_morning', 'is_afternoon', 'is_evening', 'user_id'];
}
