<?php
namespace Sendstation;

use Sendstation\Authentication\UserService;
require_once 'Classes/UserService.class.php';

UserService::requestLogout();

header("location: index.php");
?>