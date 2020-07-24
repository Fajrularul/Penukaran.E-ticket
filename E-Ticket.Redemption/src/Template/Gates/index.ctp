<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Gate'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="gates index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('gate_number') ?></th>
            <th><?= $this->Paginator->sort('max_capacity') ?></th>
            <th><?= $this->Paginator->sort('gate_area_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($gates as $gate): ?>
        <tr>
            <td><?= h($gate->gate_number) ?></td>
            <td><?= $this->Number->format($gate->max_capacity) ?></td>
            <td><?= $gate->gateareas['gate_area'] ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $gate->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $gate->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $gate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $gate->id)]) ?>
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
