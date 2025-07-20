<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CategoriaPeca Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\FrequenciaManutencao[] $frequencia_manutencaos
 * @property \App\Model\Entity\Peca[] $pecas
 */
class CategoriaPeca extends Entity
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
        'nome' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'frequencia_manutencaos' => true,
        'pecas' => true,
    ];
}
