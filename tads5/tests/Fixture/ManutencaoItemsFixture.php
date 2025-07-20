<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManutencaoItemsFixture
 */
class ManutencaoItemsFixture extends TestFixture
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
                'ativo' => 'L',
                'created' => '2025-07-20 19:20:27',
                'modified' => '2025-07-20 19:20:27',
                'manutencao_id' => 1,
                'peca_id' => 1,
            ],
        ];
        parent::init();
    }
}
