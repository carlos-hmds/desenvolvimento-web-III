<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemManutencaosFixture
 */
class ItemManutencaosFixture extends TestFixture
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
                'created' => '2025-07-20 19:41:05',
                'modified' => '2025-07-20 19:41:05',
                'manutencao_id' => 1,
                'peca_id' => 1,
            ],
        ];
        parent::init();
    }
}
