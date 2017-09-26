<?php

define("INCLUDES_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(INCLUDES_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("LOGS_PATH", PROJECT_PATH . '/logs');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once("config.php");
require_once("functions.php");
require_once("session.php");
require_once("database.php");
require_once("pagination.php");
require_once("database_object.php");
require_once("user.php");
require_once("photograph.php");

?>