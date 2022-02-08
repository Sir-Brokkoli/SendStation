<?php
ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/ConnectionMysql.class.php');
include_once('Classes/config.php');
include_once('DEBUG/DEBUG.php');

session_start();

//
//Implement a commit of a full session bypassing the active session system
//

?>