<?php
namespace App\Controller;

use App\Controller\AppController;
use Spreadsheet_Excel_Reader;
use Cake\ORM\TableRegistry;

class TicketsController extends AppController
{

    public function index()
    {
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
        $this->tickettypes = TableRegistry::get('tickettypes');
        $ttQuery = $this->tickettypes->find();

                    $tickettypes = array();
                    foreach ($ttQuery as $tt) 
                    {
                        $tickettypes[$tt->id] = ucfirst($tt->type);
                    }
        $this->set(compact('type'));
        $this->set('tickettypes', $tickettypes);
        $this->set('_serialize', ['type']);

        $this->events = TableRegistry::get('Events');
        $eventQuery = $this->events->find();
           
            $events = array();
            foreach ($eventQuery as $eq) 
            {
                $events[$eq->id] = ucfirst($eq->id);
                
            }
         $this->set(compact('event'));
        $this->set('events', $events);
        $this->set('_serialize', ['event']);
    $search = $this->Tickets->newEntity();
    $id = $this->request->data['id'];
    $name = $this->request->data['name'];
    $types = $this->request->data['ticket_type_id'];
    $gates = $this->request->data['gate_area_id'];
    $t_number = $this->request->data['t_number'];
    $this->paginate = array(
        'conditions' => array("AND"=>array('Tickets.id LIKE' => "%".$id."%",'Tickets.ticket_number LIKE' => "%".$t_number."%",'Tickets.registered_buyer LIKE'=>"%".$name."%",'Tickets.ticket_type_id LIKE' => "%".$types."%",'Tickets.gate_area_id LIKE' => "%".$gates."%")),
        'limit' => 10,
        'contain' => ['Events', 'Tickettypes', 'Gateareas']
        
        );
     $data = $this->paginate('tickets');
        
        $this->set(compact('data',$data));
       
        $this->set('tickets', $data);
        $this->set('_serialize', ['tickets']);
    }

    
    public function add()
    {
        $ticket = $this->Tickets->newEntity();
        if ($this->request->is('post')) {
            move_uploaded_file($this->request->data['excel_file']['tmp_name'],WWW_ROOT.DS.'uploads'.DS.$this->request->data['excel_file']['name']);
            $data = new Spreadsheet_Excel_Reader();          
            $data->setOutputEncoding('CP1251');
            $filename = realpath(WWW_ROOT.DS.'uploads'.DS.$this->request->data['excel_file']['name']);
            $data->read($filename);
            $xls_data = array();
            $eventNames = explode("_", $this->request->data['excel_file']['name']);
            $eventCode = $eventNames[0];
            $eventYear = (int)$eventNames[2];
            $eventMonth = (int)$eventNames[3];
            $this->Events = TableRegistry::get('Events');
            $this->tickettypes = TableRegistry::get('Tickettypes');
            $this->gateareas = TableRegistry::get('gateareas');
            $eventQuery = $this->Events
            ->find()
            ->where(['event_code =' => $eventCode])
            ->where(['event_year =' => $eventYear])
            ->where(['event_month =' => $eventMonth])
            ->limit(1);
            $event_id = 0;
            foreach ($eventQuery as $eq) 
            {
                $event_id = $eq->id;
                break;
            }
            $gaQuery = $this->gateareas->find();

            $gateAreas = array();
            foreach ($gaQuery as $ga) 
            {
                $gateAreas[$ga->gate_area] = $ga->id;
            }
            $ttQuery = $this->tickettypes->find();

            $ticketTypes = array();
            foreach ($ttQuery as $tt) 
            {
                $ticketTypes[$tt->type] = $tt->id;
            }
            for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++)
            {
                $row_data = array();
                $row_data['ticket_number'] = $data->sheets[0]['cells'][$i][1];
                $row_data['event_id'] = $data->sheets[0]['cells'][$i][6];
                $row_data['registered_buyer'] = $data->sheets[0]['cells'][$i][7];
                $row_data['qty'] = $data->sheets[0]['cells'][$i][8];
                $row_data['event_start'] = date('Y-m-d H:i:s',strtotime($data->sheets[0]['cells'][$i][4]));
                $row_data['event_end'] = date('Y-m-d H:i:s',strtotime($data->sheets[0]['cells'][$i][5]));
                $row_data['ticket_type_id'] = $ticketTypes[$data->sheets[0]['cells'][$i][2]];
                $row_data['gate_area_id'] = $gateAreas[$data->sheets[0]['cells'][$i][3]];
                if($i > 1) 
                {
                    $xls_data[] = $row_data;
                }
            }
            $oTicket = TableRegistry::get('Tickets');
            $oQuery = $oTicket->query();
            foreach($xls_data as $data)
            {
                $oQuery->insert(['ticket_number','ticket_type_id', 'gate_area_id', 'registered_buyer','qty', 'event_id', 'event_start', 'event_end'])
                    ->values($data); // person array contains name and title
            }
            $oQuery->execute();
            $this->Flash->success(__('Success. Imported '. count($xls_data) .' records.'));
            return $this->redirect(['action' => 'index']);            
        }  
    }
   
     public function input()
    {
        $inputbarcode = $this->Tickets->newEntity();
        if ($this->request->is('post')) {
            $ticketlog = $this->Tickets->patchEntity($inputbarcode, $this->request->data);
            if ($this->Tickets->save($inputbarcode)) {
                $this->Flash->success(__('The Ticket has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The ticketlog could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('ticketlog'));
        $this->set('_serialize', ['ticketlog']);
    }

    public function export()
    {
          $this->autoRender=false;
          ini_set('max_execution_time', 1600); //increase max_execution_time to 10 min if data set is very large
          $results = $this->Tickets->find('all', array());// set the query function
           foreach($results as $result)
          {
            $header_excel = "Barcode \t Ticket Type ID \t Gate Area ID \t Registered Buyer \t Last Name \t Qty \t Status \t Scanned Date Time \t Event Start \t Event End \t \n";

           $header_row.= $result['ticket_number']."\t". $result['ticket_type_id'] ."\t ".$result['gate_area_id']." \t".$result['registered_buyer']." \t".$result['last_name']." \t".$result['qty']."\t".$result['status']."\t".$result['scanned_date_time']."\t".$result['event_start']."\t".$result['event_end']."\t \n";
           
          }
          $filename = "export_".date("Y.m.d").".xls";
          header('Content-type: application/ms-excel');
          header('Content-Disposition: attachment; filename="'.$filename.'"');
          echo ($header_excel);
          echo($header_row);
         }
}
