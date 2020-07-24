<?php
namespace App\Model\Table;

use App\Model\Entity\Sales;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Gates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $GateAreas
 */
class SalesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('sales');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('tickettypes', [
            'foreignKey' => 'gate_area_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->requirePresence('gate_number', 'create')
            ->notEmpty('gate_number');
            
        $validator
            ->allowEmpty('description');
            
        $validator
            ->add('max_capacity', 'valid', ['rule' => 'numeric'])
            ->requirePresence('max_capacity', 'create')
            ->notEmpty('max_capacity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['gate_area_id'], 'GateAreas'));
        return $rules;
    }
}
