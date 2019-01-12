<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipoVeiculoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipoVeiculoTable Test Case
 */
class TipoVeiculoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TipoVeiculoTable
     */
    public $TipoVeiculo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TipoVeiculo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TipoVeiculo') ? [] : ['className' => TipoVeiculoTable::class];
        $this->TipoVeiculo = TableRegistry::getTableLocator()->get('TipoVeiculo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TipoVeiculo);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
