
<?php 
require_once APP_PATH_DOCROOT . 'ProjectGeneral/header.php';

$module->setupProjectPage();
$module->run_cron();
?>
<input type="hidden" name="checked" value="1" id="checked" />
<input id="submission" type="submit" value="Run Cron" />

<div class="test">
</div>
<?php 

require_once APP_PATH_DOCROOT . 'ProjectGeneral/footer.php';
