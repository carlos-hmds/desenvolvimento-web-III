<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoVeiculos Model
 *
 * @property \App\Model\Table\FrequenciaManutencaosTable&\Cake\ORM\Association\HasMany $FrequenciaManutencaos
 * @property \App\Model\Table\VeiculosTable&\Cake\ORM\Association\HasMany $Veiculos
 *
 * @method \App\Model\Entity\TipoVeiculo newEmptyEntity()
 * @method \App\Model\Entity\TipoVeiculo newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TipoVeiculo> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TipoVeiculo findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TipoVeiculo> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TipoVeiculo saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TipoVeiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoVeiculo>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoVeiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoVeiculo> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoVeiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoVeiculo>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoVeiculo>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoVeiculo> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TipoVeiculosTable extends Table
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

        $this->setTable('tipo_veiculos');
        $this->setDisplayField('descricao');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('FrequenciaManutencaos', [
            'foreignKey' => 'tipo_veiculo_id',
        ]);
        $this->hasMany('Veiculos', [
            'foreignKey' => 'tipo_veiculo_id',
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
            ->scalar('descricao')
            ->maxLength('descricao', 100)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->scalar('ativo')
            ->maxLength('ativo', 1)
            ->notEmptyString('ativo');

        return $validator;
    }
}
