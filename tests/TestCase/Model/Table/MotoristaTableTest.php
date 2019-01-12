<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MotoristaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MotoristaTable Test Case
 */
class MotoristaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MotoristaTable
     */
    public $Motorista;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Motorista',
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
        $config = TableRegistry::getTableLocator()->exists('Motorista') ? [] : ['className' => MotoristaTable::class];
        $this->Motorista = TableRegistry::getTableLocator()->get('Motorista', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Motorista);

        parent::tearDown();
    }

    /**
     * Test para retornar todos os motoristas cadastrados
     *
     * @return void
     */
    public function testgetMotoristas()
    {
        $retorno = $this->Motorista->getMotoristas();
        $esperado = [
            [
                'nome' => 'Pedro Marcos Dias',
                'id' => 1,
                'idade' => 35,
                'sexo' => 'M',
                'veiculo_proprio' => True,
                'tipo_veiculo' => 1,
                'tipo_cnh' => 'A',
                'origem' => 'Extra',
                'destino' => 'Loja'
            ]
        ];
        $this->assertEquals(json_encode($retorno),json_encode($esperado));
    }

    public function testRetornaVeiculosProprios()
    {
        $this->assertTrue(false);
    }

    public function testIncluirMotorista()
    {
        $this->assertTrue(false);   
    }

    public function testAlterarMotorista()
    {
        $this->assertTrue(false);   
    }
   
}
