<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FrequenciaManutencaos Model
 *
 * @property \App\Model\Table\MetricasTable&\Cake\ORM\Association\BelongsTo $Metricas
 * @property \App\Model\Table\TipoVeiculosTable&\Cake\ORM\Association\BelongsTo $TipoVeiculos
 * @property \App\Model\Table\CategoriaPecasTable&\Cake\ORM\Association\BelongsTo $CategoriaPecas
 *
 * @method \App\Model\Entity\FrequenciaManutencao newEmptyEntity()
 * @method \App\Model\Entity\FrequenciaManutencao newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\FrequenciaManutencao> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FrequenciaManutencao get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\FrequenciaManutencao findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\FrequenciaManutencao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\FrequenciaManutencao> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\FrequenciaManutencao|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\FrequenciaManutencao saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\FrequenciaManutencao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FrequenciaManutencao>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FrequenciaManutencao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FrequenciaManutencao> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FrequenciaManutencao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FrequenciaManutencao>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\FrequenciaManutencao>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\FrequenciaManutencao> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FrequenciaManutencaosTable extends Table
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

        $this->setTable('frequencia_manutencaos');
        $this->setDisplayField('ativo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Metricas', [
            'foreignKey' => 'metrica_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TipoVeiculos', [
            'foreignKey' => 'tipo_veiculo_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('CategoriaPecas', [
            'foreignKey' => 'categoria_peca_id',
            'joinType' => 'INNER',
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
            ->integer('frequencia')
            ->requirePresence('frequencia', 'create')
            ->notEmptyString('frequencia');

        $validator
            ->scalar('ativo')
            ->maxLength('ativo', 1)
            ->notEmptyString('ativo');

        $validator
            ->integer('metrica_id')
            ->notEmptyString('metrica_id');

        $validator
            ->integer('tipo_veiculo_id')
            ->notEmptyString('tipo_veiculo_id');

        $validator
            ->integer('categoria_peca_id')
            ->notEmptyString('categoria_peca_id');

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
        $rules->add($rules->existsIn(['metrica_id'], 'Metricas'), ['errorField' => 'metrica_id']);
        $rules->add($rules->existsIn(['tipo_veiculo_id'], 'TipoVeiculos'), ['errorField' => 'tipo_veiculo_id']);
        $rules->add($rules->existsIn(['categoria_peca_id'], 'CategoriaPecas'), ['errorField' => 'categoria_peca_id']);

        return $rules;
    }
}
