<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MarcaPecasFixture
 */
class MarcaPecasFixture extends TestFixture
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
                'ativo' => 'L',
                'created' => '2025-07-20 19:40:39',
                'modified' => '2025-07-20 19:40:39',
            ],
        ];
        parent::init();
    }
}
