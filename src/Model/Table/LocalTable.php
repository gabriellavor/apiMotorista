<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
/**
 * Local Model
 *
 * @method \App\Model\Entity\Local get($primaryKey, $options = [])
 * @method \App\Model\Entity\Local newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Local[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Local|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Local|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Local patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Local[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Local findOrCreate($search, callable $callback = null, $options = [])
 */
class LocalTable extends Table
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

        $this->setTable('local');
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

        $validator
            ->decimal('latitude')
            ->requirePresence('latitude', 'create')
            ->allowEmptyString('latitude', false);

        $validator
            ->decimal('longitude')
            ->requirePresence('longitude', 'create')
            ->allowEmptyString('longitude', false);

        return $validator;
    }

    public function retornaLocalPorCodigo($codigo){
        return $this->find()->select(['id' => 'codigo','descricao' => 'descricao'])->where([['codigo' => $codigo]])->toArray();
    }

    public function retornaLocalPorDescricao($descricao){
        return $this->find()->select(['id' => 'codigo','descricao' => 'descricao'])->where([['descricao' => $descricao]])->toArray();
    }

    public function retornaLocal($descricao,$latitude,$longitude){
        $local = $this->retornaLocalPorDescricao($descricao);
        if(!empty($local)){
            return $local[0]['id'];
        }
        $this->Local = TableRegistry::get('Local');
        $local = $this->Local->newEntity();
        $local->descricao = $descricao;
        $local->latitude = $latitude;
        $local->longitude = $longitude;
        $this->Local->save($local);
        return $local->codigo;
        
    }

    
}
