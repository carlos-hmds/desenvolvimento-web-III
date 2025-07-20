<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Metrica Entity
 *
 * @property int $id
 * @property string $codigo
 * @property string $descricao
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\FrequenciaManutencao[] $frequencia_manutencaos
 */
class Metrica extends Entity
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
        'codigo' => true,
        'descricao' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'frequencia_manutencaos' => true,
    ];
}
