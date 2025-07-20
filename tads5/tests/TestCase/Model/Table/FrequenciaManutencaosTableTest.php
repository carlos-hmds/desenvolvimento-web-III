<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FrequenciaManutencaosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FrequenciaManutencaosTable Test Case
 */
class FrequenciaManutencaosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FrequenciaManutencaosTable
     */
    protected $FrequenciaManutencaos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.FrequenciaManutencaos',
        'app.Metricas',
        'app.TipoVeiculos',
        'app.CategoriaPecas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('FrequenciaManutencaos') ? [] : ['className' => FrequenciaManutencaosTable::class];
        $this->FrequenciaManutencaos = $this->getTableLocator()->get('FrequenciaManutencaos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->FrequenciaManutencaos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FrequenciaManutencaosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FrequenciaManutencaosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
