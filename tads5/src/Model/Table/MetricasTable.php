<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Metricas Model
 *
 * @property \App\Model\Table\FrequenciaManutencaosTable&\Cake\ORM\Association\HasMany $FrequenciaManutencaos
 *
 * @method \App\Model\Entity\Metrica newEmptyEntity()
 * @method \App\Model\Entity\Metrica newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Metrica> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Metrica get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Metrica findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Metrica patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Metrica> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Metrica|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Metrica saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Metrica>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metrica>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Metrica>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metrica> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Metrica>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metrica>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Metrica>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Metrica> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MetricasTable extends Table
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

        $this->setTable('metricas');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('FrequenciaManutencaos', [
            'foreignKey' => 'metrica_id',
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
            ->scalar('codigo')
            ->maxLength('codigo', 24)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo')
            ->add('codigo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 48)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->scalar('ativo')
            ->maxLength('ativo', 1)
            ->notEmptyString('ativo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['codigo']), ['errorField' => 'codigo']);

        return $rules;
    }
}
