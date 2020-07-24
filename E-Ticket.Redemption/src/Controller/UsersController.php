<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login', 'logout']);
    }

     public function index()
     {
        $this->paginate = [
            'contain' => ['Gates']
        ];
        $query = $this->Users->find()->where(['role <> ' => 'admin']);
        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
        $this->Roles = TableRegistry::get('Roles');
        $rolesQuery = $this->Roles->find();
        $roles = array();
        foreach ($rolesQuery as $role) 
        {
            $roles[$role->role] = ucfirst($role->role);
        }

        $this->Gates = TableRegistry::get('Gates');
        $gQuery = $this->Gates->find()->where('id <> 99999999');
        $gates = array();
        $gates[99999999] = 'Choose Gate Number';
        foreach ($gQuery as $g) 
        {
            $gates[$g->id] = $g->gate_number;
        }

        $this->set('gates', $gates);
        $this->set('roles', $roles);
    }

    public function login()
    {
        $session = $this->request->session();
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $session->write("loggedUser", $user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        else
        {
            if(!empty($session->read("loggedUser")))
            {
                return $this->redirect("/dashboard");
            }
        }
    }

    public function logout()
    {
        $session = $this->request->session();
        $session->delete("loggedUser");
        return $this->redirect($this->Auth->logout());
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user password has been changed.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user password could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}