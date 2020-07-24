<!-- src/Template/Usersales/add.ctp -->

<div class="usersales form">
<?= $this->Form->create($usersales) ?>
    <fieldset>

        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('class', [
            'type'=>'select', 'options' => $tickettypes
        ]) ?>
        <?= $this->Form->input('role', [
            'type'=>'select', 'options' => $roles2
        ]) ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>