<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lost extends Model
{
    public $table = 'lostlist';    
    protected $guarded = [];
    public $timestamps = false;  
    
}