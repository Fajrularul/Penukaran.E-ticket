<!-- src/Template/Users/add.ctp -->

<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>

        <legend><?= __('Edit User') ?></legend>
        <?= $this->Form->input('password', ['label' => 'New password', 'value' => '']) ?>
   </fieldset>
<?= $this->Form->button(__('Change Password')); ?>
<?= $this->Form->end() ?>
</div>