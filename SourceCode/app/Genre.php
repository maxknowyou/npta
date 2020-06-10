<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $table = 'genre';    
    protected $guarded = [];
    public $timestamps = false;  
    
}