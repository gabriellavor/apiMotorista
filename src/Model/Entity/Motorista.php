<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Motorista Entity
 *
 * @property int $codigo
 * @property string $nome
 * @property int $idade
 * @property string $sexo
 * @property bool $veiculo_proprio
 * @property int $tipo_veiculo
 * @property string $tipo_cnh
 */
class Motorista extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'idade' => true,
        'sexo' => true,
        'veiculo_proprio' => true,
        'tipo_veiculo' => true,
        'tipo_cnh' => true
    ];
}
