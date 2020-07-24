<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
</div>
<div class="gateareas form large-10 medium-9 columns">
    <?= $this->Form->create($inputticket) ?>
    <fieldset>
        <legend><?= __('Add Ticket') ?></legend>
        <?php
            echo $this->Form->input('ticket_number');
            echo $this->Form->input('event_id');
            echo $this->Form->input('ticket_type');
            echo $this->Form->input('gate_area_id'),[
            'type'=>'select', 'options' => $gateareas
        ]);
            echo $this->Form->input('registered_buyer');
            echo $this->Form->input('event_start');
            echo $this->Form->input('event_end');
        
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>