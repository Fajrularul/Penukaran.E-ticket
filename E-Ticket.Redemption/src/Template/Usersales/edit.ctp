<!-- src/Template/Usersales/add.ctp -->

<div class="usersales form">
<?= $this->Form->create($usersales) ?>
    <fieldset>

        <legend><?= __('Edit User') ?></legend>
        <?= $this->Form->input('password', ['label' => 'New password', 'value' => '']) ?>
   </fieldset>
<?= $this->Form->button(__('Change Password')); ?>
<?= $this->Form->end() ?>
</div>