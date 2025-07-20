<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PecasFixture
 */
class PecasFixture extends TestFixture
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
                'valor' => 1.5,
                'garantia' => 1,
                'notaFiscal' => 1,
                'ativo' => 'L',
                'created' => '2025-07-20 19:20:03',
                'modified' => '2025-07-20 19:20:03',
                'marca_peca_id' => 1,
                'categoria_peca_id' => 1,
                'fornecedor_id' => 1,
            ],
        ];
        parent::init();
    }
}
