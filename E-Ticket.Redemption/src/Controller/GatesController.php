<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class GatesController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'contain' => ['Gateareas']
        ];
        $this->set('gates', $this->paginate($this->Gates));
        $this->set('_serialize', ['gates']);
    }

    public function view($id = null)
    {
        $gate = $this->Gates->get($id, [
            'contain' => ['Gateareas']
        ]);
        $this->set('gate', $gate);
        $this->set('_serialize', ['gate']);
    }

    public function add()
    {
        $gate = $this->Gates->newEntity();
        if ($this->request->is('post')) {
            $gate = $this->Gates->patchEntity($gate, $this->request->data);
            if ($this->Gates->save($gate)) {
                $this->Flash->success(__('The gate has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The gate could not be saved. Please, try again.'));
            }
        }
        $this->gateareas = TableRegistry::get('gateareas');
        $gaQuery = $this->gateareas->find();
        $gateareas = array();
        foreach ($gaQuery as $ga) 
        {
            $gateareas[$ga->id] = ucfirst($ga->gate_area);
        }

        $this->set(compact('gate'));
        $this->set('gateareas', $gateareas);
        $this->set('_serialize', ['gate']);
    }

    public function edit($id = null)
    {
        $gate = $this->Gates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gate = $this->Gates->patchEntity($gate, $this->request->data);
            if ($this->Gates->save($gate)) {
                $this->Flash->success(__('The gate has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The gate could not be saved. Please, try again.'));
            }
        }
        $this->Gateareas = TableRegistry::get('Gateareas');
        $gaQuery = $this->Gateareas->find();
        $gateareas = array();
        foreach ($gaQuery as $ga) 
        {
            $gateareas[$ga->id] = ucfirst($ga->gate_area);
        }

        $this->set('gateareas', $gateareas);
        $this->set(compact('gate'));
        $this->set('_serialize', ['gate']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gate = $this->Gates->get($id);
        if ($this->Gates->delete($gate)) {
            $this->Flash->success(__('The gate has been deleted.'));
        } else {
            $this->Flash->error(__('The gate could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
