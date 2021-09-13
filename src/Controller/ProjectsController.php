<?php
declare(strict_types=1);

namespace App\Controller;


/**  ===================================================================================Comentario Darío ====================================================================
 * 
 * Implementación del AppController para Funciones Heredadas!
 * Implementación del Chronos para manejo de instancias de Fecha y tiempo!
 * Implementación del time para manejo de instancias de tiempo!
 * Implementación del ConnectionManager para manejo de conexiones a bases de datos!
 * 
*/
use Cake\Chronos\Chronos;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use App\Controller\AppController;

/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 * @method \App\Model\Entity\Project[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{
    
    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @beforeFilter(), controla los accesos públicos a las acciones del controlador.
     * 
    */

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @isAuthorized(), controla los accesos públicos a las acciones del controlador con base a los roles.
     * 
    */

     public function isAuthorized($user){
         //Set de Acciones para un administrador.
         if (isset($user['role'])and $user['role'] === 'admin'){
             if(in_array($this->request->getParam('action'),['index','add','view','edit','list' ,'iniciar', 'terminar', 'elapsedTime']))
             {
                 return true;
             }
         }
         //Set de Acciones para un usuario.
         if (isset($user['role'])and $user['role'] === 'usuario'){
            if(in_array($this->request->getParam('action'),['index','view', 'list' ,'iniciar', 'terminar', 'elapsedTime']))
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
        $activo = $this->Projects->Timelogs->activeLog($actual['id']);
        $registro = $this->Projects->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $this->paginate = [
            'contain' => ['Users'],
        ];
        $projects = $this->paginate($this->Projects);
        $this->set(compact('projects'));
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @list(), muestra los proyectos y permite la interacción con el usuario.
     * 
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function list()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Projects->Timelogs->activeLog($actual['id']);
        $registro = $this->Projects->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $this->paginate = [
            'contain' => ['Users'],
        ];
        $projects = $this->paginate($this->Projects);
        $this->set(compact('projects'));
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
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
        $activo = $this->Projects->Timelogs->activeLog($actual['id']);
        $registro = $this->Projects->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $project = $this->Projects->get($id, [
            'contain' => ['Users', 'Timelogs'],
        ]);

        $this->set(compact('project'));
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
        $activo = $this->Projects->Timelogs->activeLog($actual['id']);
        $registro = $this->Projects->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
        
        $project = $this->Projects->newEmptyEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());

            /**
             * Valida la carga correcta de las imágenes.
             */
            if(!$project->getErrors()){
                $image = $this->request->getData('image_file');
                $name = $image->getClientFilename();
                $targetPath = WWW_ROOT.'img'.DS.$name;
                if($name){
                    $image->moveTO($targetPath);
                }
                $project->image = $name;
            }

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('El proyecto ha sido registrado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Se ha producido un error, favor inténtelo nuevamente.'));
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
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
        $activo = $this->Projects->Timelogs->activeLog($actual['id']);
        $registro = $this->Projects->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $project = $this->Projects->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());


            /**
             * Valida la carga correcta de las imágenes.
             */
            if(!$project->getErrors()){
                $image = $this->request->getData('image_file');
                $name = $image->getClientFilename();
                if($name !==''){ //Valida que la imagen tenga un nombre válido.
                    $targetPath = WWW_ROOT.'img'.DS.$name;
                    if($name){
                        $image->moveTO($targetPath);
                    }
                    $project->image = $name;
                }
                else{
                    $project->image = $project->image;
                }
            }

            if ($this->Projects->save($project)) {
                $this->Flash->success(__('El proyecto ha sido actualizado exitosamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Se ha producido un error, favor inténtelo nuevamente.'));
        }
        $users = $this->Projects->Users->find('list', ['limit' => 200]);
        $this->set(compact('project', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->Flash->success(__('El proyecto ha sido eliminado exitosamente.'));
        } else {
            $this->Flash->error(__('Se ha producido un error, favor inténtelo nuevamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @iniciar(), permite que se cree un nuevo registro en la base de datos.
     * 
    */
    public function iniciar($id = null , $user = null)
    {
        $this->request->allowMethod(['post']);
        $project = $this->Projects->get($id);
        //Valida si existen sesiones activas para este usuario.
        $activo = $this->Projects->Timelogs->activeLog($user);
        if ($activo == 0 ){
            $inicio = Chronos::now();
            $timelog = $this->Projects->Timelogs->newEmptyEntity();
                //Se definen los campos de la entidad.
                $timelog->user_id = $user;
                $timelog->project_id = $id;
                $timelog->date = $inicio;
                $timelog->status = 1;
                $timelog->starttime = $inicio;
                if ($this->Projects->Timelogs->save($timelog)){ //Se intenta guardar la entidad creada.
                    $this->Flash->success(__('Se ha iniciado una sesión de trabajo en el proyecto: ' . $project->name .' correctamente.'));
                    return $this->redirect(['action' => 'list']);
                }else{
                    $this->Flash->error(__('Se ha producido un error y no se ha iniciado el proyecto.' ));
                    return $this->redirect(['action' => 'list']);
                }
        }else{
            $this->Flash->error(__('No se puede iniciar otra sesión, hasta que finalice la sesión actual.' ));
            return $this->redirect(['action' => 'list']); //Después de ejecutarse, retorna a la vista list.
        }
        $this->set(compact('project', 'users')); //entender bien lo que hace.
        return $this->redirect(['action' => 'list']); //Después de ejecutarse, retorna a la vista list.
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @terminar(), permite que se cree finalice el registro activo del usuario en la base de datos.
     * 
    */
    public function terminar($id = null, $userA = null, $cita = null)
    {
        $this->request->allowMethod(['post']); //Se valida que la solicitud sea de tipo post.
        $project = $this->Projects->get($id);
        $user = $this->Projects->Users->get($userA);
        $estado = $this->Projects->Timelogs->estado($cita);
        if ($estado == true)
        {
            $final =  Chronos::now(); //Se crea una instancia con la fecha y tiempo actual.
            $timelog = $this->Projects->Timelogs->get($cita);//Se crea una entidad de tipo Timelogs
                $timelog->status = 0;
                $timelog->endtime = $final;
    
            if ($this->Projects->Timelogs->save($timelog)){ //Se intenta guardar la entidad creada.
                $this->elapsedTime($cita);
                $this->costlog($cita, $user->salary);
                $this->Flash->success(__('Se ha finalizado el registro del proyecto: ' . $project->name .' correctamente.'));
                return $this->redirect(['action' => 'list']);
            }else{
                $this->Flash->error(__('Se ha producido un error y no se ha finalizado el proyecto.' ));
                return $this->redirect(['action' => 'list']);
            }
        }
        else
        {
            $this->Flash->error(__('El Registro indicado ya no se encuentra activo.' ));
        }
        $this->set(compact('project', 'users'));
        return $this->redirect(['action' => 'list']); //Después de ejecutarse, retorna a la vista Index.
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @elapsedTime(), invoca un procedimiento almacenado que calcula el tiempo transcurrido
     * 
    */
    public function elapsedTime($id)
    {
        $conexion = ConnectionManager::get('default');
        $conexion->execute("CALL ElapTime('".$id."');");
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @elapsedTime(), invoca un procedimiento almacenado que calcula el costo de la sesión.
     * 
    */
    public function costlog($id, $salary)
    {
        $conexion = ConnectionManager::get('default');
        $conexion->execute("CALL CostLog('".$id."','".$salary."');");
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @projectStatus(), permite cambiar el estado de un proyecto
     * 
    */
    public function projectStatus($id = null, $status = null)
    {
        $this->request->allowMethod(['post']);
        $project = $this->Projects->get($id);

        if ($status == 1) {
            $project->status = 0;
        } else {
            $project->status = 1;
        }

        if ($this->Projects->save($project)) {
            $this->Flash->success(__('Se ha realizado la actuliazación de estado correctamente.'));
        } else {
            $this->Flash->error(__('Se ha presentado un error, favor inténtelo nuevamente'));
        }
        return $this->redirect(['action' => 'index']);
    }
}