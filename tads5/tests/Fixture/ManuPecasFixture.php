<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ManuPecasFixture
 */
class ManuPecasFixture extends TestFixture
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
                'created' => '2025-04-22 21:18:57',
                'modified' => '2025-04-22 21:18:57',
                'manutencao_id' => 1,
                'peca_id' => 1,
            ],
        ];
        parent::init();
    }
}
