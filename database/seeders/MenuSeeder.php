<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table("menus")->insert([
            [
                "header"            => "MENU",
                "menu_id"           => null, 
                "name"              => "",
                "icon"              => "",
                "link"              => "",
                "order"             => 1,
                "created_at"        => now(),
            ],
            [
                "header"            => null,
                "menu_id"           => null,
                "name"              => "Produtos",
                "icon"              => "fas fa-tag",
                "link"              => "application/products",
                "order"             => 2,
                "created_at"        => now(),
            ],
            [
                "header"            => null,
                "menu_id"           => null,
                "name"              => "Categorias",
                "icon"              => "fas fa-list", 
                "link"              => "application/categories",
                "order"             => 3,
                "created_at"        => now(),
            ],
            [
                "header"            => "CONFIGURAÇÕES DO SISTEMA",
                "menu_id"           => null, 
                "name"              => "",
                "icon"              => "",
                "link"              => "",
                "order"             => 4,
                "created_at"        => now(),
            ],
            [
                "header"            => null,
                "menu_id"           => null, 
                "name"              => "Usuários",
                "icon"              => "fa fa-user",
                "link"              => "application/users",
                "order"             => 5,
                "created_at"        => now(),
            ],
            [
                "header"            => null,
                "menu_id"           => null, 
                "name"              => "Perfil de Usuário",
                "icon"              => "fa fa-users",
                "link"              => "application/profile",
                "order"             => 6,
                "created_at"        => now(),
            ]
            
        ]);

    }

}
