<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Manutencao Entity
 *
 * @property int $id
 * @property string $descricao
 * @property \Cake\I18n\Date $data
 * @property string $valor
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int $veiculo_id
 * @property int $fornecedor_id
 *
 * @property \App\Model\Entity\Veiculo $veiculo
 * @property \App\Model\Entity\Fornecedor $fornecedor
 * @property \App\Model\Entity\ItemManutencao[] $item_manutencaos
 */
class Manutencao extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'descricao' => true,
        'data' => true,
        'valor' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'veiculo_id' => true,
        'fornecedor_id' => true,
        'veiculo' => true,
        'fornecedor' => true,
        'item_manutencaos' => true,
    ];
}
