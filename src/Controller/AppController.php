<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
//Comentario Darío ***********************************************************
//Autenticación de Usuarios Paso # 3. Ver Paso # 4 ↓ Abajo
/**
 * Se agregan las bibliotecas necesarias para el manejo de eventos.
*/
use Cake\Event\Event;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */


    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('ExportXls');
        //Comentario Darío ***********************************************************
        //Autenticación de Usuarios Paso # 4. Ver Paso # 5 ↓ Abajo
        /**
         * Se agrega el componente de autenticación de usuarios. * Este código está relaciodo con: 
         * Model → Entity → Users ||  Model → Table → Users ||  Controlador: UserController.
         * Template: Users → Login.
        */
        $this->loadComponent('Auth', [
            //Se define que la autorización la manejará el controlador, por default aurotización completa.
            'authorize' => ['Controller'],
            //La autenticación se dará a través de un formulario, con correo y contraseña
            'authenticate' => [
                        'Form' => [
                            'fields' => [
                                'username' => 'email',
                                'password' => 'password'
                            ],//Se pueden filtrar usuarios con una búsqueda en el model Users.
                            'finder' => 'auth'
                        ]  
                    ],
            'loginAction' => [            //El formulario se asocia con la acción Login.
                'controller' => 'Users',
                'action' => 'Login'
            ],
            'loginRedirect' => [        // Y redirige al Index de Usuarios.
                'controller' => 'Projects',
                'action' => 'List'
            ],
            'logoutRedirect' =>[        //Cuando se Cierra sesión se redirige al login.
                'controller' => 'Users',
                'action' => 'login'
            ],
            // Sentencia adicional, para redirigir a usuarios que no tienen autorización a una página.
            'unauthorizedRedirect' => $this -> referer()
            
        ]);

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        //Código escrito debajod el LoadComponent('Auth')
        //Comentario Darío ***********************************************************
        //Autenticación de Usuarios Paso # 5. Ver Paso # 6 ↓ Abajo
        //Validar que el usuario esté loqueado. Se coloca dentro del método initialize.
        if ($this->request->getSession()->read('Auth.User')){
            $this->set('logedIn', true);
        } else {
            $this->set('logedIn', false);
        }
    }

    //Comentario Darío ***********************************************************
    //Crear una variable current_user y la comparte con las vistas
    //Autenticación de Usuarios Paso # 6. Ver Paso # 7 ↓ Abajo
    public function beforeFilter(EventInterface $event)
    {
        //Comparte los datos de inicio con todas las páginas. Se implementa en el template - Default del Layout.
        $this->set('current_user', $this->Auth->user());
    }


    //Función que retorna el usuario actual, a diferencia del Set instanciado en la función beforeFilter, este valor se retorna a los otros controladores.
    public function user_Id(){
        return $this->Auth->user();
    }

    //* Código Darío. →→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→
    //Este método permite filtrar las páginas según cada rol. //Este método también debe implementarse en cada controlador.
    public function isAuthorized($user){
        //Se valida que el usuario sea administrador.
        if(isset($user['role']) and $user['role'] === 'superadmin'){
            return true;
        }
        return false;
    }
}
