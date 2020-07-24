<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Gate area'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="gateareas index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('gate_area') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($gateareas as $gatearea): ?>
        <tr>
            <td><?= h($gatearea->gate_area) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $gatearea->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gatearea->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $gatearea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gatearea->id)]) ?>
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
