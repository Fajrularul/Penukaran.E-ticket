<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity.
 */
class Event extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'event_code' => true,
        'event_name' => true,
        'event_year' => true,
        'event_month' => true,
        'tickets' => true,
    ];
}
