<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tickettype->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tickettype->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ticket Types'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="tickettypes form large-10 medium-9 columns">
    <?= $this->Form->create($tickettype) ?>
    <fieldset>
        <legend><?= __('Edit Ticket Type') ?></legend>
        <?php
            echo $this->Form->input('type');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
