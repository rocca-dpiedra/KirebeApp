<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

//Comentario Darío *********************************************************** 
//Autenticación de Usuarios Paso # 1. Ver Paso # 2 ↓ Abajo.
/**
 * Se agrega la biblioteca requerida para realizar la encriptación del password.
 * Este código está relaciodo con: 
 * Controlador: AppController
 * Controlador: UserController.
 * Template: Users → Login.
*/
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $identity
 * @property string $fullname
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $department
 * @property int $user_id
 * @property string $salary
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User[] $users
 * @property \App\Model\Entity\Project[] $projects
 * @property \App\Model\Entity\Timelog[] $timelogs
 */
class User extends Entity
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
        'identity' => true,
        'fullname' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'department' => true,
        'user_id' => true,
        'salary' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'users' => true,
        'projects' => true,
        'timelogs' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    //Comentario Darío ***********************************************************. 
    //Autenticación de Usuarios Paso # 2. Ver Paso # 3 en SRC → Controller → APPController.
    /**
     * Se agrega la biblioteca requerida para realizar la encriptación del password.
     * Este código está relaciodo con: 
     * Controlador: AppController 
     * Controlador: UserController.
     * Template: Users → Login.
    */
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }

}
