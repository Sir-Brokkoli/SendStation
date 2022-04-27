<?php namespace Sendstation;
ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/Service/ContactService.class.php';

use Sendstation\Service\ContactService;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $msg = $_POST['msg'];

    echo $msg;
    
}

?>