<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoVeiculosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoVeiculosTable Test Case
 */
class TipoVeiculosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoVeiculosTable
     */
    protected $TipoVeiculos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.TipoVeiculos',
        'app.FrequenciaManutencaos',
        'app.Veiculos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TipoVeiculos') ? [] : ['className' => TipoVeiculosTable::class];
        $this->TipoVeiculos = $this->getTableLocator()->get('TipoVeiculos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TipoVeiculos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TipoVeiculosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
