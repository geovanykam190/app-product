<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{   
    private $category;

    public function __construct(Category $category)
    {
        $this->category              = $category;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->category->all();
        return view("application.category.index", compact("lists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("application.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $new = $this->category->create($request->all());

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao efetuar o cadastro. Tente novamente!'])->withInput();
        }
     
        return redirect()->route('categories.index')->withSuccess('Cadastro criado com Sucesso!');
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
        $category      = $this->category->find($id);
        return view("application.category.edit", compact("category"));
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
        $data = $request->all();

        DB::beginTransaction();

        try {
            $this->category->find($id)->update($data);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao editar o cadastro. Tente novamente!'])->withInput();

        }
     
        return redirect()->route('categories.index')->withSuccess('Cadastro editado com Sucesso!');
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

            $this->category->find($id)->delete();
            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao deletar o cadastro. Tente novamente!']);
        }

        return redirect()->route('categories.index')->withSuccess('Cadastro deletado com Sucesso!');
    }

}
