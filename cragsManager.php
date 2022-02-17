<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/UI/DataTable.class.php';
include_once 'Classes/UI/Controller/CragsTableController.class.php';

use Sendstation\UI\DataTable;
use Sendstation\UI\Controller\CragsTableController;

include('Style/header.php');
echo "</br></br></br></br>";
$tableController = new CragsTableController(1);
if($tableController == null) echo "Failed to initialize table controller";
$table = new DataTable($tableController);
echo "</br></br></br></br>";
$table->draw();

include('Style/footer.php');
?>