<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Import Excel Ticket'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Export'), ['action' => 'export']) ?></li>
       <!-- <li><?= $this->Html->link(__('Add Barcode'), ['action' => 'input']) ?></li>-->
    </ul>
</div>
<div class="tickets index large-10 medium-9 columns">
 <div class="searchForm">
     <?php 
         echo $this->Form->create("Post", array('class' => 'searchForm'
            ));
        echo $this->Form->input('id', array(
            "label" => "",
            "type" => "search",
            "placeholder" => "ID"
        ));
        echo $this->Form->input("name", array(
            "label" => "",
            "type" => "search",
            "placeholder" => "Name"
        ));
        echo $this->Form->input('t_number', array(
            "label" => "",
            "type" => "search",
            "placeholder" => "Ticket number"
        ));
        echo $this->Form->input('ticket_type_id', ['type'=>'select','empty' => 'Select', 'options' => $tickettypes,'value'=>'0']);
        echo $this->Form->input('gate_area_id', ['type'=>'select','empty' => 'Select', 'options' => $gateareas]);
        echo $this->Form->button(__('Search'));
        echo $this->Form->end(); 
    ?><br>

    </div>
    <table cellpadding="0" cellspacing="0"  class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('ticket_number') ?></th>
            <th><?= $this->Paginator->sort('ticket_type_id') ?></th>
            <th><?= $this->Paginator->sort('gate_area_id') ?></th>
            <th><?= $this->Paginator->sort('registered_buyer') ?></th>
            <th><?= $this->Paginator->sort('last_name') ?></th>
            <th><?= $this->Paginator->sort('qty') ?></th>
            <th><?= $this->Paginator->sort('status') ?></th>
            <th><?= $this->Paginator->sort('event_start') ?></th>
            <th><?= $this->Paginator->sort('event_end') ?></th>
            <th><?= $this->Paginator->sort('event_id') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($tickets as $ticket): ?>
        <tr>
            <td><?= h($ticket->ticket_number) ?></td>
            <td><?= $ticket->tickettypes['type'] ?></td>
            <td><?= $ticket->gateareas['gate_area'] ?></td>
            <td><?= h($ticket->registered_buyer) ?></td>
             <td><?= h($ticket->last_name) ?></td>
              <td><?= h($ticket->qty) ?></td>
            <td><?= h($ticket->status) ?></td>
            <td><?= h($ticket->event_start) ?></td>
            <td><?= h($ticket->event_end) ?></td>
            <td>
                <?= $ticket->event->event_name ?>
                <?php // $ticket->has('event') ? $this->Html->link($ticket->event->id, ['controller' => 'Events', 'action' => 'view', $ticket->event->id]) : '' ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
