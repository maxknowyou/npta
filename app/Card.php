<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $table = 'card';    
    protected $guarded = [];
    public $timestamps = false;  
    
}