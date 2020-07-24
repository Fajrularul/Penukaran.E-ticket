<?php
namespace App\Controller;

use App\Controller\AppController;

class TickettypesController extends AppController
{

    public function index()
    {
        $this->set('tickettypes', $this->paginate($this->Tickettypes));
        $this->set('_serialize', ['tickettypes']);
    }

    public function view($id = null)
    {
        $tickettype = $this->tickettypes->get($id, [
            'contain' => []
        ]);
        $this->set('tickettype', $tickettype);
        $this->set('_serialize', ['tickettype']);
    }

    public function add()
    {
        $tickettype = $this->Tickettypes->newEntity();
        if ($this->request->is('post')) {
            $tickettype = $this->Tickettypes->patchEntity($tickettype, $this->request->data);
            if ($this->Tickettypes->save($tickettype)) {
                $this->Flash->success(__('The tickettype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tickettype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('tickettype'));
        $this->set('_serialize', ['tickettype']);
    }

    public function edit($id = null)
    {
        $tickettype = $this->Tickettypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tickettype = $this->Tickettypes->patchEntity($tickettype, $this->request->data);
            if ($this->Tickettypes->save($tickettype)) {
                $this->Flash->success(__('The tickettype has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The tickettype could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('tickettype'));
        $this->set('_serialize', ['tickettype']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tickettype = $this->Tickettypes->get($id);
        if ($this->Tickettypes->delete($tickettype)) {
            $this->Flash->success(__('The tickettype has been deleted.'));
        } else {
            $this->Flash->error(__('The tickettype could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
