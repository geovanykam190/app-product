<?php 

namespace App\Helpers;

use App\Models\PermissionProfile;
// use App\Helpers\FunctionHelpers;

class HelpFul 
{

    public static function hasPermission($id, $idMenu)
    {
        
        $allow = PermissionProfile::where('profile_id', '=', $id)->where('menu_id', '=', $idMenu)->first();

        if ($allow)
            return true;

        return false;
    }

    public static function genereteHash($id)
    {
        $hash = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
        $hash = $hash . '-dp' . $id . '-hp' . date("YmdHis");
        return $hash;
    }

}

?>
