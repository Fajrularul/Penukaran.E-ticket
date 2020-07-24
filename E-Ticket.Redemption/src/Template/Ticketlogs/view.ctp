<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Ticketlog'), ['action' => 'edit', $ticketlog->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ticketlog'), ['action' => 'delete', $ticketlog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticketlog->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ticketlogs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticketlog'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="ticketlogs view large-10 medium-9 columns">
    <h2><?= h($ticketlog->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Ticket Number') ?></h6>
            <p><?= h($ticketlog->ticket_number) ?></p>
            <h6 class="subheader"><?= __('Event Code') ?></h6>
            <p><?= h($ticketlog->event_code) ?></p>
            <h6 class="subheader"><?= __('Event Name') ?></h6>
            <p><?= h($ticketlog->event_name) ?></p>
            <h6 class="subheader"><?= __('Event Year') ?></h6>
            <p><?= h($ticketlog->event_year) ?></p>
            <h6 class="subheader"><?= __('Event Month') ?></h6>
            <p><?= h($ticketlog->event_month) ?></p>
            <h6 class="subheader"><?= __('Ticket Type') ?></h6>
            <p><?= h($ticketlog->ticket_type) ?></p>
            <h6 class="subheader"><?= __('Gate Area') ?></h6>
            <p><?= h($ticketlog->gate_area) ?></p>
            <h6 class="subheader"><?= __('Gate Number') ?></h6>
            <p><?= h($ticketlog->gate_number) ?></p>
            <h6 class="subheader"><?= __('Registered Buyer') ?></h6>
            <p><?= h($ticketlog->registered_buyer) ?></p>
            <h6 class="subheader"><?= __('Status') ?></h6>
            <p><?= h($ticketlog->status) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($ticketlog->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Event Start') ?></h6>
            <p><?= h($ticketlog->event_start) ?></p>
            <h6 class="subheader"><?= __('Event End') ?></h6>
            <p><?= h($ticketlog->event_end) ?></p>
            <h6 class="subheader"><?= __('Scanned Date Time') ?></h6>
            <p><?= h($ticketlog->scanned_date_time) ?></p>
            <h6 class="subheader"><?= __('Last Scanned') ?></h6>
            <p><?= h($ticketlog->last_scanned) ?></p>
        </div>
    </div>
</div>
