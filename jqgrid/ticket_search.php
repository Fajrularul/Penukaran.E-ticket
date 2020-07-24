<?php
require_once("conf.php");      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ticket Search</title>
<!-- Le styles -->
            <link type="text/css" href="css/custom.css" rel="stylesheet" /> 

            <!--[if IE 7]>
            <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css">
            <![endif]-->
            <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="css/custom-theme/jquery.ui.1.10.0.ie.css"/>
            <![endif]-->

</head>
<body> 

<?php

$dg = new C_DataGrid("select t.*, e.event_name, tt.type as type, ga.gate_area from tickets t 
inner join `events` e on e.id = t.event_id
inner join tickettypes tt on tt.id = t.ticket_type_id
inner join gateareas ga on ga.id = t.gate_area_id");

// change column titles
$dg -> set_col_title("ticket_number", "Ticket Number");
$dg -> set_col_title("type", "Ticket Type");
$dg -> set_col_title("gate_area", "Gate Area");
$dg -> set_col_title("registered_buyer",  "Registered Buyer");
$dg -> set_col_title("status",  "Status");
$dg -> set_col_title("event_name",  "Event Name");
$dg -> set_col_title("event_start",  "Start");
$dg -> set_col_title("event_end",  "End");

// change default caption
$dg -> set_caption("Daftar Tiket");

// enable integrated search
$dg -> enable_search(true);

$dg->set_col_edittype('status', 'select', 'open:Open;in:Checked In;out:Checked Out');

$dg-> set_col_readonly("ticket_number"); 
$dg-> set_col_readonly("type"); 
$dg-> set_col_readonly("gate_area"); 
$dg-> set_col_readonly("registered_buyer"); 
$dg-> set_col_readonly("status"); 
$dg-> set_col_hidden("scanned_date_time"); 
$dg-> set_col_readonly("event_name"); 
$dg -> set_col_hidden("id");
$dg -> set_col_hidden("ticket_type_id");
$dg -> set_col_hidden("gate_area_id");
$dg -> set_col_hidden("event_id");
$dg -> enable_export('EXCEL');


$dg->enable_kb_nav(true);
$dg -> set_dimension(1000, 400, true); 
$dg -> display();
?>

</body>
</html>