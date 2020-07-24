<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity.
 */
class Ticket extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'ticket_number' => true,
        'ticket_type_id' => true,
        'gate_area_id' => true,
        'registered_buyer' => true,
        'last_name' =>true,
        'qty' => true, 
        'status' => true,
        'scanned_date_time' => true,
        'event_id' => true,
        'event_start' => true,
        'event_end' => true,
        'event' => true,
    ];
}
