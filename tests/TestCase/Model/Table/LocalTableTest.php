<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LocalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LocalTable Test Case
 */
class LocalTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LocalTable
     */
    public $Local;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Local') ? [] : ['className' => LocalTable::class];
        $this->Local = TableRegistry::getTableLocator()->get('Local', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Local);

        parent::tearDown();
    }

    /**
     * Test RetornaLocalPorCodigo method
     *
     * @return void
     */
    public function testRetornaLocalPorCodigo()
    {
        $retorno = $this->Local->retornaLocalPorCodigo(1);
        $this->assertEquals($retorno[0]['descricao'],'Extra');
    }

    /**
     * Test RetornaLocalPorDescricao method
     *
     * @return void
     */
    public function testRetornaLocalPorDescricao()
    {
        $retorno = $this->Local->retornaLocalPorDescricao('Loja');
        $this->assertEquals($retorno[0]['id'],2);
    }


    /**
     * Test RetornaLocal method
     *
     * @return void
     */
    public function testRetornaLocal()
    {
        $retorno = $this->Local->retornaLocal('Loja','-54.988','-58.666');
        $this->assertEquals($retorno,2);

        $retorno = $this->Local->retornaLocal('Loja 2','-54.988','-58.666');
        $this->assertEquals($retorno,3);
    }

    
}
