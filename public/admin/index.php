<?php

require_once("../../includes/initialize.php");
if(!$session->is_logged_in()) { redirect_to("login.php"); }

?>

<?php include(PUBLIC_PATH . "/layouts/admin_header.php"); ?>

<h2>Menu</h2>
<?php if(isset($message)) { echo output_message($message);} ?>
<ul>
	<li><a href="list_photos.php">View Photos</a></li>
	<li><a href="logfile.php">View Logs</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul>

<?php include(PUBLIC_PATH . "/layouts/admin_footer.php"); ?>
