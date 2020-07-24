
<?php
    if(empty($this->request->query['date']))
        {
            $date = date('M/d/Y');
        }
        else
        {
            $date = $this->request->query['date'];
        }
?>
<div class="actions columns large-10 medium-3">
</div>
<script>

    setTimeout(function(){
        window.location.reload(1);
    },30000);

</script>
<div  > 
<div class="events view large-10 medium-9 columns" >
        <div class="large-5 columns strings">
        <h1>Report</h1>
        <div class="row" style="padding-left:15px;">
            <div class="large-1">
            <form method="get" accept-charset="utf-8" role="form" action="/eo/dashboard/report/"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>        <fieldset>
                <legend>Filtered By Today's Date</legend>
                <input type="text" name="date" class="form-control datepicker" data-date-format="M/dd/yyyy" style="width:200px;float:left;" value="<?= $date ?>">
                <button style="float:left;margin-left:10px;" type="submit" class="btn">Filter</button>            </fieldset>
            </form>
            </div>
        </div>
        <?php
            $session = $this->request->session();

            $user = $session->read('loggedUser');

           
            foreach ($reports as $key => $num) 
            {
                if($key != 'Rejected' && $user['role'] == 'owner')
                {
					if($key == "On Court Seating")
					{
						if($num > 120)
						{
							//$num = $num - 50;
                            $num = 120;
						}
					}
					
                    $discount_value = $num * (($discount)/100);
                    $num -= $discount_value;
                    $num = floor($num);
                }
        ?>
            <h6 class="subheader <?= strtolower(__($key)) ?>"><?= __($key) ?></h6>
            <p><?= h($num) ?></p>
        <?php
            }
        ?>           
        </div>

        <style type="text/css">
        h6{font-size: 1.5em;}
        p {font-weight: bold;font-size: 4em;padding: 0px !important;}
        .subheader {width: 400px !important;padding: 20px;}
        .rejected {
            background: #C3232D !important;
        }
        </style>
</div></div>


