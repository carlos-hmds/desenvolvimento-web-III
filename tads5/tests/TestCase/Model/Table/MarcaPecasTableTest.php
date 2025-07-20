<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MarcaPecasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MarcaPecasTable Test Case
 */
class MarcaPecasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MarcaPecasTable
     */
    protected $MarcaPecas;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.MarcaPecas',
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
        $config = $this->getTableLocator()->exists('MarcaPecas') ? [] : ['className' => MarcaPecasTable::class];
        $this->MarcaPecas = $this->getTableLocator()->get('MarcaPecas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->MarcaPecas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\MarcaPecasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
