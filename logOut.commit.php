<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

use Sendstation\Authentication\UserService;
require_once 'Classes/Authentication/UserService.class.php';

UserService::requestLogout();

header("location: index.php");
?>