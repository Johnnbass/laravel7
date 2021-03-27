<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $request)
    {
        $fornecedores = Fornecedor::where('nome', 'like', '%' . $request->input('nome') . '%')
            ->where('site', 'like', '%' . $request->input('site') . '%')
            ->where('uf', 'like', '%' . $request->input('uf') . '%')
            ->where('email', 'like', '%' . $request->input('email') . '%')
            ->paginate(3);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request)
    {

        $msg = '';

        $rules = [
            'nome' => 'required|min:3|max:40',
            'site' => 'required',
            'uf' => 'required|min:2|max:2',
            'email' => 'email'
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
            'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
            'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
            'email.email' => 'O campo e-mail não foi preenchido corretamente'
        ];

        // inclusão
        if ($request->input('_token') != '' && $request->input('id') == '') {

            $request->validate($rules, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            // redirect

            // dados view
            $msg = 'Cadastro realizado com sucesso';
        }

        // edição
        if ($request->input('_token') != '' && $request->input('id') != '') {

            $request->validate($rules, $feedback);

            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());
            
            if ($update) {
                $msg = 'Atualização realizada com sucesso';
            } else {
                $msg = 'Falha ao realizar a atualização';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);

        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        // Fornecedor::find($id)->forceDelete(); // fornecedor usa softDeletes()

        return redirect()->route('app.fornecedor');
    }
}
