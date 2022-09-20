<?php

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once 'Classes/Crags/CragServiceImpl.php';

include_once 'Classes/UI/DataTable.class.php';
include_once 'Classes/UI/Controller/CragsTableController.class.php';

use Sendstation\Crags\CragServiceImpl;

use Sendstation\UI\DataTable;
use Sendstation\UI\Controller\CragsTableController;

$cragId = intval($_GET['q']);

$crag = CragServiceImpl::getInstance()->getCragById($cragId);

$routes = CragServiceImpl::getInstance()->getRoutesInCrag($crag);

$columnScheme = ['id', 'name', 'grade', 'description'];

echo "<table class=\"table table-bordered table-dark\"><thead><tr>
        <th class=\"text-light\" scope=\"col\">Id</th>
        <th class=\"text-light\" scope=\"col\">Name</th>
        <th class=\"text-light\" scope=\"col\">Description</th>
        <th class=\"text-light\" scope=\"col\">Controls</th>
    </tr></thead>
    <tbody><tr id=\"cragInfo\">
        <td id=\"cragId\">{$crag->getId()}</td>
        <td id=\"cragName\">{$crag->getName()}</td>
        <td id=\"cragDescription\">{$crag->getDescription()}</td>
        <td><button class=\"btn btn-light px-2\" data-bs-toggle=\"modal\" data-bs-target=\"#editCragModal\">Edit</button>
        <button data-bs-toggle=\"modal\" data-bs-target=\"#deleteCragModal\" data-crag-id=\"{$crag->getId()}\" class=\"btn btn-dark px-2\">Delete</button></td>
    </tr></tbody></table>";

echo "<table class=\"table table-bordered table-dark\">";
echo "<thead><tr>";
foreach ($columnScheme as $col) {

    echo "<th class=\"text-light\" scope=\"col\">" . $col . "</th>";
}
echo "<th class=\"text-light\" scope=\"col\">Controls</th>";
echo "</tr></thead>";

echo "<tbody>";
foreach ($routes as $route) {

    echo "<tr id=\"entry_{$route->getId()}\">";
    echo "<td>{$route->getId()}</td><td>{$route->getName()}</td><td>{$route->getGrade()}</td><td>{$route->getDescription()}</td>";
    echo "<td><button class=\"btn btn-light px-2\" data-bs-toggle=\"modal\" data-bs-target=\"#editRouteModal\" data-route-id=\"{$route->getId()}\">Edit</button>";
    echo "<button class=\"btn btn-dark px-2\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteRouteModal\" data-route-id=\"{$route->getId()}\">Delete</button></td>";
    echo "</tr>";
}
echo "<tr id=\"entry_new\">";
echo "<td>new</td><td></td><td></td><td></td>";
echo "<td><button class=\"btn btn-light px-2\" data-bs-toggle=\"modal\" data-bs-target=\"#editRouteModal\" data-route-id=\"new\">New</button>";
echo "</tr>";
echo "</tbody></table>";

?>