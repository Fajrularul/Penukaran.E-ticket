<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Ticket Types'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="tickettypes form large-10 medium-9 columns">
    <?= $this->Form->create($tickettype) ?>
    <fieldset>
        <legend><?= __('Add Tickettype') ?></legend>
        <?php
            echo $this->Form->input('type');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
