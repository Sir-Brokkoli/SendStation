<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/ConnectionMysql.class.php');
require_once('Classes/Sessions/SessionServiceImpl.php');
include_once('Classes/config.php');
include_once('DEBUG/DEBUG.php');

use Sendstation\Sessions\SessionServiceImpl;

session_start();

SessionServiceImpl::openGateway();
if(SessionServiceImpl::discardActiveSessionOf($_SESSION['id'])){
    header("location: home.php");
}

?>