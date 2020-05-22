<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $table = 'user';    
    protected $guarded = [];
    public $timestamps = false;  
    
}