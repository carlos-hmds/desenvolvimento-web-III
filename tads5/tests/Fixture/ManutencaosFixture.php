<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManutencaosFixture
 */
class ManutencaosFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'descricao' => 'Lorem ipsum dolor sit amet',
                'data' => '2025-07-22',
                'valor' => 1.5,
                'nota_fiscal' => 1,
                'ativo' => 'L',
                'created' => '2025-07-22 22:32:03',
                'modified' => '2025-07-22 22:32:03',
                'veiculo_id' => 1,
                'fornecedor_id' => 1,
            ],
        ];
        parent::init();
    }
}
