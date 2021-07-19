<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dailyquestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'mcq', 'is_active',
    ];
}