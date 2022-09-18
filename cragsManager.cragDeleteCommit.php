<?php namespace Sendstation;

require_once('Classes/Crags/CragRepositoryImpl.php');
include_once('Classes/Crags/Model/Crag.php');

use Sendstation\Crags\Model\Crag;
use Sendstation\Crags\CragRepositoryImpl;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Authentication
    //$climberId = $_SESSION['id'];

    $repository = CragRepositoryImpl::getInstance();

    //Fetch input data
    $crag = null;
    if (key_exists('id', $_POST) && \is_numeric($_POST['id']) && $crag = $repository->findById(intval($_POST['id']))) {
        $repository->delete($crag);
        var_dump($crag);
    }

    header("location: cragsManager.php");
}

?>