<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
    ];

    public function topics(){
    	return $this->hasMany(Topic::class);
    }
    
    public function questions(){
    	return $this->hasMany(Question::class);
    }
}