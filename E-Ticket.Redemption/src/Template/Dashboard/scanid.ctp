
<div class="actions columns large-2 medium-3">
    <ul class="side-nav">
    </ul>
</div>

<div class="dashboard form large-10 medium-9 columns">
    <h2>ID SCAN</h2>
    <center>

    </center>

    <h2><?= $gatearea->gate_area . ' : ' . $gate->gate_number ?></h2>
    <?php 
        $session = $this->request->session();
        
    ?>
    <?= $this->Form->create(null) ?>
   
    <fieldset>
        <legend><?= __('Scan Ticket') ?></legend>
        <?php
            echo $this->Form->input('ticket_number',array( 'type' => 'text', 'required' => true, 'autofocus' => 'true'));
            
        ?>
       <?= $session->read('msg'); 
            
                
                /*echo'<script>
                setTimeout(function(){
                    window.location.reload(1);
                },5000);
            
                 </script>';*/
    ?>
        <?php $session->delete('msg'); ?>
    </fieldset>
    <?= $this->Form->button(__('Check In'), ['class' => 'btn btn-primary btn-block btn-lg', 'disabled' => $disabled]) ?>
    <?= $this->Form->end() ?>
</div>

