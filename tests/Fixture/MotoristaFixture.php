<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MotoristaFixture
 *
 */
class MotoristaFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'motorista';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'codigo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'nome' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'idade' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'sexo' => ['type' => 'string', 'length' => 1, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'veiculo_proprio' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'tipo_veiculo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipo_cnh' => ['type' => 'string', 'length' => 2, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'carregado' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'codigo_origem' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'codigo_destino' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_motorista_1_idx' => ['type' => 'index', 'columns' => ['tipo_veiculo'], 'length' => []],
            'fk_motorista_3_idx' => ['type' => 'index', 'columns' => ['codigo_destino'], 'length' => []],
            'fk_motorista_2_idx' => ['type' => 'index', 'columns' => ['codigo_origem'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['codigo'], 'length' => []],
            'fk_motorista_1' => ['type' => 'foreign', 'columns' => ['tipo_veiculo'], 'references' => ['tipo_veiculo', 'codigo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_motorista_2' => ['type' => 'foreign', 'columns' => ['codigo_origem'], 'references' => ['local', 'codigo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_motorista_3' => ['type' => 'foreign', 'columns' => ['codigo_destino'], 'references' => ['local', 'codigo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'codigo' => 1,
                'nome' => 'Pedro Marcos Dias',
                'idade' => 35,
                'sexo' => 'M',
                'veiculo_proprio' => 1,
                'tipo_veiculo' => 1,
                'tipo_cnh' => 'A',
                'carregado' => 1,
                'codigo_origem' => 1,
                'codigo_destino' => 2
            ],
        ];
        parent::init();
    }
}
