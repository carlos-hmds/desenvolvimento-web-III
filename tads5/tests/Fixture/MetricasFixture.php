<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MetricasFixture
 */
class MetricasFixture extends TestFixture
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
                'codigo' => 'Lorem ipsum dolor sit ',
                'descricao' => 'Lorem ipsum dolor sit amet',
                'ativo' => 'L',
                'created' => '2025-07-20 19:20:16',
                'modified' => '2025-07-20 19:20:16',
            ],
        ];
        parent::init();
    }
}
