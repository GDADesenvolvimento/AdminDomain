<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use GdaDesenv\AdminClient\Entities\Client;
use GdaDesenv\AdminDomain\Entities\Domain;

class DomainTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_domain()
    {
        $client = Client::create([
            'nome' => 'Cliente Teste',
            'cnpj' => '99.999.999/9999-99',
            'cpf' => '999.999.999-99',
            'email_contato' => 'teste@teste.com.br',
            'email_cobranca' => 'teste@teste.com.br',
            'telefone_contato' => '(99)9999-99',
            'telefone_cobranca' => '(99)9999-99',
            'endereco' => 'Rua Teste PHPUnit',
            'numero' => '999',
            'complemento' => 'casa teste',
            'bairro' => 'bairro teste',
            'municipio' => 'municipio teste',
            'uf' => 'TE'
        ]);

        Domain::create([
            'client_id' => $client->id,
            'nome' => 'teste com br',
            'dominio' => 'teste.com.br',
            'data_registro' => '1970-01-01',
            'data_vencimento' => '1970-01-01',
            'orgao_registro' => 'registro.br',
            'valor' => '40',
            'status' => 'publish',
            'descricao' => 'description teste',
            'publicado' => 1
        ]);

        $this->seeInDatabase('domains',['dominio' => 'teste.com.br']);
    }

    public function test_creating_domain_using_form_with_errors()
    {
        \App\Entities\User::create([
            'name' => 'Admin Test',
            'login' => 'admin_test',
            'email' => 'admintest@admintest.com',
            'password' => bcrypt(12345678)
        ]);

        $this->visit('/')
            ->see('Efetuar Login')
            ->type('admin_test','login')
            ->type('12345678','password')
            ->press('Efetuar Login')
            ->dontSee('Login ou Password incorreto');

        $this->visit('/domain/form')
            ->select("", 'client_id')
            ->type('','dominio')
            ->type('','data_registro')
            ->type('','data_vencimento')
            ->type('','orgao_registro')
            ->type('','valor')
            ->type('','status')
            ->press('Salvar Alterações')
            ->see('O campo dominio é obrigatório.')
            ->see('O campo data registro é obrigatório.')
            ->see('O campo data vencimento é obrigatório.')
            ->see('O campo orgao registro é obrigatório.')
            ->see('O campo valor é obrigatório.')
            ->see('O campo status é obrigatório.');
    }

    public function test_creating_domain_using_form()
    {
        \App\Entities\User::create([
            'name' => 'Admin Test',
            'login' => 'admin_test',
            'email' => 'admintest@admintest.com',
            'password' => bcrypt(12345678)
        ]);

        $this->visit('/')
            ->see('Efetuar Login')
            ->type('admin_test','login')
            ->type('12345678','password')
            ->press('Efetuar Login')
            ->dontSee('Login ou Password incorreto');

        $client = Client::create([
            'nome' => 'Cliente Teste',
            'cnpj' => '99.999.999/9999-99',
            'cpf' => '999.999.999-99',
            'email_contato' => 'teste@teste.com.br',
            'email_cobranca' => 'teste@teste.com.br',
            'telefone_contato' => '(99)9999-99',
            'telefone_cobranca' => '(99)9999-99',
            'endereco' => 'Rua Teste PHPUnit',
            'numero' => '999',
            'complemento' => 'casa teste',
            'bairro' => 'bairro teste',
            'municipio' => 'municipio teste',
            'uf' => 'TE'
        ]);

        $this->visit('/domain/form')
            ->select($client->id, 'client_id')
            ->type('teste.com.br','dominio')
            ->type('01/01/1970','data_registro')
            ->type('01/01/1970','data_vencimento')
            ->type('registro.br','orgao_registro')
            ->type(40,'valor')
            ->type('publish','status')
            ->press('Salvar Alterações');

        $this->seeInDatabase('domains',['dominio' => 'teste.com.br']);
    }

    public function test_updating_domain_using_form()
    {
        \App\Entities\User::create([
            'name' => 'Admin Test',
            'login' => 'admin_test',
            'email' => 'admintest@admintest.com',
            'password' => bcrypt(12345678)
        ]);

        $this->visit('/')
            ->see('Efetuar Login')
            ->type('admin_test','login')
            ->type('12345678','password')
            ->press('Efetuar Login')
            ->dontSee('Login ou Password incorreto');

        $client = Client::create([
            'nome' => 'Cliente Teste',
            'cnpj' => '99.999.999/9999-99',
            'cpf' => '999.999.999-99',
            'email_contato' => 'teste@teste.com.br',
            'email_cobranca' => 'teste@teste.com.br',
            'telefone_contato' => '(99)9999-99',
            'telefone_cobranca' => '(99)9999-99',
            'endereco' => 'Rua Teste PHPUnit',
            'numero' => '999',
            'complemento' => 'casa teste',
            'bairro' => 'bairro teste',
            'municipio' => 'municipio teste',
            'uf' => 'TE'
        ]);

        $domain = Domain::create([
            'client_id' => $client->id,
            'nome' => 'teste com br',
            'dominio' => 'teste.com.br',
            'data_registro' => '1970-01-01',
            'data_vencimento' => '1970-01-01',
            'orgao_registro' => 'registro.br',
            'valor' => '40',
            'status' => 'publish',
            'descricao' => 'description teste',
            'publicado' => 1
        ]);

        $this->visit('/domain/edit/'.$domain->id)
            ->select("", 'client_id')
            ->type('','dominio')
            ->type('','data_registro')
            ->type('','data_vencimento')
            ->type('','orgao_registro')
            ->type('','valor')
            ->type('','status')
            ->press('Salvar Alterações')
            ->see('O campo dominio é obrigatório.')
            ->see('O campo data registro é obrigatório.')
            ->see('O campo data vencimento é obrigatório.')
            ->see('O campo orgao registro é obrigatório.')
            ->see('O campo valor é obrigatório.')
            ->see('O campo status é obrigatório.');

        $this->visit('/domain/edit/'.$domain->id)
            ->select($client->id, 'client_id')
            ->type('teste2.com.br','dominio')
            ->type('01/01/1970','data_registro')
            ->type('01/01/1970','data_vencimento')
            ->type('registro.br','orgao_registro')
            ->type(40,'valor')
            ->type('publish','status')
            ->press('Salvar Alterações');

        $this->seeInDatabase('domains',['dominio' => 'teste2.com.br']);
    }

    public function test_deleting_client_using_form()
    {
        \App\Entities\User::create([
            'name' => 'Admin Test',
            'login' => 'admin_test',
            'email' => 'admintest@admintest.com',
            'password' => bcrypt(12345678)
        ]);

        $this->visit('/')
            ->see('Efetuar Login')
            ->type('admin_test','login')
            ->type('12345678','password')
            ->press('Efetuar Login')
            ->dontSee('Login ou Password incorreto');

        $client = Client::create([
            'nome' => 'Cliente Teste',
            'cnpj' => '99.999.999/9999-99',
            'cpf' => '999.999.999-99',
            'email_contato' => 'teste@teste.com.br',
            'email_cobranca' => 'teste@teste.com.br',
            'telefone_contato' => '(99)9999-99',
            'telefone_cobranca' => '(99)9999-99',
            'endereco' => 'Rua Teste PHPUnit',
            'numero' => '999',
            'complemento' => 'casa teste',
            'bairro' => 'bairro teste',
            'municipio' => 'municipio teste',
            'uf' => 'TE'
        ]);

        $domain = Domain::create([
            'client_id' => $client->id,
            'nome' => 'teste com br',
            'dominio' => 'teste.com.br',
            'data_registro' => '1970-01-01',
            'data_vencimento' => '1970-01-01',
            'orgao_registro' => 'registro.br',
            'valor' => '40',
            'status' => 'publish',
            'descricao' => 'description teste',
            'publicado' => 1
        ]);

        $this->visit('/domain/edit/'.$domain->id)
            ->click('Remover Domínio')
            ->see('Domínio removido com sucesso!');

        $this->dontSeeInDatabase('domains', ['dominio' => 'teste.com.br']);
    }
}