<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gate Entity.
 */
class Gate extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'gate_number' => true,
        'description' => true,
        'max_capacity' => true,
        'gate_area_id' => true,
    ];
}
