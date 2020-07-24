<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gate Entity.
 */
class Sales extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'ticket_type' => true,
        'description' => true,
        'max_capacity' => true,
        'gate_area_id' => true,
    ];
}
