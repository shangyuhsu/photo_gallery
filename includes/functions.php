<?php

include_once(INCLUDES_PATH . "/config.php");

function strip_zeros_from_date($marked_string="") {
	$no_zeros = str_replace('*0','',$marked_string);
	$cleaned_string = str_replace('*','', $no_zeros);
	return $cleaned_string;
}

function redirect_to($location = NULL) {
	if($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function output_message($message="") {
	if(!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "";
	}
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
	$path = INCLUDES_PATH . "/{$class_name}.php";
	if(file_exists($path)) {
		require_once($path);
	} else {
		die("The file {$class_name}.php could not be found");
	}
}

function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

function u($string="") {
  return urlencode($string);
}

function raw_u($string="") {
  return rawurlencode($string);
}

function h($string="") {
  return htmlspecialchars($string);
}


function error_404() {
	header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
	exit();
}

function error_500() {
	header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
	exit();
}

function is_post_request() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
	$output = '';
	if(!empty($errors)) {
		$output .= "<div class=\"errors\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach($errors as $error) {
			$output .= "<li>" . h($error) . "</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}

function get_and_clear_session_message() {
	if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
		$msg = $_SESSION['message'];
		unset($_SESSION['message']);
		return $msg;
	}
}

function display_session_message() {
	$msg = get_and_clear_session_message();
	if(!is_blank($msg)) {
		return '<div id="message">' . h($msg) . '</div>';
	}
}

function log_action($action, $message="") {
	$logfile = LOGS_PATH . '/log.txt';
	$new = !file_exists($logfile);
	if($handle = fopen($logfile, 'a')) {
		$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
		fwrite($handle, $content);
		fclose($handle);
		if($new) {
			chmod($logfile, 0755);
		}
	} else {
		echo "Could not open log file for writing.";
	} 
}

function datetime_to_text($datetime="") {
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}
?>