<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) {
	redirect_to("login.php"); 
} ?>
<?php
	$logfile = LOGS_PATH . "/log.txt";
	if(isset($_GET['clear']) && $_GET['clear'] == 'true') {
		file_put_contents($logfile, '');

		log_action('Logs Cleared', "by User ID {$session->user_id}");
		redirect_to('logfile.php');
	}
?>

<?php include(PUBLIC_PATH . "/layouts/admin_header.php"); ?>

<a href="index.php">&laquo; Back</a><br/>
<br/>

<h2>Log File</h2>

<p><a href="logfile.php?clear=true">Clear log file</a></p>

<?php

	if(file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r')) { //read
		echo "<ul class=\"log-entries\">";
		while(!feof($handle)) {
			$content = fgets($handle);
			if(trim($content) != "") {
				echo "<li>{$content}</li>";
			}
		}
		echo "</ul>";
		fclose($handle);
	} else {
		echo "Could not read from {$logfile}.";
	}
?>

<?php include(PUBLIC_PATH . "/layouts/admin_footer.php"); ?>
	