<div class="actions columns large-2 medium-3">
    <h3><?= __('Settings') ?></h3>
</div>
<div class="settings index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('keyed') ?></th>
            <th><?= $this->Paginator->sort('valued') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($settings as $setting): ?>
        <tr>
            <td><?= h($setting->keyed) ?></td>
            <td><?= h($setting->valued) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $setting->id]) ?>
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
