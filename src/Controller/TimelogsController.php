<?php
declare(strict_types=1);

namespace App\Controller;

/**  ===================================================================================Comentario Darío ====================================================================
 * 
 * Implementación del ConnectionManager para Manejo en base datos!
 * 
*/
use Cake\Chronos\Chronos;
use Cake\Datasource\ConnectionManager;


/**
 * Timelogs Controller
 *
 * @property \App\Model\Table\TimelogsTable $Timelogs
 * @method \App\Model\Entity\Timelog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimelogsController extends AppController
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
         if (isset($user['role'])and $user['role'] === 'admin'){
             if(in_array($this->request->getParam('action'),['repcustom','personalizado','projectres','userres','projectdetail','activelist', 'epr','eur', 'erd','eal','erc']))
             {
                 return true;
             }
         }
        //  if (isset($user['role'])and $user['role'] === 'usuario'){
        //     if(in_array($this->request->getParam('action'),[]))
        //     {
        //         return true;
        //     }
        // }
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
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $this->paginate = [
            'contain' => ['Users', 'Projects'],
        ];

        $timelogs = $this->paginate($this->Timelogs);
        $projects = $this->Timelogs->Projects->find('list', ['limit' => 200]);
        $users = $this->Timelogs->Users->find('list', ['limit' => 200]);

        $this->set(compact('timelogs', 'projects','users'));
    }

    /**
     * View method
     *
     * @param string|null $id Timelog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $timelog = $this->Timelogs->get($id, [
            'contain' => ['Users', 'Projects'],
        ]);

        $this->set(compact('timelog'));
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
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $timelog = $this->Timelogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $timelog = $this->Timelogs->patchEntity($timelog, $this->request->getData());
            if ($this->Timelogs->save($timelog)) {
                $this->Flash->success(__('The timelog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timelog could not be saved. Please, try again.'));
        }
        $users = $this->Timelogs->Users->find('list', ['limit' => 200]);
        $projects = $this->Timelogs->Projects->find('list', ['limit' => 200]);
        $this->set(compact('timelog', 'users', 'projects'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Timelog id.
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
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        $timelog = $this->Timelogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $timelog = $this->Timelogs->patchEntity($timelog, $this->request->getData());
            if ($this->Timelogs->save($timelog)) {
                $this->Flash->success(__('The timelog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The timelog could not be saved. Please, try again.'));
        }
        $users = $this->Timelogs->Users->find('list', ['limit' => 200]);
        $projects = $this->Timelogs->Projects->find('list', ['limit' => 200]);
        $this->set(compact('timelog', 'users', 'projects'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Timelog id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $timelog = $this->Timelogs->get($id);
        if ($this->Timelogs->delete($timelog)) {
            $this->Flash->success(__('The timelog has been deleted.'));
        } else {
            $this->Flash->error(__('The timelog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @repindex(), muestra la lista de reportes que puede generar el usuario.
     * 
    */
    public function repindex()
    {

        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @repCustom(), formulario que permite establecer los filtros requeridos para el reporte personalizado
     * 
    */
    public function repcustom()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        /* Obtiene la información de los campos del formulario */
        $projs =  $this->request->getData('projects');
        $us = $this->request->getData('users');
        $st = $this->request->getData('start');
        $end = $this->request->getData('end');

        /*Cuando recibe todos los campos, envía la información al reporte*/
        if($projs and $us and $st and $end)
        {
            $_projs = implode(",",$projs);
            $_us = implode(",",$us);
            $this->redirect(['controller' => 'Timelogs', 'action' => 'personalizado', $_projs, $_us, $st, $end]);
        }
        else
        {
            $this->Flash->error(__('Para continuar complete todos los campos de filtro.'));
        }
        $projects = $this->Timelogs->Projects->find('list', ['limit' => 200]);
        $users = $this->Timelogs->Users->find('list', ['limit' => 200]);
        $this->set(compact('projects','users'));
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @personalizado(), muestra el reporte en pantalla, con base a los parámetros definidos en el repcustom.
     * 
    */
   public function personalizado( $_projs, $_us, $st, $end)
   {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }

        /*
        $_projs = implode(",",$projs);
        $_us = implode(",",$us);
        */

        $projs = explode(",",$_projs);
        $us = explode(",",$_us);
        
        /*Define los filtros de la búsqueda*/
        $query = $this->Timelogs->personalizado()
            ->where(
                ['Timelogs.project_id IN'  => $projs, 
                'Timelogs.user_id IN' => $us, 
                'Timelogs.date >=' => $st,
                'Timelogs.date <=' => $end,
                /*Solo Muestra registros finalziados*/
                'Timelogs.status' => 0
            ]);

       $timelogs = $this->paginate($query);

       $this->set(compact('timelogs', '_projs', '_us', 'st', 'end'));
   }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @projectRes(), muestra el reporte en pantalla, correspondiente al resumen de los proyectos con sesiones cerradas.
     * 
    */
    public function projectres()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
        /*Define los parámetros */
        $init = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');
        if($init and $end){
            $this->set('mostrar', true);
            /*Define los filtros de la búsqueda */
            $consulta = $this->Timelogs->projectRes()
            ->where(
                [
                'Timelogs.date >=' => $init,
                'Timelogs.date <=' => $end,
                'Timelogs.status' => 0
                ]
            );
            $this->paginate = [
                'contain' => ['Projects'],
            ];
            $timelogs = $this->paginate($consulta);
            $this->set(compact('timelogs', 'init', 'end'));

        }else{
            $this->set('mostrar', false);
            $this->Flash->error(__('Por favor seleccione un rango de fechas para continuar'));
        }
    }


    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @userRes(), muestra el reporte en pantalla, correspondiente al resumen de los usuarios con sesiones cerradas.
     * 
    */
    public function userres()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
        /*Define los parámetros */
        $init = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');
        if($init and $end){
            $this->set('mostrar', true);
            /*Define los filtros de la búsqueda */
            $consulta = $this->Timelogs->userRes()
            ->where(
                [
                'Timelogs.date >' => $init,
                'Timelogs.date <' => $end,
                'Timelogs.status' => 0
            ]);
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $timelogs = $this->paginate($consulta);
            $this->set(compact('timelogs' ,'init', 'end'));
        }else{
            $this->set('mostrar', false);
            $this->Flash->error(__('Por favor seleccione un rango de fechas para continuar'));
        }
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @projectdetail(), muestra el reporte en pantalla, correspondiente a la lista de sesiones terminadas en un rango de fechas.
     * 
    */
    public function projectdetail()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
        /*Define los parámetros */
        $init = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');
        if($init and $end){
            $this->set('mostrar', true);
            /*Define los filtros de la búsqueda */
            $consulta = $this->Timelogs->reportDetail()
            ->where(
                [
                'Timelogs.date >' => $init,
                'Timelogs.date <' => $end,
                'Timelogs.status' => 0
            ]);
            $this->paginate = [
                'contain' => ['Users','Projects'],
            ];

            $timelogs = $this->paginate($consulta);
            $this->set(compact('timelogs' ,'init', 'end'));
        }else{
            $this->set('mostrar', false);
            $this->Flash->error(__('Por favor seleccione un rango de fechas para continuar'));
        }
    }

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @activeList(), muestra el reporte en pantalla, correspondiente a la lista de sesiones activas
     * 
    */
    public function activelist()
    {
        /**  ===================================================================================Comentario Darío ====================================================================
         * 
         * Código para identificar si existen sesiones activas.
         * 
        */
        $actual = parent::user_Id();
        $activo = $this->Timelogs->activeLog($actual['id']);
        $registro = $this->Timelogs->registro($actual['id']);
        if ($activo == 0){
            $this->set('activo', false);
        }else{
            $this->set('activo', true);
            $this->set('registro', $registro);
        }
        /*Define los parámetros */
        $consulta = $this->Timelogs->activeList();

        $timelogs = $this->paginate($consulta);
        $this->set(compact('timelogs'));
    }
    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Funciones centradas en exportar contenido
     * 
     * */

    /**  ===================================================================================Comentario Darío ====================================================================
     * 
     * Función @activeList(), muestra el reporte en pantalla, correspondiente a la lista de sesiones activas
     * 
    */

    public function epr($init, $end){
        //Deshabilita la carga del template automático
        $this->viewBuilder()->disableAutoLayout();

        //Obtiene el usuario Actual.
        $actual = parent::user_Id();
        //Obtiene la hora en la que se generó el reporte.
        $hora = Chronos::now();

        //Obtiene la información desde BD.
        $consulta = $this->Timelogs->projectRes()
        ->where(
            [
            'Timelogs.date >' => $init,
            'Timelogs.date <' => $end,
            'Timelogs.status' => 0
        ]);

        $docu="resumenProyectos.xls";
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$docu);
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1>';
        echo '<tr>';
        echo '<th colspan=6> Resumen de Proyectos</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=3> Generado por: '.$actual['fullname'].'</th>';
        echo '<th colspan=3> Generado a las: '.$hora.'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=3> Fecha Inicio: '.$init. '</th>';
        echo '<th colspan=3> Fecha Final: '.$end. '</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>NOMBRE</th>';
        echo '<th>CANT SESIONES</th>';
        echo '<th>PRIMERA SESIÓN</th>';
        echo '<th>ULTIMA SESIÓN</th>';
        echo '<th>TIEMPO HH:MM:SS</th>';
        echo '<th>COSTO TOTAL</th>';
        echo '</tr>';
        foreach($consulta as $c){
            echo '<tr>';
            echo '<td>'.$c['nombre'].'</td>';
            echo '<td>'.$c['sesiones'].'</td>';
            echo '<td>'.$c['init'].'</td>';
            echo '<td>'.$c['end'].'</td>';
            echo '<td>'.$c['total'].'</td>';
            echo '<td>'.$c['monto'].'</td>';
            echo'</tr>';
        }
        echo '</table>';
    }

    public function eur($init, $end){
        //Deshabilita la carga del template automático
        $this->viewBuilder()->disableAutoLayout();

        //Obtiene el usuario Actual.
        $actual = parent::user_Id();
        //Obtiene la hora en la que se generó el reporte.
        $hora = Chronos::now();

        //Obtiene la información desde BD.
        $consulta = $this->Timelogs->userRes()
        ->where(
            [
            'Timelogs.date >' => $init,
            'Timelogs.date <' => $end,
            'Timelogs.status' => 0
        ]);

        $docu="resumenUsuarios.xls";
        header('Content-type: application/vnd.ms-excel; charset=iso-8859-1');
        header('Content-Disposition: attachment; filename='.$docu);
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1>';
        echo '<tr>';
        echo '<th colspan=6> Resumen de Usuarios</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=3> Generado por: '.$actual['fullname'].'</th>';
        echo '<th colspan=3> Generado a las: '.$hora.'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=3> Fecha Inicio: '.$init. '</th>';
        echo '<th colspan=3> Fecha Final: '.$end. '</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>NOMBRE</th>';
        echo '<th>CANT SESIONES</th>';
        echo '<th>PRIMERA SESIÓN</th>';
        echo '<th>ULTIMA SESIÓN</th>';
        echo '<th>TIEMPO HH:MM:SS</th>';
        echo '<th>COSTO TOTAL</th>';
        echo '</tr>';
        foreach($consulta as $c){
            echo '<tr>';
            echo '<td>'.$c['nombre'].'</td>';
            echo '<td>'.$c['sesiones'].'</td>';
            echo '<td>'.$c['init'].'</td>';
            echo '<td>'.$c['end'].'</td>';
            echo '<td>'.$c['total'].'</td>';
            echo '<td>'.$c['monto'].'</td>';
            echo'</tr>';
        }
        echo '</table>';
    }

    public function erd($init, $end){
        //Deshabilita la carga del template automático
        $this->viewBuilder()->disableAutoLayout();

        //Obtiene el usuario Actual.
        $actual = parent::user_Id();
        //Obtiene la hora en la que se generó el reporte.
        $hora = Chronos::now();

        //Obtiene la información desde BD.
        $consulta = $this->Timelogs->reportDetail()
        ->where(
            [
            'Timelogs.date >' => $init,
            'Timelogs.date <' => $end,
            'Timelogs.status' => 0
        ]);

        $docu="detalleSesiones.xls";
        header('Content-type: application/vnd.ms-excel; charset=iso-8859-1');
        header('Content-Disposition: attachment; filename='.$docu);
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1>';
        echo '<tr>';
        echo '<th colspan=10> Detalle de Sesiones</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=5> Generado por: '.$actual['fullname'].'</th>';
        echo '<th colspan=5> Generado a las: '.$hora.'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=5> Fecha Inicio: '.$init. '</th>';
        echo '<th colspan=5> Fecha Final: '.$end. '</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>ID USUARIO</th>';
        echo '<th>USUARIO</th>';
        echo '<th>ID PROYECTO</th>';
        echo '<th>PROYECTO</th>';
        echo '<th>FECHA</th>';
        echo '<th>HORA INICIO</th>';
        echo '<th>HORA TERMINA</th>';
        echo '<th>DURACIÓN</th>';
        echo '<th>COSTO</th>';
        echo '</tr>';
        foreach($consulta as $c){
            echo '<tr>';
            echo '<td>'.$c['id'].'</td>';
            echo '<td>'.$c['user_id'].'</td>';
            echo '<td>'.$c['usuario'].'</td>';
            echo '<td>'.$c['project_id'].'</td>';
            echo '<td>'.$c['proyecto'].'</td>';
            echo '<td>'.$c['date'].'</td>';
            echo '<td>'.$c['inicia'].'</td>';
            echo '<td>'.$c['termina'].'</td>';
            echo '<td>'.$c['time'].'</td>';
            echo '<td>'.$c['monto'].'</td>';
            echo'</tr>';
        }
        echo '</table>';
        // echo'<p>'.$consulta.'</p>';
    }

    public function eal(){
        //Deshabilita la carga del template automático
        $this->viewBuilder()->disableAutoLayout();

        //Obtiene el usuario Actual.
        $actual = parent::user_Id();
        //Obtiene la hora en la que se generó el reporte.
        $hora = Chronos::now();

        //Obtiene la información desde BD.
        $consulta = $this->Timelogs->activeList();    

        $docu="sesionesActivas.xls";
        header('Content-type: application/vnd.ms-excel; charset=iso-8859-1');
        header('Content-Disposition: attachment; filename='.$docu);
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1>';
        echo '<tr>';
        echo '<th colspan=5> Sesiones Activas</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=3> Generado por: '.$actual['fullname'].'</th>';
        echo '<th colspan=2> Generado a las: '.$hora.'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>USUARIO</th>';
        echo '<th>PROYECTO</th>';
        echo '<th>FECHA</th>';
        echo '<th>HORA INICIO</th>';
        echo '</tr>';
        foreach($consulta as $c){
            echo '<tr>';
            echo '<td>'.$c['id'].'</td>';
            echo '<td>'.$c['usuario'].'</td>';
            echo '<td>'.$c['proyecto'].'</td>';
            echo '<td>'.$c['date']->format('d-m-Y)').'</td>';
            echo '<td>'.$c['inicia'].'</td>';
            echo'</tr>';
        }
        echo '</table>';
        // echo'<p>'.$consulta.'</p>';
    }

    public function ecr($_projs, $_us, $st, $end){

        // /* Obtiene la información de los campos del formulario */
        $projs = explode(",",$_projs);
        $us = explode(",",$_us);

        //Deshabilita la carga del template automático
        $this->viewBuilder()->disableAutoLayout();

        //Obtiene el usuario Actual.
        $actual = parent::user_Id();

        //Obtiene la información desde BD.
        $consulta = $this->Timelogs->personalizado()
            ->where(
                ['Timelogs.project_id IN'  => $projs, 
                'Timelogs.user_id IN' => $us, 
                'Timelogs.date >=' => $st,
                'Timelogs.date <=' => $end,
                /*Solo Muestra registros finalziados*/
                'Timelogs.status' => 0
            ]);

        $docu="reportePersonalizado.xls";
        header('Content-type: application/vnd.ms-excel; charset=iso-8859-1');
        header('Content-Disposition: attachment; filename='.$docu);
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1>';
        echo '<tr>';
        echo '<th colspan=8> Reporte Personalizado</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=4> Generado por: '.$actual['fullname'].'</th>';
        echo '<th colspan=4> Generado a las: '.$hora.'</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th colspan=4> Fecha Inicio: '.$st. '</th>';
        echo '<th colspan=4> Fecha Final: '.$end. '</th>';
        echo '</tr>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>USUARIO</th>';
        echo '<th>PROYECTO</th>';
        echo '<th>FECHA</th>';
        echo '<th>HORA INICIO</th>';
        echo '<th>HORA TERMINA</th>';
        echo '<th>DURACIÓN</th>';
        echo '<th>COSTO</th>';
        echo '</tr>';
        foreach($consulta as $c){
            echo '<tr>';
            echo '<td>'.$c['id'].'</td>';
            echo '<td>'.$c['usuario'].'</td>';
            echo '<td>'.$c['proyecto'].'</td>';
            echo '<td>'.$c['date'].'</td>';
            echo '<td>'.$c['inicia'].'</td>';
            echo '<td>'.$c['termina'].'</td>';
            echo '<td>'.$c['time'].'</td>';
            echo '<td>'.$c['monto'].'</td>';
            echo'</tr>';
        }
        echo '</table>';
        // echo'<p>'.$consulta.'</p>';
    }
}