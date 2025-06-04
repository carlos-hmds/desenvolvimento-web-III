<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Peca Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $valor
 * @property int|null $garantia
 * @property int|null $notaFiscal
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int $fornecedor_id
 *
 * @property \App\Model\Entity\Fornecedor $fornecedor
 * @property \App\Model\Entity\ManuPeca[] $manu_pecas
 */
class Peca extends Entity
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
        'valor' => true,
        'garantia' => true,
        'notaFiscal' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'fornecedor_id' => true,
        'fornecedor' => true,
        'manu_pecas' => true,
    ];
}
