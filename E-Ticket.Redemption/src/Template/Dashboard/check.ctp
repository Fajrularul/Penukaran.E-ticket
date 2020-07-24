<style>
#container {
    margin: 0px auto;
    width: 500px;
    height: 375px;

}
#videoElement {
    width: 500px;
    height: 375px;
    background-color: #666;
}
</style>
<div class="actions columns large-2 medium-3">
    <ul class="side-nav">
    </ul>
</div>

<div class="dashboard form large-10 medium-9 columns">
    <h2><?= $gatearea->gate_area . ' : ' . $gate->gate_number ?></h2>
    <?php 
        $session = $this->request->session();
    ?>
    <?= $this->Form->create(null) ?>
    <?php
        $disabled = 'false';
        //if($numCheckedIn >= $gate->max_capacity )
        //{
            //echo '<div class="message_warning">This gate is full. </div>';
            //$disabled = 'true';
        //}
    ?>
    <fieldset>
        <legend><?= __('Scan Ticket') ?></legend>
        
        </div>
        <script>
            var video = document.querySelector("#videoElement");
         
        if (navigator.mediaDevices.getUserMedia) {       
            navigator.mediaDevices.getUserMedia({video: true})
          .then(function(stream) {
            video.srcObject = stream;
          })
          .catch(function(err0r) {
            console.log("Something went wrong!");
          });
        }
        </script>
        <?php

            echo $this->Form->input('ticket_number',array( 'type' => 'text', 'required' => true, 'autofocus' => 'true'));
        ?>
        <?= $session->read('msg') /*.'<script>
                setTimeout(function(){
                    window.location.reload(1);
                },5000);
            
            </script>'*/
    ?>
        <?php $session->delete('msg'); ?>
    </fieldset>
    <?= $this->Form->button(__('Check In'), ['class' => 'btn btn-primary btn-block btn-lg', 'disabled' => $disabled]) ?>
    <?= $this->Form->end() ?>
</div>

