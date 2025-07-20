<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateMetricas extends BaseMigration
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
        $table = $this->table('metricas');
        $table->addColumn('codigo', 'string', [
            'default' => null,
            'limit' => 24,
            'null' => false,
        ]);
        $table->addColumn('descricao', 'string', [
            'default' => null,
            'limit' => 48,
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
        $table->addIndex([
            'codigo',

            ], [
            'name' => 'UNIQUE_CODIGO',
            'unique' => true,
        ]);
        $table->create();
    }
}
