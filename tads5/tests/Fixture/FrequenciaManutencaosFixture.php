<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FrequenciaManutencaosFixture
 */
class FrequenciaManutencaosFixture extends TestFixture
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
                'tipo_metrica' => 'Lorem ipsum dolor ',
                'frequencia' => 1,
                'ativo' => 'L',
                'created' => '2025-07-20 20:50:00',
                'modified' => '2025-07-20 20:50:00',
                'tipo_veiculo_id' => 1,
                'categoria_peca_id' => 1,
            ],
        ];
        parent::init();
    }
}
