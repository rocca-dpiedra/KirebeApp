<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Timelogs Controller
 *
 * @property \App\Model\Table\TimelogsTable $Timelogs
 * @method \App\Model\Entity\Timelog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TimelogsController extends AppController
{

    /**
     * Lo que se defina en la función beforeFilter, es contenido que no será sujeto a la validación de un rol autorizado.
     * Por esta razón la función Logout se lista en esta función, ya que debe ser accesible para todos los uaurios.
     */
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * Lo que se define en la función isAuthorized, es el control lógico del acceso a las rutas por parte de los usuarios,
     * basado en el rol de cada uno de los usuarios.
     */

     public function isAuthorized($user){
         if (isset($user['role'])and $user['role'] === 'admin'){
             if(in_array($this->request->getParam('action'),['index','add','view','edit']))
             {
                 return true;
             }
         }

         if (isset($user['role'])and $user['role'] === 'usuario'){
            if(in_array($this->request->getParam('action'),['index','view']))
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
        $projs =  $this->request->getData('projects');
        $us = $this->request->getData('users');
        if($projs and $us)
        {
            $query = $this->Timelogs->find('all')->where(['Timelogs.project_id IN'  => $projs, 'Timelogs.user_id IN' => $us ]);
        }
        else
        {
            $query = $this->Timelogs;
        }
        $this->paginate = [
            'contain' => ['Users', 'Projects'],
        ];
        $timelogs = $this->paginate($query);
        $projects = $this->Timelogs->Projects->find('list', ['limit' => 200]);
        $users = $this->Timelogs->Users->find('list', ['limit' => 200]);
        $this->set(compact('timelogs', 'projects','users'));
    }

    public function ejemplo()
    {
        $projs =  $this->request->getData('projects');
        $us = $this->request->getData('users');

        $key = $this->request->getQuery('key');
        if ($key) {
        $query = $this->Timelogs->$us->findByProject_idOrUser_id($key, $key);
        } else {
        $query = $this->Timelogs;
        }
        
        $users = $this->paginate($query);
        $this->set(compact('users'));
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

        
    /**
     * RepOne method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function repOne()
    {
        $ids = $this->request->getData('ids');
        if($ids)
        {
            $query = $this->Timelogs->find('all')->where(['Timelogs.user_id IN'  => $ids ]);
        }
        else
        {
            $query = $this->Timelogs;
        }


        $this->paginate = [
            'contain' => ['Users', 'Projects'],
        ];

        
        $timelogs = $this->paginate($query);
        $users = $this->Timelogs->Users->find('all');
        $projects = $this->Timelogs->Projects->find('all');
        $this->set(compact('timelogs', 'projects', 'users'));
    }

    public function findRepOne()
    {
        $ids = $this->request->getData('ids');
        if($ids)
        {
            $query = $this->Timelogs->find('all')->where(['user_id IN'  => $ids ]);
        }
        else
        {
            $query = $this->Timelogs;
        }
        exit("Hello");
    }

}
