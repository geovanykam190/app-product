<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionProfile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'profile_id',
        'menu_id'
    ];

    public function menus(){
        return $this->hasOne("App\Models\Menu", 'id');
    }

}
