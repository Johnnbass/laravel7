<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PrincipalController@principal')->name('site.index')->middleware('log.acesso');

Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');

Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function () {
    Route::get('/home', 'HomeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');

    // fornecedores
    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');

    // produtos
    Route::resource('produto', 'ProdutoController');

    // produtos detalhes
    Route::resource('produto-detalhe', 'ProdutoDetalheController');

    // clientes
    Route::resource('cliente', 'ClienteController');

    // pedidos
    Route::resource('pedido', 'PedidoController');

    // pedidos-produtos
    Route::resource('pedido-produto', 'PedidoProdutoController');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('site.index') . '">Clique aqui</a> para ir para a página inicial.';
});



// Route::get('/rota1', function () {
//     echo "Rota 1";
// })->name('site.rota1');

// Redirect
// Route::redirect('/rota2', '/rota1');

// Redirect pelo callback da rota
// Route::get('/rota2', function () {
//     return redirect()->route('site.rota1');
// })->name('site.rota2');

// Exemplo parâmetros opcionais
// Route::get(
//     '/contato/{nome?}/{categ?}/{assunto?}/{msg?}',
//     function (
//         string $nome = 'Desconhecido', 
//         string $categ = 'Informação', 
//         string $assunto = 'Contato', 
//         string $msg = 'Mensagem não informada'
//     ) {
//         echo "Estamos aqui: {$nome} - {$categ} - {$assunto} - {$msg}";
//     }
// );

// Exemplo parâmetros com expressões regulares
// Route::get(
//     '/contato/{nome}/{categoria_id}',
//     function (
//         string $nome = 'Desconhecido',
//         int $categoria_id = 1 // 1 - Informação
//     ) {
//         echo "Estamos aqui: {$nome} - {$categoria_id}";
//     }
// )->where('nome', '[A-Za-z]')->where('categoria_id', '[0-9]+');
