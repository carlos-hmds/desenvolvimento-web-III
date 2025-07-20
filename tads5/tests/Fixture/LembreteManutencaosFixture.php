<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LembreteManutencaosFixture
 */
class LembreteManutencaosFixture extends TestFixture
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
                'created' => '2025-07-20 19:10:56',
                'modified' => '2025-07-20 19:10:56',
                'metrica_id' => 1,
                'frequencia' => 1,
                'categoria_peca_id' => 1,
                'tipo_veiculo_id' => 1,
            ],
        ];
        parent::init();
    }
}
