<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Gatearea Entity.
 */
class Gatearea extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'gate_area' => true,
        'description' => true,
    ];
}
