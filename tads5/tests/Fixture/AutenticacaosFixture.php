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
                'expiracao' => '2025-07-20',
                'ativo' => 'L',
                'created' => '2025-07-20 19:10:19',
                'modified' => '2025-07-20 19:10:19',
            ],
        ];
        parent::init();
    }
}
