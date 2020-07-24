<div class="actions columns large-10 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Event'), ['action' => 'delete', $event->id], ['confirm' => __('Are you sure you want to delete # {0}?', $event->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="events view large-10 medium-9 columns">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Event Code') ?></h6>
            <p><?= h($event->event_code) ?></p>
            <h6 class="subheader"><?= __('Event Name') ?></h6>
            <p><?= h($event->event_name) ?></p>
            <h6 class="subheader"><?= __('Event Year') ?></h6>
            <p><?= h($event->event_year) ?></p>
            <h6 class="subheader"><?= __('Event Month') ?></h6>
            <p><?= h($event->event_month) ?></p>
        </div>

</div>

