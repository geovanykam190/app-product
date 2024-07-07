<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Profile;
use App\Models\PermissionProfile;

class ProfileController extends Controller
{   

    private $menu;
    private $profile;
    private $permissionProfile;

    public function __construct(Menu $menu, Profile $profile, PermissionProfile $permissionProfile)
    {
        $this->menu                 = $menu;
        $this->profile              = $profile;
        $this->permissionProfile    = $permissionProfile;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->profile->all();
        return view("application.profile.index", compact("lists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = $this->getMenus();
        return view("application.profile.create", compact("menus"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
    
        $permissions = $request->input('permissions');
        $request->request->remove('permissions');
        
        DB::beginTransaction();

        try {

            $new = $this->profile->create($request->all());

            if ($new)
            {
                foreach($permissions AS $perm)
                {
                    $this->permissionProfile->create([
                        'profile_id'    => $new->id,
                        'menu_id'       => $perm
                    ]);
                }
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao efetuar o cadastro. Tente novamente!'])->withInput();
        }
     
        return redirect()->route('profile.index')->withSuccess('Cadastro criado com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $menus       = $this->getMenus();
        $profil      = $this->profile->find($id);
        $permissions = $this->permissionProfile->where('profile_id', '=', $id)->get();

        return view("application.profile.edit", compact("menus", "profil", "permissions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $notRemovePerm  = array();
        $permissions    = $request->input('permissions');
        
        DB::beginTransaction();

        try {

            $this->profile->find($id)->update($request->all());
        
            foreach($permissions AS $perm)
            {
                $has = $this->permissionProfile->where('profile_id', '=', $id)->where('menu_id', '=', $perm)->first();
    
                if (!$has)
                {
                    $permNew = $this->permissionProfile->create([
                        'profile_id'    => $id,
                        'menu_id'       => $perm
                    ]);
    
                    $notRemovePerm[] = $permNew->id;
                } else {
                    $notRemovePerm[] = $has->id;
                }
               
            }

            /**
             * Remove as permissões não inclusas, caso tenham no banco
             */
            $this->permissionProfile->where('profile_id', '=', $id)->whereNotIn('id', $notRemovePerm)->delete();

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao editar o cadastro. Tente novamente!'])->withInput();

        }
     
        return redirect()->route('profile.index')->withSuccess('Cadastro editado com Sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $this->permissionProfile->where('profile_id', '=', $id)->delete();
            $this->profile->find($id)->delete();
            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao deletar o cadastro. Tente novamente!']);
        }

        return redirect()->route('profile.index')->withSuccess('Cadastro deletado com Sucesso!');
    }

    private function getMenus()
    {
        $allMenus = $this->menu->whereNull('menu_id')->orderBy('order')->get();

        foreach($allMenus AS $k => $father) 
        {
            $allMenus[$k]['submenu'] = $this->menu->where('menu_id', $father->id)->orderBy('order')->get();
        }

        return $allMenus;
    }

}
