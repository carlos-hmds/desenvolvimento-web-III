<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategoriaPecasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategoriaPecasTable Test Case
 */
class CategoriaPecasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CategoriaPecasTable
     */
    protected $CategoriaPecas;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.CategoriaPecas',
        'app.FrequenciaManutencaos',
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
        $config = $this->getTableLocator()->exists('CategoriaPecas') ? [] : ['className' => CategoriaPecasTable::class];
        $this->CategoriaPecas = $this->getTableLocator()->get('CategoriaPecas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CategoriaPecas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CategoriaPecasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
