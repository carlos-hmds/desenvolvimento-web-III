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
                'data' => '2025-04-22',
                'valor' => 1.5,
                'notaFiscal' => 1,
                'ativo' => 'L',
                'created' => '2025-04-22 21:47:57',
                'modified' => '2025-04-22 21:47:57',
                'veiculo_id' => 1,
                'fornecedor_id' => 1,
            ],
        ];
        parent::init();
    }
}
