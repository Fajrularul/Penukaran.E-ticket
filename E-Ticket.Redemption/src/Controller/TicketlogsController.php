<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Ticketlogs Controller
 *
 * @property \App\Model\Table\TicketlogsTable $Ticketlogs
 */
class TicketlogsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('ticketlogs', $this->paginate($this->Ticketlogs));
        $this->set('_serialize', ['ticketlogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Ticketlog id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticketlog = $this->Ticketlogs->get($id, [
            'contain' => []
        ]);
        $this->set('ticketlog', $ticketlog);
        $this->set('_serialize', ['ticketlog']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ticketlog = $this->Ticketlogs->newEntity();
        if ($this->request->is('post')) {
            $ticketlog = $this->Ticketlogs->patchEntity($ticketlog, $this->request->data);
            if ($this->Ticketlogs->save($ticketlog)) {
                $this->Flash->success(__('The ticketlog has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ticketlog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ticketlog'));
        $this->set('_serialize', ['ticketlog']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticketlog id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticketlog = $this->Ticketlogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticketlog = $this->Ticketlogs->patchEntity($ticketlog, $this->request->data);
            if ($this->Ticketlogs->save($ticketlog)) {
                $this->Flash->success(__('The ticketlog has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ticketlog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ticketlog'));
        $this->set('_serialize', ['ticketlog']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticketlog id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticketlog = $this->Ticketlogs->get($id);
        if ($this->Ticketlogs->delete($ticketlog)) {
            $this->Flash->success(__('The ticketlog has been deleted.'));
        } else {
            $this->Flash->error(__('The ticketlog could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
