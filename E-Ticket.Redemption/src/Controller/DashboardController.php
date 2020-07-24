<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class DashboardController extends AppController {

    public function index() {
        $this->set('dashboard');
    }

    public function search() {
        
    }
	
    public function report() {
        $this->Tickettypes = TableRegistry::get('Tickettypes');
        $this->Events = TableRegistry::get('Events');
        $events = $this->Events->find('all')->limit(1);


        if (empty($this->request->query['date'])) {
            $date = date('M/d/Y');
        } else {
            $date = $this->request->query['date'];
        }

        $date = str_replace('/', ' ', $date);

        $filter_date = date('Y-m-d', strtotime($date));


        foreach ($events as $event) {
            break;
        }

        $this->Ticketlogs = TableRegistry::get('Ticketlogs');

        $this->Settings = TableRegistry::get('Settings');

        $settings = $this->Settings->find('all', [
                    'conditions' => ['keyed = ' => 'report_calc']
                ])->limit(1);
        $discount = 0;
        foreach ($settings as $setting) {
            $discount = $setting->valued;
            break;
        }

        $TicketTypes = $this->Tickettypes->find('all');        
        $con = ConnectionManager::get('default');
        $idfrom = '45777';
        $idend = '45826';
        $startdate = '2016-06-05 07:00:00';
        $find_free_ticket = $con->execute("SELECT tl.ticket_number FROM `ticketlogs` tl join tickets t on tl.ticket_number = t.ticket_number where t.id between 
		'{$idfrom}' and '{$idend}' and t.event_start = '{$startdate}'")->fetchAll();
        $ticket_free = count($find_free_ticket);
        
        $reports = array();
        foreach ($TicketTypes as $ticketType) {

            $findAllLog = $this->Ticketlogs->find('all', [
                'conditions' => ['Ticketlogs.status <> ' => 'rejected', 'event_code = ' => $event->event_code, 
				'ticket_type = ' => (strlen($ticketType->type) > 30 ? substr($ticketType->type, 0, -1) : $ticketType->type), 
				"scanned_date_time like '" . $filter_date . "%'"]
            ]);

            $numCheckedIn = $findAllLog->count();

            $reports[$ticketType->type] = $numCheckedIn;
        }        

        $findAllLog = $this->Ticketlogs->find('all', [
            'conditions' => ['Ticketlogs.status = ' => 'rejected', 'event_code = ' => $event->event_code, "scanned_date_time like '" . $filter_date . "%'"]
        ]);

        $numCheckedIn = $findAllLog->count();        
        $reports['Rejected'] = $numCheckedIn;
        $this->set(compact('reports', 'discount','ticket_free'));
    }

    public function check() {
        $this->Tickets = TableRegistry::get('Tickets');
        $this->Gates = TableRegistry::get('Gates');
        $this->gateareas = TableRegistry::get('gateareas');
        $this->Ticketlogs = TableRegistry::get('Ticketlogs');

        $session = $this->request->session();
        $user = $session->read('loggedUser');
        $gate = $this->Gates->get($user["gate_id"], [
            'contain' => []
        ]);

        $gatearea = $this->gateareas->get($gate["gate_area_id"], [
            'contain' => []
        ]);

        $findAllLog = $this->Ticketlogs->find('all', [
                    'conditions' => ['Ticketlogs.status <> ' => 'rejected', 'gate_number = ' => $gate->id]
                ])->limit(1);

        $availableGates = $this->Gates->find('all', [
                    'conditions' => ['gate_area_id ' => $gate->gate_area_id, 'gate_number <> ' => $gate->id]
                ])->limit(1);

        $numCheckedIn = $findAllLog->count();


        $this->set(compact('gate'));
        $this->set(compact('gatearea'));
        $this->set(compact('numCheckedIn'));


        if ($this->request->is('post')) {
            $ticket = $this->Tickets->find('all', array('contain' => array('Gateareas', 'Tickettypes', 'Events')))->where("ticket_number = '" . $this->request->data['ticket_number'] . "'")->limit(1);
            $found = false;

            $oTicket = TableRegistry::get('Ticketlogs');
            $oQuery = $oTicket->query();

            $multiCheckedin = false;
            $multiCheckedinMessage = '';

            foreach ($ticket as $tick) {
                $found = true;
                if ($tick->gateareas['gate_area'] != $gatearea->gate_area) {
                    $session->write('msg', '<div class="message_warning-0 overlay"><center><i class="fa fa-times fa-5x"></i></center>'. $tick->tickettypes['type'] .' Not Allowed</div>'.$reload);
                    return $this->redirect(['action' => 'check']);
                }

                if ($tick->status == 'open') {
                    $todays = date('Y-m-d');
                    $ticket_date = date('Y-m-d', strtotime($tick->event_start));

                    if ($ticket_date != $todays) {
                        $session->write('msg', '<div class="message_warning-0 overlay"><center><i class="fa fa-times fa-5x"></i></center>This ticket is not valid for today\'s event.</div>'.$reload);
                        return $this->redirect(['action' => 'check']);
                    } else {
                        $tick->status = 'in';
                        $tick->scanned_date_time = date('Y-m-d H:i:s');
                        $this->Tickets->save($tick);

                        $data = ['ticket_number' => $tick->ticket_number, 'event_code' => $tick->event->event_code, 'event_name' => $tick->event->event_name, 'event_year' => $tick->event->event_year, 'event_month' => $tick->event->event_month, 'ticket_type' => $tick->tickettypes['type'], 'gate_area' => $gatearea->gate_area, 'gate_number' => $user["gate_id"], 'registered_buyer' => $tick->registered_buyer,'qty' => $tick->qty, 'event_start' => $tick->event_start, 'event_end' => $tick->event_end, 'status' => 'in', 'scanned_date_time' => date('Y-m-d H:i:s'), 'last_scanned' => date('Y-m-d H:i:s')];

                        $oQuery->insert(['ticket_number', 'event_code', 'event_name', 'event_year', 'event_month', 'ticket_type', 'gate_area', 'gate_number', 'registered_buyer', 'qty','event_start', 'event_end', 'status', 'scanned_date_time', 'last_scanned'])
                                ->values($data);

                        $oQuery->execute();
                    }
                } else {
                    $todays = date('Y-m-d');
                    $ticket_date = date('Y-m-d', strtotime($tick->event_start));

                    if ($ticket_date != $todays) {
                        $session->write('msg', '<div class="message_warning-0 overlay"><center><i class="fa fa-times fa-5x"></i></center>This ticket is not valid for today\'s event.</div>'.$reload);
                        return $this->redirect(['action' => 'check']);
                    } else {
                        $ticketlogs = $oTicket->find()->where("ticket_number = '" . $this->request->data['ticket_number'] . "'")->limit(1);

                        $multiCheckedin = true;
                        foreach ($ticketlogs as $tlogs) {
                            $multiCheckedinMessage = '<div class="message_warning-0 overlay"><center><i class="fa fa-times fa-5x"></i></center>Already Redeemed on ' . $tick->scanned_date_time . '<br><br> Buyer Name : '.$tick->registered_buyer.
                        '<br> Category   : '.$tick->tickettypes['type'].
                        '<br> Quantity   :'.$tick->qty.'
                        <br><input style="color:black" type="button" class="btn" value="Done" onClick="window.location.reload()">
                        </div>';
                            

                            break;
                        }
                    }
                }

                break;
            }

            if ($found) {
                if (!$multiCheckedin)
                    $session->write('msg', '<div class="message-1 overlay-in"><center><i class="fa fa-check fa-5x"></i></center> E-Voucher Redeemed'. 
                        '<br><br> Buyer Name : '.$tick->registered_buyer.
                        '<br> Category   : '.$tick->tickettypes['type'].
                        '<br> Quantity   :'.$tick->qty.'
                        <br><input style="color:black" type="button" class="btn" value="Done" onClick="window.location.reload()">
                        </div>
                        ');
                else
                    $session->write('msg', $multiCheckedinMessage);
            }
            else {
                $this->Events = TableRegistry::get('Events');
                $evQuery = $this->Events->find();

                foreach ($evQuery as $event) {
                    break;
                }

                $data = ['ticket_number' => $this->request->data['ticket_number'], 'event_code' => $event->event_code, 'event_name' => $event->event_name, 'event_year' => $event->event_year, 'event_month' => $event->event_month, 'ticket_type' => 'NOT Found', 'gate_area' => $gatearea->gate_area, 'gate_number' => $user["gate_id"], 'registered_buyer' => 'NOT FOUND','qty' => '0', 'event_start' => date('Y-m-d H:i:s'), 'event_end' => date('Y-m-d H:i:s'), 'status' => 'rejected', 'scanned_date_time' => date('Y-m-d H:i:s'), 'last_scanned' => date('Y-m-d H:i:s')];

                $oQuery->insert(['ticket_number', 'event_code', 'event_name', 'event_year', 'event_month', 'ticket_type', 'gate_area', 'gate_number', 'registered_buyer','qty', 'event_start', 'event_end', 'status', 'scanned_date_time', 'last_scanned'])
                        ->values($data);

                $oQuery->execute();

                $session->write('msg', '<div class="message_warning3 overlay"><center><i class="fa fa-times fa-5x"></i></center>Invalid Ticket Number : '. $this->request->data['ticket_number'].'</div>'.$reload_fail);
            }
            return $this->redirect(['action' => 'check']);
        }
    }

}
