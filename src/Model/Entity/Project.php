<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property string $department
 * @property int $user_id
 * @property string $subsidiary
 * @property string $price
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Timelog[] $timelogs
 */
class Project extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'description' => true,
        'image' => true,
        'department' => true,
        'user_id' => true,
        'subsidiary' => true,
        'price' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'timelogs' => true,
    ];
}
