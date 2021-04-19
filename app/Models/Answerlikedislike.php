<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answerlikedislike extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'answer_id',
        'upordown',
    ];
}