<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timelog Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property \Cake\I18n\FrozenTime $date
 * @property bool $status
 * @property \Cake\I18n\Time $starttime
 * @property \Cake\I18n\Time|null $endtime
 * @property \Cake\I18n\Time|null $elapsedtime
 * @property string|null $cost
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Project $project
 */
class Timelog extends Entity
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
        'user_id' => true,
        'project_id' => true,
        'date' => true,
        'status' => true,
        'starttime' => true,
        'endtime' => true,
        'elapsedtime' => true,
        'cost' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'project' => true,
    ];
}
