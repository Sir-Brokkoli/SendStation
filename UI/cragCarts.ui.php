<?php namespace Sendstation;
ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once 'Classes/CragHandler.class.php';
require_once 'Classes/UI/CragCard.class.php';

use Sendstation\UI\CragCard;

$crags = CragHandler::getCrags();

echo "<div class=\"row text-center g-5\">";

foreach($crags as $crag) {

    $routes = CragHandler::getRoutesInCrag($crag);

    $cragCard = new CragCard($crag, $routes);
    $cragCard->draw();
}

echo "</div>";

?>