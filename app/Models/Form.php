<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id',
        'name',
        'slug',
        'description', 
        'allowed_domains',
        'limit_one_response',
    ];


    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }

}


