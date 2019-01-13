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
        'app.Motorista',
        'app.TipoVeiculo',
        'app.Local'
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
        $this->assertEquals($result[0]['dia'],1);
        $this->assertEquals($result[0]['semana'],1);
        $this->assertEquals($result[0]['mes'],1);

    }

    public function testRetornaPeriodo()
    {
        $result = $this->Checkin->retornaPeriodo('2019-01-09');
        $this->assertEquals($result['0'],'2019-01-06 00:00:00');
        $this->assertEquals($result['1'],'2019-01-12 23:59:59');
        $result = $this->Checkin->retornaPeriodo('2019-01-06');
        $this->assertEquals($result['0'],'2019-01-06 00:00:00');
        $this->assertEquals($result['1'],'2019-01-12 23:59:59');
        $result = $this->Checkin->retornaPeriodo('2019-01-12');
        $this->assertEquals($result['0'],'2019-01-06 00:00:00');
        $this->assertEquals($result['1'],'2019-01-12 23:59:59');
        $result = $this->Checkin->retornaPeriodo('2019-01-07');
        $this->assertEquals($result['0'],'2019-01-06 00:00:00');
        $this->assertEquals($result['1'],'2019-01-12 23:59:59');
    }

    public function testOrigemDestinoPorTipoVeiculo()
    {
        $result = $this->Checkin->origemDestinoPorTipoVeiculo();
        $this->assertEquals($result->count(),2);
    }
}
