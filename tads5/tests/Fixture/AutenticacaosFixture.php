<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AutenticacaosFixture
 */
class AutenticacaosFixture extends TestFixture
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
                'cpf' => 'Lorem ipsum ',
                'autenticacao' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-04-07 19:56:02',
                'modified' => '2025-04-07 19:56:02',
            ],
        ];
        parent::init();
    }
}
