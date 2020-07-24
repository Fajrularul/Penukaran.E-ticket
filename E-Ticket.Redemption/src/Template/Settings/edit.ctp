<div class="actions columns large-2 medium-3">
    <h3><?= __('Edit Setting') ?></h3>
</div>
<div class="settings form large-10 medium-9 columns">
    <?= $this->Form->create($setting) ?>
    <fieldset>
        <legend><?= __('Edit Setting') ?></legend>
        <?php
            echo $this->Form->input('keyed');
            echo $this->Form->input('valued');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
