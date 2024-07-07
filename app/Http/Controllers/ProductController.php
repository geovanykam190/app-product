<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;


class ProductController extends Controller
{   

    private $product;
    private $categories;

    public function __construct(Product $product, Category $categories)
    {
        $this->product         = $product;
        $this->categories     = $categories;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = $this->product->with('categories')->get();
        return view("application.product.index", compact("lists"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories->where('status', '=', '1')->pluck('name', 'id');
        return view("application.product.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $data = $request->all();

        DB::beginTransaction();

        try {

            $new = $this->product->create($data);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao efetuar o cadastro. Tente novamente!'])->withInput();
        }

        return redirect()->route('products.index')->withSuccess('Cadastro criado com Sucesso!');
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
        $categories = $this->categories->where('status', '=', '1')->pluck('name', 'id');
        $product   = $this->product->find($id);

        return view("application.product.edit", compact("categories", "product"));
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
        $data            = $request->all();

        DB::beginTransaction();

        try {
            $this->product->find($id)->update($data);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao atualizar o cadastro. Tente novamente!'])->withInput();
        }

        return redirect()->route('products.index')->withSuccess('Cadastro editado com Sucesso!');
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

            $this->product->find($id)->delete();
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors(['Ocorreu um erro ao deletar o cadastro. Tente novamente!']);
        }
      
        return redirect()->route('products.index')->withSuccess('Cadastro deletado com Sucesso!');
    }

}
