<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemManutencaosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemManutencaosTable Test Case
 */
class ItemManutencaosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemManutencaosTable
     */
    protected $ItemManutencaos;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ItemManutencaos',
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
        $config = $this->getTableLocator()->exists('ItemManutencaos') ? [] : ['className' => ItemManutencaosTable::class];
        $this->ItemManutencaos = $this->getTableLocator()->get('ItemManutencaos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ItemManutencaos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ItemManutencaosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ItemManutencaosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
