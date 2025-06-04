<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManuPecasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManuPecasTable Test Case
 */
class ManuPecasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ManuPecasTable
     */
    protected $ManuPecas;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ManuPecas',
        'app.Manutencaos',
        'app.Pecas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ManuPecas') ? [] : ['className' => ManuPecasTable::class];
        $this->ManuPecas = $this->getTableLocator()->get('ManuPecas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ManuPecas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ManuPecasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ManuPecasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
