<!--<script>

    setTimeout(function(){
        window.location.reload(1);
    },10000);

</script>-->
<?php

if(empty($this->request->query['date']))
        {
            $date = date('Y-m-d');
        }
        else
        {
            $date = $this->request->query['date'];
        }
?>
 <div class="row" style="padding-left:15px;">
            <div class="large-1">
                <form method="get" accept-charset="utf-8" role="form" action="/E-Ticket.Redemption/dashboard/report/"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>        <fieldset>
                        <legend>Filtered By Today's Date</legend>
                        <input type="text" name="date" class="form-control datepicker" data-date-format="yyyy-mm-dd" style="width:200px;float:left;" value="<?= $date ?>">
                        <button style="float:left;margin-left:10px;" type="submit" class="btn">Filter</button>            </fieldset>
                </form>
            </div>
        </div>
<div style="width: 100%;">
   <div style="float:left; width:45%;margin-right:5%">
   
  
<div class="actions columns large-10 medium-3">
</div>
<div class="events view large-10 medium-9 columns">
    <div class="large-5 columns strings">
        <h3>Report Redemption</h3>
       
        <?php
            $totalCheckin=0;
            $session = $this->request->session();

            $user = $session->read('loggedUser');

            

//           print_r($reports['On Court Seating']);            
//           echo $reports['On Court Seating']-$ticket_free;
            //print_r($ticket_free);
            $free = $ticket_free;            
            foreach ($reports as $key => $num) 
            {
                if($key != 'Rejected' && $user['role'] == 'owner')
                {                    
		if($key == "On Court Seating")
		{                   
                  $num = $free-$num; 
                  $num = abs($num);
		} 					
                $discount_value = $num * (($discount)/100);
                $num -= $discount_value;
                $num = floor($num);
                }
                $totalCheckin+=$num;
                
        ?>

        <h6 class="subheader inline <?= strtolower(__($key)) ?>"><?= __($key) ?></h6>        
        <p class="inline p-bg"><?= h($num)?></p>
<!--        <p><?= $num ?></p>-->
        <?php
            }
                echo '<h6 class="subheader vip b-1">TOTAL CHECK-IN</h6><p>',$totalCheckin-$num,'</p><br></div>';                                                
                 $date_now = date("Y-m-d");
                 $db = mysql_connect(   'localhost','root','') or die("Connection error");
                 $db = mysql_select_db("systhink_eo2",$db) or die(mysql_error($db));                                                                                       
                 
                 $query = "SELECT ticket_type, SUM(qty) FROM systhink_eo2.ticketlogs where event_start='".$date."' GROUP BY ticket_type"; 
                    $result = mysql_query($query) or die(mysql_error());

                    echo '</div></div> <div style="float:right;width:50%">';
                    echo '';     
                  

                   
                        
                $open = open;
                $query1 = "SELECT type, SUM(qty) FROM tickets inner join tickettypes on tickets.ticket_type_id=tickettypes.id where status='".$open."' and event_start='".$date."' GROUP BY ticket_type_id"; 
                    $result1 = mysql_query($query1) or die(mysql_error());

                    
                    echo '<p><h4>Available Tickets</h4></p>';

                    // Print out result
                    while($row = mysql_fetch_array($result1)){
                        echo '<h6 class="subheader available" style="color:black">'. $row['type'].'  <i style="font-size :2em; float:right;"></i></h6><p>'.$row['SUM(qty)'].'</p>';
                        }

              


                                     
        ?>  
       
</div>
<div style="clear:both"></div>         
    </div>

    <style type="text/css">

        h6{font-size: 1.5em;}
        p {font-weight: bold;font-size: 4em;padding: 0px !important;}
        .subheader {width: 300px !important;padding: 20px; border-radius:10px;}
        .rejected {
            background: #C3232D !important;
        }

        .redeemed {
            background: #ffeb3bb5 !important;
        }

        .available { background: #3dc92e9e !important;}
        .inline {display:inline;}
        .p-bg{background-color:;
                top:-1;}
           
    </style>
        
</div>

