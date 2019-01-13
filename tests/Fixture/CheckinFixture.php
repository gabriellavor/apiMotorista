<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CheckinFixture
 *
 */
class CheckinFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'checkin';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'codigo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'data' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'codigo_origem' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'codigo_destino' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'carregado' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'codigo_motorista' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_checkin_1_idx' => ['type' => 'index', 'columns' => ['codigo_motorista'], 'length' => []],
            'fk_checkin_2_idx' => ['type' => 'index', 'columns' => ['codigo_origem'], 'length' => []],
            'fk_checkin_3_idx' => ['type' => 'index', 'columns' => ['codigo_destino'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['codigo'], 'length' => []],
            'fk_checkin_1' => ['type' => 'foreign', 'columns' => ['codigo_motorista'], 'references' => ['motorista', 'codigo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_checkin_2' => ['type' => 'foreign', 'columns' => ['codigo_origem'], 'references' => ['local', 'codigo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_checkin_3' => ['type' => 'foreign', 'columns' => ['codigo_destino'], 'references' => ['local', 'codigo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'data' => date('Y-m-d H:i:s'),
                'codigo_origem' => 1,
                'codigo_destino' => 1,
                'carregado' => 1,
                'codigo_motorista' => 1
            ],
        ];
        parent::init();
    }
}
