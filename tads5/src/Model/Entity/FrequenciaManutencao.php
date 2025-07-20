<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FrequenciaManutencao Entity
 *
 * @property int $id
 * @property int $frequencia
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int $metrica_id
 * @property int $tipo_veiculo_id
 * @property int $categoria_peca_id
 *
 * @property \App\Model\Entity\Metrica $metrica
 * @property \App\Model\Entity\TipoVeiculo $tipo_veiculo
 * @property \App\Model\Entity\CategoriaPeca $categoria_peca
 */
class FrequenciaManutencao extends Entity
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
        'frequencia' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'metrica_id' => true,
        'tipo_veiculo_id' => true,
        'categoria_peca_id' => true,
        'metrica' => true,
        'tipo_veiculo' => true,
        'categoria_peca' => true,
    ];
}
