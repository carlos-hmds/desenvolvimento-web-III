<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MarcaPecas Model
 *
 * @property \App\Model\Table\PecasTable&\Cake\ORM\Association\HasMany $Pecas
 *
 * @method \App\Model\Entity\MarcaPeca newEmptyEntity()
 * @method \App\Model\Entity\MarcaPeca newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MarcaPeca> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MarcaPeca get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MarcaPeca findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MarcaPeca patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MarcaPeca> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MarcaPeca|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MarcaPeca saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MarcaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarcaPeca>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MarcaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarcaPeca> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MarcaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarcaPeca>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MarcaPeca>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MarcaPeca> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MarcaPecasTable extends Table
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

        $this->setTable('marca_pecas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Pecas', [
            'foreignKey' => 'marca_peca_id',
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
