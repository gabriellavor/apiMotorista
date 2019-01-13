<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TipoVeiculoFixture
 *
 */
class TipoVeiculoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'tipo_veiculo';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'codigo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'descricao' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['codigo'], 'length' => []],
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
                'descricao' => 'Caminhão 3/4'
            ],
            [
                'codigo' => 2,
                'descricao' => 'Caminhão Toco'
            ],
            [
                'codigo' => 3,
                'descricao' => 'Caminhão Truck'
            ],
            [
                'codigo' => 4,
                'descricao' => 'Carreta Simples'
            ],
            [
                'codigo' => 5,
                'descricao' => 'Carreta Eixo Extendido'
            ],
        ];
        parent::init();
    }

 
}
