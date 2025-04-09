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
                'autenticacao' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'ativo' => 'L',
                'created' => '2025-04-08 22:04:53',
                'modified' => '2025-04-08 22:04:53',
            ],
        ];
        parent::init();
    }
}
