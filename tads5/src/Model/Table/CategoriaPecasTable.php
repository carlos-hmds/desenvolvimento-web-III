<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoriaPecas Model
 *
 * @property \App\Model\Table\PecasTable&\Cake\ORM\Association\HasMany $Pecas
 *
 * @method \App\Model\Entity\CategoriaPeca newEmptyEntity()
 * @method \App\Model\Entity\CategoriaPeca newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CategoriaPeca> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoriaPeca get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CategoriaPeca findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CategoriaPeca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CategoriaPeca> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoriaPeca|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CategoriaPeca saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CategoriaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoriaPeca>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CategoriaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoriaPeca> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CategoriaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoriaPeca>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CategoriaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoriaPeca> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoriaPecasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('categoria_pecas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('FrequenciaManutencaos', [
            'foreignKey' => 'categoria_peca_id',
        ]);
        $this->hasMany('Pecas', [
            'foreignKey' => 'categoria_peca_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('nome')
            ->maxLength('nome', 180)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('ativo')
            ->maxLength('ativo', 1)
            ->notEmptyString('ativo');

        return $validator;
    }
}
