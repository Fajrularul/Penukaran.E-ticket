<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Gate areas'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="gateareas form large-10 medium-9 columns">
    <?= $this->Form->create($gatearea) ?>
    <fieldset>
        <legend><?= __('Add Gatearea') ?></legend>
        <?php
            echo $this->Form->input('gate_area');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
