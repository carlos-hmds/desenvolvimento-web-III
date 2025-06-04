<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Veiculo Entity
 *
 * @property int $id
 * @property string $modelo
 * @property int $ano
 * @property string $placa
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int $tipo_id
 * @property int $fabricante_id
 *
 * @property \App\Model\Entity\Tipo $tipo
 * @property \App\Model\Entity\Fabricante $fabricante
 * @property \App\Model\Entity\Manutencao[] $manutencaos
 */
class Veiculo extends Entity
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
        'modelo' => true,
        'ano' => true,
        'placa' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'tipo_id' => true,
        'fabricante_id' => true,
        'tipo' => true,
        'fabricante' => true,
        'manutencaos' => true,
    ];
}
