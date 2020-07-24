<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Ticket Type'), ['action' => 'edit', $tickettype->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ticket Type'), ['action' => 'delete', $tickettype->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tickettype->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ticket Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ticket Type'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="tickettypes view large-10 medium-9 columns">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Type') ?></h6>
            <p><?= h($tickettype->type) ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($tickettype->description)) ?>
        </div>


</div>
