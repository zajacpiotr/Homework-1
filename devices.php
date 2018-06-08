<?php
$device = $_POST['device'];

$checkboxes = Array();

$checkboxes['A'] = Array();
$checkboxes['A'][0] = Array('name'=>'CheckboxA1', 'value'=>'A1');
$checkboxes['A'][1] = Array('name'=>'CheckboxA2', 'value'=>'A2');
$checkboxes['A'][2] = Array('name'=>'CheckboxA3', 'value'=>'A3');


$checkboxes['B'] = Array();
$checkboxes['B'][0] = Array('name'=>'CheckboxB1', 'value'=>'B1');
$checkboxes['B'][1] = Array('name'=>'CheckboxB2', 'value'=>'B2');
$checkboxes['B'][2] = Array('name'=>'CheckboxB3', 'value'=>'B3');
$checkboxes['B'][3] = Array('name'=>'CheckboxB4', 'value'=>'B4');

echo json_encode($checkboxes[$device]); 
?>
