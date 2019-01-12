<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CheckinTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CheckinTable Test Case
 */
class CheckinTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CheckinTable
     */
    public $Checkin;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Checkin',
        'app.Motorista'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Checkin') ? [] : ['className' => CheckinTable::class];
        $this->Checkin = TableRegistry::getTableLocator()->get('Checkin', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Checkin);

        parent::tearDown();
    }

    public function testRetornaTotalChegada()
    {
        $result = $this->Checkin->retornaTotalChegada();
        $this->assertTrue(false);

    }

    public function testRetornaPeriodo()
    {
        $result = $this->Checkin->retornaPeriodo();
        $this->assertTrue(false);
    }

    public function testOrigemDestinoPorTipoVeiculo()
    {
        $result = $this->Checkin->origemDestinoPorTipoVeiculo();
        $this->assertTrue(false);
    }
}
