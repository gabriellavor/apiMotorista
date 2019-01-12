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
            'idade' => 'idade',
            'sexo' => 'sexo',
            'veiculo_proprio' => 'veiculo_proprio',
            'tipo_veiculo' => 'tipo_veiculo',
            'tipo_cnh' => 'tipo_cnh'
        ];
        $result = $this->find()->select($fields)->toArray();
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
    
}
