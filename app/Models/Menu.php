<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'header',
        'menu_id', 
        'name', 
        'icon', 
        'link', 
        'order'
    ];

}
