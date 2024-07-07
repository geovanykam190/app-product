<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Profile;
use App\Models\PasswordReset;

use Mail;
use App\Mail\NotifyMail;
use App\Helpers\FunctionHelpers;

class UserController extends Controller
{   

    private $user;
    private $profiles;
    private $passwordReset;

    public function __construct(User $user, PasswordReset $passwordReset, Profile $profiles)
    {
        $this->user         = $user;
        $this->profiles     = $profiles;
        $this->passwordReset= $passwordReset;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->user->with('profile')->where('type', '<>', 1)->get();
        return view("application.user.index", compact("lists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profil = $this->profiles->pluck('name', 'id');
        return view("application.user.create", compact("profil"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $validacao = \Validator::make($request->all(),["password" => "required"],['required' => 'O campo :attribute é obrigatório'],['password' => 'Senha']);

        if($validacao->fails())
            return redirect()->back()->withErrors($validacao)->withInput();
        
        DB::beginTransaction();

        try {

            $data               = $request->all();
            $data['password']   = bcrypt($data['password']);
    
            $new = $this->user->create($data);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao efetuar o cadastro. Tente novamente!'])->withInput();
        }

        return redirect()->route('users.index')->withSuccess('Cadastro criado com Sucesso!');
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
        $profil = $this->profiles->pluck('name', 'id');
        $user   = $this->user->find($id);
        $user->password = "";

        return view("application.user.edit", compact("profil", "user"));
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
       
        $notRemovePerm   = array();
        $data            = $request->all();

        DB::beginTransaction();

        try {

            if(isset($data['password']) && $data['password'] != "")
                $data['password'] = bcrypt($data['password']);
            else
                unset($data['password']);
        
            $this->user->find($id)->update($data);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao atualizar o cadastro. Tente novamente!'])->withInput();
        }

        return redirect()->route('users.index')->withSuccess('Cadastro editado com Sucesso!');
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

            $this->user->find($id)->delete();
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao deletar o cadastro. Tente novamente!']);
        }
      
        return redirect()->route('users.index')->withSuccess('Cadastro deletado com Sucesso!');
    }

    public function resetPass(Request $request)
    {

        /**
         * Verifica se tem o email na base de dados
         */
        $mail    = trim($request->email);
        $hasUser = $this->user->where('email', '=', $mail)->first();

        if (!$hasUser)
        {
            $arr = array('success'=> false, 'message' => 'O email informado não foi encontrado na base de dados, entre em contato com o administrador do sistema!');

            return view("auth.reset", compact("arr"));
        }

        $name = $hasUser->name;
        $hash = \HelpFul::genereteHash($hasUser->id);
        $link = env('APP_URL') . '/new-passwd/' . $hash;

        $this->passwordReset->where('email', '=', $mail)->delete();

        $this->passwordReset->create([
            "email" => $mail,
            "token" => $hash
        ]);

        $arr = array('success' => true, 'message' => 'Email enviado com sucesso, verifique sua caixa de email para redefinir sua senha!');

        try {
        
            Mail::to($mail)->send(new NotifyMail($name, $link, "Solicitação de Redefinição de Senha", "reset"));

            if (Mail::failures()){
                $arr['success'] = false;
                $arr['message'] = "Ocorreu um erro ao enviar o email, tente novamente. Se persistir entre em contato com o administrador do sistema!";
            }

        } catch (\Throwable $th) {

            $arr['success'] = false;
            $arr['message'] = "Ocorreu um erro inesperado ao enviar o email. Se persistir entre em contato com o administrador do sistema!";

        }

        return view("auth.reset", compact("arr"));
    }

    public function newPasswd($token)
    {
        $reset = $this->passwordReset->where('token', '=', $token)->first();

        if (!$reset){
            $arr = array('success'=> false, 'message' => 'Token Inválido!');

            return view("auth.reset", compact("arr"));
        }

        $email = $reset->email;

        return view("auth.new-passwd", compact("email"));
    }

    public function saveNewPasswd(Request $request)
    {

        if ($request->password != $request->input('confirm-password')){

            $email = $request->email;
            $error = array('error' => true, 'message' => 'As senhas não são iguais. Preencha novamente!');

            return view("auth.new-passwd", compact("email", "error"));
        }

        $this->passwordReset->where('email', '=', $request->email)->delete();

        $user = $this->user->where('email', '=', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        $arrReset = array('success' => true, 'message' => 'Senha redefinida com sucesso!');

        return redirect()->route('login', $arrReset);
    }



}
