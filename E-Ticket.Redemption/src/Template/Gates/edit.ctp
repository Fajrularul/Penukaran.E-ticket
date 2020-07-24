<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $gate->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $gate->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Gates'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="gates form large-10 medium-9 columns">
    <?= $this->Form->create($gate) ?>
    <fieldset>
        <legend><?= __('Edit Gate') ?></legend>
        <?php
            echo $this->Form->input('gate_number');
            echo $this->Form->input('description');
            echo $this->Form->input('max_capacity');
            echo $this->Form->input('gate_area_id', [
            'type'=>'select', 'options' => $gateareas
        ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
