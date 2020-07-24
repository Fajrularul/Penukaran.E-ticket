<?php
namespace App\Model\Table;

use App\Model\Entity\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \Cake\ORM\Association\HasMany $Tickets
 */
class EventsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('events');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->hasMany('Tickets', [
            'foreignKey' => 'event_id'
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

        return $validator;
    }
}
