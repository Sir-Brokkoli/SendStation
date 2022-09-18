<?php namespace Sendstation;

use Sendstation\Crags\Model\Crag;
use Sendstation\Crags\CragRepositoryImpl;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Crags/CragRepositoryImpl.php');
include_once('Classes/Crags/Model/Crag.php');

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $repository = CragRepositoryImpl::getInstance();

    //Authentication
    //$climberId = $_SESSION['id'];

    //Fetch input data
    $crag = null;
    if (key_exists('id', $_POST) && \is_numeric($_POST['id'])) {

        $crag = $repository->findById(intval($_POST['id']));
    }

    if ($crag == null) {

        $crag = new Crag(null, null, null);
    }

    if (key_exists('name', $_POST)) {

        $crag->setName($_POST['name']);
    }

    if (key_exists('description', $_POST)) {

        $crag->setDescription($_POST['description']);
    }

    // Register
    $repository->save($crag);

    header("location: cragsManager.php?id={$crag->getId()}");
}

?>