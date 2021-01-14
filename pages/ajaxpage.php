<?php 

$field_name = $_POST['field_name'];
$new_value = $_POST['new_value'];


if($pid = $_GET['pid']){
    $get_data = [
        'project_id' => $pid,
        'field' => $field_name
    ];

    $redcap_data = \REDCap::getData($get_data);

    $module->changeField($redcap_data, $field_name, $new_value); // update the $redcap_data array inplace

    \REDCap::saveData($pid, 'array', $redcap_data, 'overwrite');


    $module->framework->log("Updated field '$field_name' to value '$new_value' for project_id '$pid'");

}