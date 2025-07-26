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
 * @property int $garantia
 * @property int $nota_fiscal
 * @property string $ativo
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int|null $marca_peca_id
 * @property int $categoria_peca_id
 * @property int $fornecedor_id
 *
 * @property \App\Model\Entity\MarcaPeca $marca_peca
 * @property \App\Model\Entity\CategoriaPeca $categoria_peca
 * @property \App\Model\Entity\Fornecedor $fornecedor
 * @property \App\Model\Entity\ItemManutencao[] $item_manutencaos
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
        'nota_fiscal' => true,
        'ativo' => true,
        'created' => true,
        'modified' => true,
        'marca_peca_id' => true,
        'categoria_peca_id' => true,
        'fornecedor_id' => true,
        'marca_peca' => true,
        'categoria_peca' => true,
        'fornecedor' => true,
        'item_manutencaos' => true,
    ];
}
