<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TipoVeiculosFixture
 */
class TipoVeiculosFixture extends TestFixture
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
                'ativo' => 'L',
                'created' => '2025-07-20 19:20:07',
                'modified' => '2025-07-20 19:20:07',
            ],
        ];
        parent::init();
    }
}
