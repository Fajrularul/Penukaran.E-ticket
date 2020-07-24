<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class UsersalesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['login', 'logout']);
    }

     public function index()
     {
        $this->paginate = [
            'contain' => ['Gates']
        ];
        $query = $this->Usersales->find()->where(['rule <> ' => 'god']);
        $this->set('usersales', $this->paginate($query));
        $this->set('_serialize', ['usersales']);
    }

    public function view($id)
    {
        $user = $this->Userssales->get($id);
        $this->set(compact('usersales'));
    }

    public function add()
    {
        $user = $this->Usersales->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Userssales->patchEntity($usersales, $this->request->data);
            //$user->password = $usersales->_setPassword
            if ($this->Users->save($usersales)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('usersales', $usersales);
        $this->Roles = TableRegistry::get('rule');
        $rolesQuery = $this->rule->find();
        $roles = array();
        foreach ($rolesQuery as $role) 
        {
            $roles[$rule->rule] = ucfirst($rule->rule);
        }

        $this->Sales = TableRegistry::get('Sales');
        $gQuery = $this->Sales->find()->where('id <> 99999999');
        $sales = array();
        $sales[99999999] = 'Choose Gate Number';
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

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
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

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
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