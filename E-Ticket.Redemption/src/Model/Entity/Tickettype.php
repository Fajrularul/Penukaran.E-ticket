<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tickettype Entity.
 */
class Tickettype extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'type' => true,
        'description' => true,
    ];
}
