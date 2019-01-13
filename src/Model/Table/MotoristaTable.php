<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Motorista Model
 *
 * @method \App\Model\Entity\Motoristum get($primaryKey, $options = [])
 * @method \App\Model\Entity\Motoristum newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Motoristum[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Motoristum|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motoristum|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motoristum patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Motoristum[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Motoristum findOrCreate($search, callable $callback = null, $options = [])
 */
class MotoristaTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('motorista');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('codigo');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('codigo')
            ->allowEmptyString('codigo', 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->allowEmptyString('nome', false);

        $validator
            ->integer('idade')
            ->requirePresence('idade', 'create')
            ->allowEmptyString('idade', false);

        $validator
            ->scalar('sexo')
            ->maxLength('sexo', 1)
            ->requirePresence('sexo', 'create')
            ->allowEmptyString('sexo', false);

        $validator
            ->boolean('veiculo_proprio')
            ->requirePresence('veiculo_proprio', 'create')
            ->allowEmptyString('veiculo_proprio', false);

        $validator
            ->integer('tipo_veiculo')
            ->requirePresence('tipo_veiculo', 'create')
            ->allowEmptyString('tipo_veiculo', false);

        $validator
            ->scalar('tipo_cnh')
            ->maxLength('tipo_cnh', 2)
            ->requirePresence('tipo_cnh', 'create')
            ->allowEmptyString('tipo_cnh', false);

        return $validator;
    }

    function getMotoristas(){
        $fields = [
            'nome' => 'nome',
            'id' => 'Motorista.codigo',
            'idade' => 'idade',
            'sexo' => 'sexo',
            'veiculo_proprio' => 'veiculo_proprio',
            'tipo_veiculo' => 'tipo_veiculo',
            'tipo_cnh' => 'tipo_cnh',
            'origem' => 'Origem.descricao',
            'destino' => 'Destino.descricao',
        ];
        $result = $this->find()->select($fields)
        ->innerJoin(['Origem' => 'local'],'Origem.codigo = codigo_origem')
        ->innerJoin(['Destino' => 'local'],'Destino.codigo = codigo_destino')
        ->toArray();
        return $result;
    }

    function retornaVeiculosProprios(){
        $result = $this->find()->select()->where(['veiculo_proprio' => True])->count();
        return $result;
    }

    function getOrigemDestinoMotorista(){
        $fields = [
            'origem' => 'Origem.descricao',
            'destino' => 'Destino.descricao',
            'motorista' => 'Motorista.nome'
        ];
        return $this->find()->select($fields)
        ->innerJoin(['Origem' => 'local'],'Origem.codigo = Motorista.codigo_origem')
        ->innerJoin(['Destino' => 'local'],'Destino.codigo = Motorista.codigo_destino');
    }

    function getMotoristaSemCarga(){
        $fields = [
            'nome' => 'nome',
            'origem'    => 'Origem.descricao'
        ];
        return $this->find()->select($fields)
        ->innerJoin(['Origem' => 'local'],'Origem.codigo = Motorista.codigo_origem')->where(['carregado' => 0]);
    }

    function incluirMotorista($dado){
        $retornoValidacao = $this->validaDados($dado);
        if(!empty($retornoValidacao)){
            return ['erro' => $retornoValidacao];
        }
        $motorista = $this->retornaObjeto($dado);
        
        if(!$this->save($motorista)){
            return ['erro' => 'Não foi possivel atualizar os dados'];
        }
        
        
        $this->Checkin = TableRegistry::get('Checkin');
        $checkin = $this->Checkin ->newEntity();
        $checkin->codigo_motorista = $motorista->codigo;
        $checkin->data = date('Y-m-d H:i:s');
        $this->Checkin->save($checkin);
        
        return ['sucesso' => 'Registro incluido com sucesso!'];
    
    }

    function alterarMotorista($dado){
        if(!empty($dado['codigo'])){
            $retornoValidacao = $this->validaDados($dado);
            if(!empty($retornoValidacao)){
                return ['erro' => $retornoValidacao];
            }
            
            $motorista = $this->retornaObjeto($dado);
            $motorista->codigo = $dado['codigo'];
            
            if(!$this->save($motorista)){
                return ['erro' => 'Não foi possivel atualizar os dados'];
            }
            return ['sucesso' => 'Registro alterado com sucesso!'];
        }
        return ['erro' => 'Informe o código do motorista, utilize  a API (GET) /api/motorista'];
    }

    function validaDados($dado){
        if(empty($dado['sexo']) || !in_array($dado['sexo'],['M','F'])){
            return 'Informe o sexo, M para Masculino e F para Feminino';
        }
        
        
        if(empty($dado['veiculo_proprio']) || !in_array($dado['veiculo_proprio'],['S','N'])){
            return 'Informe o veículo proprio, S para Sim e N para Não';
        }

        if(empty($dado['carregado']) || !in_array($dado['carregado'],['S','N'])){
            return 'Informe se ésta carregado, S para Sim e N para Não';
        }

        if(empty($dado['origem'])){
            return 'Informe a origem';
        }

        if(empty($dado['latitude_origem']) || empty($dado['longitude_origem'])){
            return 'Informe a latitude e longitude da origem';
        }

        if(empty($dado['destino'])){
            return 'Informe o destino';
        }

        if(empty($dado['latitude_destino']) || empty($dado['longitude_destino'])){
            return 'Informe a latitude e longitude do destino';
        }

        if(empty($dado['tipo_cnh']) || !in_array($dado['tipo_cnh'],['A','B','C','D','E'])){
            return 'Informe a CNH, tipos disponiveis A,B,C,D,E';
        }
        if(empty($dado['idade']) || !is_int($dado['idade'])){
            return 'Informe a idade, somente números inteiros';
        }
        if($dado['idade'] < 18){
            return 'É necessario ter mais de 18 anos';
        }
        if(empty($dado['nome'])){
            return 'Informe o nome';
        }
        if(!empty($dado['codigo'])){
            if($this->find()->select()->where(['codigo' => $dado['codigo']])->count() == 0){
                return 'Motorista não encontrado';
            }
        }
        
    }

    function retornaObjeto($dado){
        $entities = TableRegistry::get('Motorista');
        $this->Local = TableRegistry::get('Local');
        $motorista = $entities->newEntity();
        $motorista->nome = $dado['nome'];
        $motorista->idade = $dado['idade'];
        $motorista->tipo_cnh = $dado['tipo_cnh'];
        $motorista->sexo = $dado['sexo'];
        $motorista->veiculo_proprio = ($dado['veiculo_proprio'] == 'S') ? 1 : 0;
        $motorista->tipo_veiculo = $dado['tipo_veiculo'];
        $motorista->carregado = ($dado['carregado'] == 'S') ? 1 : 0;
        $motorista->codigo_origem = $this->Local->retornaLocal($dado['origem'],$dado['latitude_origem'],$dado['longitude_destino']);
        $motorista->codigo_destino = $this->Local->retornaLocal($dado['destino'],$dado['latitude_origem'],$dado['longitude_destino']);
        return $motorista;
    }
    
}
