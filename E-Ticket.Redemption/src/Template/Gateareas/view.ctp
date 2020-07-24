<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Gate area'), ['action' => 'edit', $gatearea->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Gat earea'), ['action' => 'delete', $gatearea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gatearea->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Gate areas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gate area'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="gateareas view large-10 medium-9 columns">
    <h2><?= h($gatearea->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Gate Area') ?></h6>
            <p><?= h($gatearea->gate_area) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($gatearea->id) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($gatearea->description)) ?>
        </div>
    </div>
</div>
