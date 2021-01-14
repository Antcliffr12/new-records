<?php
namespace Crons\ExternalModule;

use ExternalModules\AbstractExternalModule;

class ExternalModule extends AbstractExternalModule {

    function setupProjectPage(){
        $this->includeJS("js/cron.js");

        $settings = [
            'ajaxpage' => $this->framework->getUrl('pages/ajaxpage.php')
        ];

        $this->setJsSettings($settings);
    }

    protected function includeJs($path) {
        echo '<script src="' . $this->framework->getUrl($path, true) . '">;</script>';
    }

    protected function setJsSettings($settings) {
        echo '<script>cron = ' . json_encode($settings) . ';</script>';
    }

    function changeField(&$redcap_data, $field, $new_value) {
     
        // Dig through the data array for the proper field and replace its value inplace
        array_walk_recursive($redcap_data, function(&$value, &$key) use($field, $new_value) {
            if ($key == $field) {
                $value = $new_value;
            }
        });

       
    }

    function run_cron(){
        $EnabledIdArray = $this->framework->getProjectsWithModuleEnabled();


            
        foreach($EnabledIdArray as $projectId){
            $recordList = \REDCap::getData([
                "project_id" => $projectId,
            ]);
           
             $this->changeField($recordList, "checked", "1");

             \REDCap::saveData($projectId, 'array', $recordList, 'overwrite');

             $this->log("Updated field checked to value '1' for project_id '$projectId'");

        }

       
        
    }


}

