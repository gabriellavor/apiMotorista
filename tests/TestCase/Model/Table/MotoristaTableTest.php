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
        'app.Local',
        'app.TipoVeiculo',
        'app.Checkin'
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
        $retorno = $this->Motorista->retornaVeiculosProprios();
        $this->assertEquals($retorno,1);
    }

    public function testIncluirMotorista()
    {
        $anterior = $this->Motorista->find()->select()->count();
        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  31,
            'veiculo_proprio' =>  'N',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);
        $novo = $this->Motorista->find()->select()->count();
        $this->assertEquals('Registro incluido com sucesso!',$retorno['sucesso']);
        $this->assertEquals($anterior+1,$novo);
    }


    public function testIncluirMotoristaValidaIdade()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  17,
            'veiculo_proprio' =>  'N',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('É necessario ter mais de 18 anos',$retorno['erro']);


        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  'ss',
            'veiculo_proprio' =>  'N',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe a idade, somente números inteiros',$retorno['erro']);
    }

    public function testIncluirMotoristaValidaSexo()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  19,
            'veiculo_proprio' =>  'N',
            'tipo_cnh' => 'D',
            'sexo' => 'S',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe o sexo, M para Masculino e F para Feminino',$retorno['erro']);
    }

    public function testIncluirMotoristaValidaVeiculoProprio()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  19,
            'veiculo_proprio' =>  'C',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe o veículo proprio, S para Sim e N para Não',$retorno['erro']);
    }

    public function testIncluirMotoristaValidaVeiculoCarregado()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  19,
            'veiculo_proprio' =>  'S',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'E',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe se ésta carregado, S para Sim e N para Não',$retorno['erro']);
    }


    public function testIncluirMotoristaValidaOrigem()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  19,
            'veiculo_proprio' =>  'S',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe a origem',$retorno['erro']);
        
    }

    public function testIncluirMotoristaValidaDestino()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  19,
            'veiculo_proprio' =>  'S',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe o destino',$retorno['erro']);
        
    }

    public function testIncluirMotoristaValidaCNH()
    {

        $dado = [
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  19,
            'veiculo_proprio' =>  'S',
            'tipo_cnh' => 'Z',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe a CNH, tipos disponiveis A,B,C,D,E',$retorno['erro']);
        
    }

    public function testIncluirMotoristaValidaNome()
    {

        $dado = [
            'nome' => '',
            'idade' =>  19,
            'veiculo_proprio' =>  'S',
            'tipo_cnh' => 'A',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->incluirMotorista($dado);        
        $this->assertEquals('Informe o nome',$retorno['erro']);
        
    }

    

    public function testAlterarMotorista()
    {
        $dado = [
            'codigo' =>  1,
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  31,
            'veiculo_proprio' =>  'N',
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  'S',
            'tipo_veiculo' =>  1,
            'origem' => 'Extra',
            'latitude_origem' => '-57.5548',
            'longitude_origem' => '-57.5548',
            'latitude_destino' => '-27.999',
            'longitude_destino' => '-27.999',
            'destino' => 'Loja',
        ];
        $retorno = $this->Motorista->alterarMotorista($dado);
        $this->assertEquals('Registro alterado com sucesso!',$retorno['sucesso']);
        $esperado = [
            'codigo' =>  1,
            'nome' => 'Nicole Laís Fátima Carvalho',
            'idade' =>  31,
            'veiculo_proprio' =>  0,
            'tipo_cnh' => 'D',
            'sexo' => 'F',
            'carregado' =>  1,
            'tipo_veiculo' =>  1,
            'codigo_origem' => 1,
            'codigo_destino' => 2,
        ];

        $motorista = $this->Motorista->find()->select()->toArray();
        $mot = json_decode(json_encode($motorista), True);
        $this->assertEquals($mot[0],$esperado);   
    }
   
}
