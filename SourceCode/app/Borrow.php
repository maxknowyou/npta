<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    public $table = 'borrowlist';    
    protected $guarded = [];
    public $timestamps = false;  
    
}