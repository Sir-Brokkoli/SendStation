<?php
namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/ConnectionMysql.class.php');
require_once('Classes/SessionHandler.class.php');
include_once('Classes/config.php');
include_once('DEBUG/DEBUG.php');

session_start();

SessionHandler::openGateway();
if(SessionHandler::discardActiveSessionOf($_SESSION['id'])){
    header("location: home.php");
}

?>