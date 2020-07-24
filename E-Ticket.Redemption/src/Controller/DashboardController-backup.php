<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController
{


    public function index()
    {
        $this->set('dashboard');
    }

    public function search()
    {
        
    }

    public function logs()
    {
        
    }

    public function report()
    {
        $this->Tickettypes = TableRegistry::get('Tickettypes');
        $this->Events = TableRegistry::get('Events');
        $events = $this->Events->find('all')->limit(1);

        if(empty($this->request->query['date']))
        {
            $date = date('M/d/Y');
        }
        else
        {
            $date = $this->request->query['date'];
        }

        $date = str_replace('/', ' ' , $date);

        $filter_date = date('Y-m-d', strtotime($date));


        foreach ($events as $event) 
        {
            break;
        }

        $this->Ticketlogs = TableRegistry::get('Ticketlogs');
        $this->Settings = TableRegistry::get('Settings');

        $settings = $this->Settings->find('all', [
                'conditions' => ['keyed = ' => 'report_calc']
            ])->limit(1);
        $discount = 0;
        foreach ($settings as $setting) 
        {
            $discount = $setting->valued;
            break;
        }


        $TicketTypes = $this->Tickettypes->find('all');

        $reports = array();
        foreach ($TicketTypes as $ticketType)
        {
            $findAllLog = $this->Ticketlogs->find('all', [
                'conditions' => ['Ticketlogs.status <> ' => 'rejected', 'event_code = ' => $event->event_code, 'ticket_type = ' => (strlen($ticketType->type) > 12 ? substr($ticketType->type,0,-1) : $ticketType->type), "scanned_date_time like '".$filter_date."%'"]
            ]);
            $numCheckedIn = $findAllLog->count();
            $reports[$ticketType->type] = $numCheckedIn;
        }

        $findAllLog = $this->Ticketlogs->find('all', [
                'conditions' => ['Ticketlogs.status = ' => 'rejected', 'event_code = ' => $event->event_code, "scanned_date_time like '".$filter_date."%'"]
        ]);
        $numCheckedIn = $findAllLog->count();
        $reports['Rejected'] = $numCheckedIn;

        $this->set(compact('reports', 'discount'));

    }


    public function check()
    {
        $this->Tickets = TableRegistry::get('Tickets');
        $this->Gates = TableRegistry::get('Gates');
        $this->Gateareas = TableRegistry::get('Gateareas');
        $this->Ticketlogs = TableRegistry::get('Ticketlogs');

        $session = $this->request->session();
        $user = $session->read('loggedUser');

        $gate = $this->Gates->get($user["gate_id"], [
            'contain' => []
        ]);

        $gatearea = $this->Gateareas->get($gate["gate_area_id"], [
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

        //if($numCheckedIn < $gate->max_capacity )
        //{
            if ($this->request->is('post')) 
            {
                $ticket = $this->Tickets->find('all', array('contain' => array('Gateareas', 'TicketTypes', 'Events')))->where("ticket_number = '" . $this->request->data['ticket_number'] . "'")->limit(1);
                $found = false;

                $oTicket = TableRegistry::get('Ticketlogs');
                $oQuery = $oTicket->query();

                $multiCheckedin = false;
                $multiCheckedinMessage = '';

                foreach ($ticket as $tick) 
                {
                    $found = true;
                    if($tick->GateAreas['gate_area'] != $gatearea->gate_area)
                    {
                        $session->write('msg', '<div class="message_warning">Wrong gate for ticket number: ' . $this->request->data['ticket_number'] . ' <br/> This ticket should go to ' . $tick->GateAreas['gate_area'] . '</div>');
                        return $this->redirect(['action' => 'check']);
                    }

                    if($tick->status == 'open')
                    {
                        $todays = date('Y-m-d');
                        $ticket_date = date('Y-m-d', strtotime($tick->event_start));
                        
                        if($ticket_date != $todays)
                        {
                            $session->write('msg', '<div class="message_warning">This ticket is not valid for today\'s event.</div>');
                            return $this->redirect(['action' => 'check']);
                        }
                        else
                        {
                            $tick->status = 'in';
                            $tick->scanned_date_time = date('Y-m-d H:i:s');
                            $this->Tickets->save($tick);

                            $data = ['ticket_number' => $tick->ticket_number, 'event_code' => $tick->event->event_code, 'event_name' => $tick->event->event_name, 'event_year' => $tick->event->event_year, 'event_month' => $tick->event->event_month, 'ticket_type' => $tick->ticket_type->type, 'gate_area' => $gatearea->gate_area, 'gate_number' => $user["gate_id"], 'registered_buyer' => $tick->registered_buyer, 'event_start' => $tick->event_start, 'event_end' => $tick->event_end, 'status' => 'in', 'scanned_date_time' => date('Y-m-d H:i:s'), 'last_scanned' => date('Y-m-d H:i:s')];

                            $oQuery->insert(['ticket_number','event_code', 'event_name', 'event_year', 'event_month', 'ticket_type', 'gate_area', 'gate_number', 'registered_buyer', 'event_start', 'event_end', 'status', 'scanned_date_time', 'last_scanned'])
                            ->values($data);
                        
                            $oQuery->execute();
                        }
                    }
                    else
                    {
						$todays = date('Y-m-d');
                        $ticket_date = date('Y-m-d', strtotime($tick->event_start));
                        
                        if($ticket_date != $todays)
                        {
                            $session->write('msg', '<div class="message_warning">This ticket is not valid for today\'s event.</div>');
                            return $this->redirect(['action' => 'check']);
                        }
                        else
                        {
							$ticketlogs = $oTicket->find()->where("ticket_number = '" . $this->request->data['ticket_number'] . "'")->limit(1);
							
							$multiCheckedin = true;
							foreach ($ticketlogs as $tlogs) 
							{
								$multiCheckedinMessage = '<div class="message_warning2">Already checked-in on '.$tlogs->last_scanned.'</div>';
								$tlogs->last_scanned = date('Y-m-d H:i:s');
								$oTicket->save($tlogs);
								break;
							}
						}
                    }

                    break;

                }
                
                if ($found) 
                {
                    if(!$multiCheckedin)
                        $session->write('msg', '<div class="message">Ticket number: '.$tick->ticket_number.' checked in</div>');
                    else
                        $session->write('msg', $multiCheckedinMessage);
                } 
                else 
                {
                    $this->Events = TableRegistry::get('Events');
                    $evQuery = $this->Events->find();

                    foreach ($evQuery as $event) 
                    {
                        break;
                    }

                    $data = ['ticket_number' => $this->request->data['ticket_number'], 'event_code' => $event->event_code, 'event_name' => $event->event_name, 'event_year' => $event->event_year, 'event_month' => $event->event_month, 'ticket_type' => 'NOT Found', 'gate_area' => $gatearea->gate_area, 'gate_number' => $user["gate_id"], 'registered_buyer' => 'NOT FOUND', 'event_start' => date('Y-m-d H:i:s'), 'event_end' => date('Y-m-d H:i:s'), 'status' => 'rejected', 'scanned_date_time' => date('Y-m-d H:i:s'), 'last_scanned' => date('Y-m-d H:i:s')];

                    $oQuery->insert(['ticket_number','event_code', 'event_name', 'event_year', 'event_month', 'ticket_type', 'gate_area', 'gate_number', 'registered_buyer', 'event_start', 'event_end', 'status', 'scanned_date_time', 'last_scanned'])
                        ->values($data);
                    
                    $oQuery->execute();

                    $session->write('msg', '<div class="message_warning">Invalid ticket number: ' . $this->request->data['ticket_number'] . '</div>');
                }
                return $this->redirect(['action' => 'check']);
            }
        //}
    }

   
}