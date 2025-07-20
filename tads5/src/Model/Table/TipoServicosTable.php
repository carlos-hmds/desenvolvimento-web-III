<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoServicos Model
 *
 * @property \App\Model\Table\FornecedorsTable&\Cake\ORM\Association\HasMany $Fornecedors
 *
 * @method \App\Model\Entity\TipoServico newEmptyEntity()
 * @method \App\Model\Entity\TipoServico newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TipoServico> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoServico get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TipoServico findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TipoServico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TipoServico> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoServico|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TipoServico saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TipoServico>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoServico>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoServico>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoServico> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoServico>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoServico>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TipoServico>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TipoServico> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TipoServicosTable extends Table
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

        $this->setTable('tipo_servicos');
        $this->setDisplayField('tipo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fornecedors', [
            'foreignKey' => 'tipo_servico_id',
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
            ->scalar('tipo')
            ->maxLength('tipo', 120)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->scalar('ativo')
            ->maxLength('ativo', 1)
            ->notEmptyString('ativo');

        return $validator;
    }
}
