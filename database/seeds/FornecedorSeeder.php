<?php

use Illuminate\Database\Seeder;
use App\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // instanciando o objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 7';
        $fornecedor->site = 'fornecedor7.com.br';
        $fornecedor->uf = 'RS';
        $fornecedor->email = 'contato@fornecedor7.com.br';
        $fornecedor->save();

        // utilizando o método estático create(atenção para o atributo fillable da classe)
        Fornecedor::create([
            'nome' => 'Fornecedor 8',
            'site' => 'fornecedor8.com.br',
            'uf' => 'SC',
            'email' => 'contato@fornecedor8.com.br',
        ]);

        // insert (método padrão de insert via db, não popula dados created_at e updated_at)
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 9',
            'site' => 'fornecedor9.com.br',
            'uf' => 'PR',
            'email' => 'contato@fornecedor9.com.br',
        ]);
    }
}
