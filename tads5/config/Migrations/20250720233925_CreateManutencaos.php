<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateManutencaos extends BaseMigration
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
        $table = $this->table('manutencaos');
        $table->addColumn('descricao', 'string', [
            'default' => null,
            'limit' => 256,
            'null' => false,
        ]);
        $table->addColumn('data', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('valor', 'decimal', [
            'default' => null,
            'null' => false,
            'precision' => 10,
            'scale' => 2,
        ]);
        $table->addColumn('nota_fiscal', 'integer', [
            'default' => null,
            'limit' => 11,
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
        $table->addColumn('veiculo_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('fornecedor_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->create();
    }
}
