<?php namespace Sendstation;
ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once 'Classes/Crags/CragServiceImpl.php';
require_once 'Classes/UI/CragCard.class.php';

use Sendstation\UI\CragCard;

use Sendstation\Crags\CragServiceImpl;

$crags = CragServiceImpl::getInstance()->getCrags();

echo "<div class=\"row text-center g-5\">";

foreach($crags as $crag) {

    $routes = CragServiceImpl::getInstance()->getRoutesInCrag($crag);

    $cragCard = new CragCard($crag, $routes);
    $cragCard->draw();
}

echo "</div>";

?>