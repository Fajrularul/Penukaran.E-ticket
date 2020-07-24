<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Gateareas Controller
 *
 * @property \App\Model\Table\GateareasTable $Gateareas
 */
class GateareasController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('gateareas', $this->paginate($this->Gateareas));
        $this->set('_serialize', ['gateareas']);
    }

    /**
     * View method
     *
     * @param string|null $id Gatearea id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gatearea = $this->Gateareas->get($id, [
            'contain' => []
        ]);
        $this->set('gatearea', $gatearea);
        $this->set('_serialize', ['gatearea']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gatearea = $this->Gateareas->newEntity();
        if ($this->request->is('post')) {
            $gatearea = $this->Gateareas->patchEntity($gatearea, $this->request->data);
            if ($this->Gateareas->save($gatearea)) {
                $this->Flash->success(__('The gatearea has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The gatearea could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('gatearea'));
        $this->set('_serialize', ['gatearea']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gatearea id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gatearea = $this->Gateareas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gatearea = $this->Gateareas->patchEntity($gatearea, $this->request->data);
            if ($this->Gateareas->save($gatearea)) {
                $this->Flash->success(__('The gatearea has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The gatearea could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('gatearea'));
        $this->set('_serialize', ['gatearea']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Gatearea id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gatearea = $this->Gateareas->get($id);
        if ($this->Gateareas->delete($gatearea)) {
            $this->Flash->success(__('The gatearea has been deleted.'));
        } else {
            $this->Flash->error(__('The gatearea could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
