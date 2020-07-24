<?php
namespace App\Model\Table;

use App\Model\Entity\Ticketlog;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ticketlogs Model
 *
 */
class TicketlogsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('ticketlogs');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->requirePresence('ticket_number', 'create')
            ->notEmpty('ticket_number');
            
        $validator
            ->requirePresence('event_code', 'create')
            ->notEmpty('event_code');
            
        $validator
            ->requirePresence('event_name', 'create')
            ->notEmpty('event_name');
            
        $validator
            ->requirePresence('event_year', 'create')
            ->notEmpty('event_year');
            
        $validator
            ->requirePresence('event_month', 'create')
            ->notEmpty('event_month');
            
        $validator
            ->requirePresence('ticket_type', 'create')
            ->notEmpty('ticket_type');
            
        $validator
            ->requirePresence('gate_area', 'create')
            ->notEmpty('gate_area');
            
        $validator
            ->allowEmpty('gate_number');
            
        $validator
            ->allowEmpty('registered_buyer');

         $validator
            ->allowEmpty('qty');
            
        $validator
            ->add('event_start', 'valid', ['rule' => 'datetime'])
            ->requirePresence('event_start', 'create')
            ->notEmpty('event_start');
            
        $validator
            ->add('event_end', 'valid', ['rule' => 'datetime'])
            ->requirePresence('event_end', 'create')
            ->notEmpty('event_end');
            
        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');
            
        $validator
            ->add('scanned_date_time', 'valid', ['rule' => 'datetime'])
            ->requirePresence('scanned_date_time', 'create')
            ->notEmpty('scanned_date_time');
            
        $validator
            ->add('last_scanned', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('last_scanned');

        return $validator;
    }
}
