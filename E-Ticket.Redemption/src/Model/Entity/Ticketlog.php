<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticketlog Entity.
 */
class Ticketlog extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'ticket_number' => true,
        'event_code' => true,
        'event_name' => true,
        'event_year' => true,
        'event_month' => true,
        'ticket_type' => true,
        'gate_area' => true,
        'gate_number' => true,
        'registered_buyer' => true,
        'qty' => true,
        'event_start' => true,
        'event_end' => true,
        'status' => true,
        'scanned_date_time' => true,
        'last_scanned' => true,
    ];
}
