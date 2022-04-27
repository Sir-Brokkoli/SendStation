<?php namespace Sendstation;

use Sendstation\Model\Crag;
use Sendstation\Database\Database;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Database.class.php');
include_once('Classes/Model/Crag.class.php');

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $dataGateway = Database::getCragsDataGateway();

    //Authentication
    //$climberId = $_SESSION['id'];

    //Fetch input data
    $crag = null;
    if (key_exists('id', $_POST) && \is_numeric($_POST['id'])) {

        $crag = $dataGateway->findEntryById(intval($_POST['id']));
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
    $dataGateway->saveEntry($crag);

    header("location: cragsManager.php?id={$crag->getId()}");
}

?>