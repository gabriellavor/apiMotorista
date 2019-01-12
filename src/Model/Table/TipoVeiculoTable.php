<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoVeiculo Model
 *
 * @method \App\Model\Entity\TipoVeiculo get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoVeiculo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoVeiculo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoVeiculo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo findOrCreate($search, callable $callback = null, $options = [])
 */
class TipoVeiculoTable extends Table
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

        $this->setTable('tipo_veiculo');
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
            ->scalar('descricao')
            ->maxLength('descricao', 45)
            ->requirePresence('descricao', 'create')
            ->allowEmptyString('descricao', false);

        return $validator;
    }

    public function getTIposveiculos(){
        $fields = [
            'codigo' => 'codigo',
            'descricao' => 'descricao'
        ];
        $result = $this->find()->select($fields)->toArray();
        return $result;
    }

    public function getTIposveiculo($codigo){
        $fields = [
            'codigo' => 'codigo',
            'descricao' => 'descricao'
        ];
        $result = $this->find()->select($fields)->where(['codigo' => $codigo])->toArray();
        return $result;
    }
}
