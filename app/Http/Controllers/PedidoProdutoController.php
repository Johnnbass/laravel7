<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use App\Item;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    protected function validateForm($request)
    {
        $rules = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'required' => 'o campo :attribute deve possuir um valor válido'
        ];

        $request->validate($rules, $feedback);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param App\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        // $pedido->produtos; // eager loading
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $this->validateForm($request);
        // $pedidoProduto = new PedidoProduto();
        // $pedidoProduto->pedido_id = $pedido->id;
        // $pedidoProduto->produto_id = $request->get('produto_id');
        // $pedidoProduto->quantidade = $request->get('quantidade');
        // $pedidoProduto->save();

        // $pedido->produtos; // os registros do relacionamento
        // $pedido->produtos()->attach(
        //     $request->get('produto_id'), 
        //     ['quantidade' => $request->get('quantidade')]
        // ); // objeto

        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\PedidoProduto $pedidoProduto
     * @param Integer $pedido
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pedido $pedido, Item $produto)
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // echo '<pre>';
        // print_r($pedido->getAttributes());
        // echo '</pre>';
        // echo '<hr/>';
        // echo '<pre>';
        // print_r($produto->getAttributes());
        // echo '</pre>';

        // Método convencional
        // PedidoProduto::where([
        //     'pedido_id' => $pedido->id,
        //     'produto_id' => $produto->id
        // ])->delete();

        // detach (delete pelo relacionamento)
        // $pedido->produtos()->detach($produto->id);

        // alternativa
        // $produto->pedidos()->detach($pedido->id);

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);
    }
}
