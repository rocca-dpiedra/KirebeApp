<?php
declare(strict_types=1);

namespace App\Controller;

/**  ===================================================================================Comentario Darío ====================================================================
 * 
 * Implementación del AppController para Funciones Heredadas!
 * 
*/
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @beforeFilter(), controla los accesos públicos a las acciones del controlador.
     * Únicamente se permite el acceso a la funcionalidad LogOut
     * 
    */
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @isAuthorized(), controla los accesos públicos a las acciones del controlador con base a los roles.
     * 
    */

     public function isAuthorized($user){
         if (isset($user['role'])and $user['role'] === 'admin'){
             if(in_array($this->request->getParam('action'),['index','add','view','edit', 'miperfil']))
             {
                 return true;
             }
         }

         if (isset($user['role'])and $user['role'] === 'usuario'){
            if(in_array($this->request->getParam('action'),['miperfil']))
            {
                return true;
            }
        }

         return parent::isAuthorized($user);
     }
    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Users->Timelogs->activeLog($actual['id']);
        $registro = $this->Users->Timelogs->registro($actual['id']);

        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
        $consulta = $this->Users->nosuperAdm();

        if($actual['role'] == 'admin'){
            $users = $this->paginate($consulta);
        }else{
            $users = $this->paginate($this->Users);
        }
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Users->Timelogs->activeLog($actual['id']);
        $registro = $this->Users->Timelogs->registro($actual['id']);

        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $supervisor = $this->paginate($this->Users);

        $user = $this->Users->get($id, [
            'contain' => ['Users', 'Projects', 'Timelogs'],
        ]);

        $this->set(compact('user', 'supervisor'));
    }

    /**
     * miPerfil method
     * 
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function miperfil()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Users->Timelogs->activeLog($actual['id']);
        $registro = $this->Users->Timelogs->registro($actual['id']);

        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $supervisor = $this->paginate($this->Users);

        $user = $this->Users->get($actual['id'], [
            'contain' => ['Users', 'Projects', 'Timelogs'],
        ]);
        $this->set(compact('user', 'supervisor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Users->Timelogs->activeLog($actual['id']);
        $registro = $this->Users->Timelogs->registro($actual['id']);

        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $users = $this->Users->find('list', ['limit' => 200]);

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido registrado exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Se ha producido un error, favor intentarlo nuevamente.'));
        }
        $this->set(compact('user', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Users->Timelogs->activeLog($actual['id']);
        $registro = $this->Users->Timelogs->registro($actual['id']);

        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $users = $this->Users->find('list', ['limit' => 200]);
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario ha sido actualizado exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Se ha producido un error, favor intentarlo nuevamente.'));
        }
        $this->set(compact('user', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado exitosamente.'));
        } else {
            $this->Flash->error(__('Se ha producido un error, favor intentarlo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @login(), muestra una pantalla de inicio de sesión para los usuarios.
     * Realiza las validaciones correspondientes.
     * 
    */
      public function login(){

        if ($this->request->is('post')) {      //Valida que la solicitud del form sea de tipo POST.
            //Se valida que los datos del usuario coincidan con un usuario real.
            $user = $this->Auth->identify();
            if($user) { //Permite inicio de sesión.
                $this->Auth->setUser($user); 
                $this->Flash->success(__('Inicio de sesión Exitoso.'));
                //Se redirige al usuario, la ruta por defecto se define en /Config→Routes.php
                return $this->redirect($this->Auth->redirectUrl());
            } else {//Se muestra un error en pantalla.
                $this->Flash->error(__('Los datos ingresados son incorrectos.'), ['key' => 'auth']);
            }
        }
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @login(), realiza un cierre de sesión.
     * 
    */
    public function logout(){
        $this->Flash->success(__('Se ha cerrado sesión correctamente.'));
        return $this->redirect($this->Auth->logout());
    }
}
