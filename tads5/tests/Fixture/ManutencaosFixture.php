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
                'data' => '2025-07-20',
                'valor' => 1.5,
                'ativo' => 'L',
                'created' => '2025-07-20 19:41:01',
                'modified' => '2025-07-20 19:41:01',
                'veiculo_id' => 1,
                'fornecedor_id' => 1,
            ],
        ];
        parent::init();
    }
}
