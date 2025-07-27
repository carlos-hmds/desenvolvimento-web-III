<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateFornecedors extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('fornecedors');
        $table->addColumn('cnpj', 'string', [
            'default' => null,
            'limit' => 18,
            'null' => false,
        ]);
        $table->addColumn('nome', 'string', [
            'default' => null,
            'limit' => 224,
            'null' => false,
        ]);
        $table->addColumn('telefone', 'string', [
            'default' => null,
            'limit' => 16,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('logradouro', 'string', [
            'default' => null,
            'limit' => 180,
            'null' => false,
        ]);
        $table->addColumn('numero', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('bairro', 'string', [
            'default' => null,
            'limit' => 150,
            'null' => false,
        ]);
        $table->addColumn('complemento', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('cidade', 'string', [
            'default' => null,
            'limit' => 200,
            'null' => false,
        ]);
        $table->addColumn('estado', 'string', [
            'default' => null,
            'limit' => 2,
            'null' => false,
        ]);
        $table->addColumn('cep', 'string', [
            'default' => null,
            'limit' => 10,
            'null' => false,
        ]);
        $table->addColumn('ativo', 'string', [
            'default' => 'S',
            'limit' => 1,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('tipo_servico_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->create();
    }
}
