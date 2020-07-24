<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ticketlog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ticketlog->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ticketlogs'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="ticketlogs form large-10 medium-9 columns">
    <?= $this->Form->create($ticketlog) ?>
    <fieldset>
        <legend><?= __('Edit Ticketlog') ?></legend>
        <?php
            echo $this->Form->input('ticket_number');
            echo $this->Form->input('event_code');
            echo $this->Form->input('event_name');
            echo $this->Form->input('event_year');
            echo $this->Form->input('event_month');
            echo $this->Form->input('ticket_type');
            echo $this->Form->input('gate_area');
            echo $this->Form->input('gate_number');
            echo $this->Form->input('registered_buyer');
            echo $this->Form->input('event_start');
            echo $this->Form->input('event_end');
            echo $this->Form->input('status');
            echo $this->Form->input('scanned_date_time');
            echo $this->Form->input('last_scanned');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
