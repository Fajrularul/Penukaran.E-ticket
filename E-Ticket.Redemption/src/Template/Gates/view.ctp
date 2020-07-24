<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Gate'), ['action' => 'edit', $gate->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gate'), ['action' => 'delete', $gate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gate->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Gates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gate'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="gates view large-10 medium-9 columns">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Gate Number') ?></h6>
            <p><?= h($gate->gate_number) ?></p>
            <h6 class="subheader"><?= __('Max Capacity') ?></h6>
            <p><?= $this->Number->format($gate->max_capacity) ?></p>
            <h6 class="subheader"><?= __('Gate Area Id') ?></h6>
            <p><?= $gate->GateAreas["gate_area"] ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($gate->description)) ?>
        </div>

</div>
