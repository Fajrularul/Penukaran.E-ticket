
<div class="tickets form large-10 medium-9 columns">
    <?= $this->Form->create(null, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Import Excel Ticket') ?></legend>

        <h6>Excel Format .xls(97-2003)<br><br />
            Column 1 = Ticket Number(unique)<br />
            Column 2 = Ticket Types  Name<br />
            Column 3 = Gate Areas Name<br />
            Column 4 = Event Start ('mm-dd-yyyy hh:ii:ss)<br />
            Column 5 = Event End   ('mm-dd-yyyy hh:ii:ss)<br />
            COlumn 6 = Event ID <br />
            Column 7 = Buyer Name<br />
            Column 8 = Quantity of Tickets<br><br />
        <?php
            echo $this->Form->input('excel_file',array( 'type' => 'file', 'required' => true));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Import')) ?>
    <?= $this->Form->end() ?>
</div>
