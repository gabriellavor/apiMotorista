<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Checkin Model
 *
 * @method \App\Model\Entity\Checkin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Checkin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Checkin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Checkin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checkin|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checkin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Checkin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Checkin findOrCreate($search, callable $callback = null, $options = [])
 */
class CheckinTable extends Table
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

        $this->setTable('checkin');
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
            ->dateTime('data')
            ->allowEmptyDateTime('data');

        $validator
            ->integer('codigo_origem')
            ->allowEmptyString('codigo_origem');

        $validator
            ->integer('codigo_destino')
            ->allowEmptyString('codigo_destino');

        $validator
            ->boolean('carregado')
            ->allowEmptyString('carregado');

        $validator
            ->integer('codigo_motorista')
            ->allowEmptyString('codigo_motorista');

        return $validator;
    }

    public function retornaTotalChegada(){
        $periodo = $this->retornaPeriodo();
        
        $subQueryDia = $this->find()->where(['Day(data) = Day(NOW())'])->count();
        $subQuerySemana = $this->find()->where(["data BETWEEN '{$periodo[0]}' AND '{$periodo[1]}'"])->count();
        $subQueryMes = $this->find()->where(['Month(data) = Month(NOW())'])->count();
        $fields = [
            'dia' => $subQueryDia,
            'semana' => $subQuerySemana,
            'mes' => $subQueryMes,
        ];
        
        return $this->find()->select($fields)
        ->innerJoin(['Motorista' => 'motorista'],'Motorista.codigo = Checkin.codigo_motorista')
        ->where(['Motorista.carregado' => 1]
        )->limit(1)->toArray();
    }

    public function retornaPeriodo(){
        $data = date('N');
        if($data == 7){
            $ini = 0;
            $fim = 7;
        }else{
            $ini = $data;
            $fim = 6 - $data;
        }
        $ini = date('Y-m-d 00:00:00',strtotime("- $data day"));
        $fim = date('Y-m-d 00:00:00',strtotime("+ $fim day"));
        return [$ini,$fim];
    }

    public function origemDestinoPorTipoVeiculo(){
        $fields = [
            'tipo' => "'origem'",
            'descricao' => 'Origem.descricao',
            'tipo_veiculo' => 'TipoVeiculo.descricao',
            'total'     => 'COUNT(*)'
        ];
        $result_origem = $this->find()->select($fields)
        ->innerJoin(['Motorista' => 'motorista'],'Motorista.codigo = Checkin.codigo_motorista')
        ->innerJoin(['TipoVeiculo' => 'tipo_veiculo'],'TipoVeiculo.codigo = Motorista.tipo_veiculo')
        ->innerJoin(['Origem' => 'local'],'Origem.codigo = Motorista.codigo_origem')
        ->group(['Origem.descricao','TipoVeiculo.descricao']);

        $fields = [
            'tipo' => "'destino'",
            'descricao' => 'Destino.descricao',
            'tipo_veiculo' => 'TipoVeiculo.descricao',
            'total'     => 'COUNT(*)'
        ];
        $result = $this->find()->select($fields)
        ->innerJoin(['Motorista' => 'motorista'],'Motorista.codigo = Checkin.codigo_motorista')
        ->innerJoin(['TipoVeiculo' => 'tipo_veiculo'],'TipoVeiculo.codigo = Motorista.tipo_veiculo')
        ->innerJoin(['Destino' => 'local'],'Destino.codigo = Motorista.codigo_destino')
        ->group(['Destino.descricao','TipoVeiculo.descricao']);

        $result->union($result_origem);
        return $result;
    }
}
