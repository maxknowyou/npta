<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $table = 'users';    
    protected $guarded = [];
    public $timestamps = false;  
    
}