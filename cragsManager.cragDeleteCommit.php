<?php namespace Sendstation;

require_once('Classes/Crags/CragServiceImpl.php');

use Sendstation\Crags\CragServiceImpl;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if (key_exists('id', $_POST) && \is_numeric($_POST['id']) 
        && $crag = CragServiceImpl::getInstance()->getCragById(intval($_POST['id']))) {

        CragServiceImpl::getInstance()->deleteCrag($crag);
        var_dump($crag);
    }

    header("location: cragsManager.php");
}

?>