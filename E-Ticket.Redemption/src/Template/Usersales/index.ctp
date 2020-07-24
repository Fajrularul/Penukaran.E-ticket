<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="users index large-10 medium-9 columns ">
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('username') ?></th>
            <th><?= $this->Paginator->sort('role') ?></th>
            <th>Gate Number</th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $usersales): ?>
        <tr>
            <td><?= h($usersales->username) ?></td>
            <td><?= h($usersales->role) ?></td>
            <td><?= h($usersales->gate["sales_class"]) ?></td>

            <td class="actions">
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersales->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersales-->id)]) ?>
                <?= $this->Html->link(__('Change Password'), ['action' => 'edit', $user->id]) ?>

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
