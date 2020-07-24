<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Ticketlog'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="ticketlogs index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('ticket_number') ?></th>
            <th><?= $this->Paginator->sort('event_code') ?></th>
            <th><?= $this->Paginator->sort('event_name') ?></th>
            <th><?= $this->Paginator->sort('event_year') ?></th>
            <th><?= $this->Paginator->sort('event_month') ?></th>
            <th><?= $this->Paginator->sort('ticket_type') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($ticketlogs as $ticketlog): ?>
        <tr>
            <td><?= $this->Number->format($ticketlog->id) ?></td>
            <td><?= h($ticketlog->ticket_number) ?></td>
            <td><?= h($ticketlog->event_code) ?></td>
            <td><?= h($ticketlog->event_name) ?></td>
            <td><?= h($ticketlog->event_year) ?></td>
            <td><?= h($ticketlog->event_month) ?></td>
            <td><?= h($ticketlog->ticket_type) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $ticketlog->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ticketlog->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ticketlog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ticketlog->id)]) ?>
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
