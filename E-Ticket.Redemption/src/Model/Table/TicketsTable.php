<?php
namespace App\Model\Table;

use App\Model\Entity\Ticket;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tickets Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TicketTypes
 * @property \Cake\ORM\Association\BelongsTo $GateAreas
 * @property \Cake\ORM\Association\BelongsTo $Events
 */
class TicketsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('tickets');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('tickettypes', [
            'foreignKey' => 'ticket_type_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('gateareas', [
            'foreignKey' => 'gate_area_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Events', [
            'foreignKey' => 'event_id',
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
            ->requirePresence('registered_buyer', 'create')
            ->notEmpty('registered_buyer');
            $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->requirePresence('qty', 'create')
            ->notEmpty('qty');

        $validator
            ->requirePresence('ticket_number', 'create')
            ->notEmpty('ticket_number');
            
        $validator
            ->add('event_start', 'valid', ['rule' => 'date'])
            ->requirePresence('event_start', 'create')
            ->notEmpty('event_start');
            
        $validator
            ->add('event_end', 'valid', ['rule' => 'date'])
            ->requirePresence('event_end', 'create')
            ->notEmpty('event_end');

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
        $rules->add($rules->existsIn(['ticket_type_id'], 'tickettypes'));
        $rules->add($rules->existsIn(['gate_area_id'], 'gateareas'));
        $rules->add($rules->existsIn(['event_id'], 'Events'));
        return $rules;
    }
}
