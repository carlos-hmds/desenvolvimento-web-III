<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'nome' => 'Lorem ipsum dolor sit amet',
                'cpf' => 'Lorem ipsum ',
                'password' => 'Lorem ipsum dolor sit amet',
                'celular' => 'Lorem ipsum d',
                'dtNasc' => '2025-04-07',
                'email' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-04-07 19:55:55',
                'modified' => '2025-04-07 19:55:55',
            ],
        ];
        parent::init();
    }
}
