<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoServicosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoServicosTable Test Case
 */
class TipoServicosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoServicosTable
     */
    protected $TipoServicos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.TipoServicos',
        'app.Fornecedors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TipoServicos') ? [] : ['className' => TipoServicosTable::class];
        $this->TipoServicos = $this->getTableLocator()->get('TipoServicos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TipoServicos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TipoServicosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
