<?php
namespace Sendstation;

use Sendstation\Database\Database;

ini_set ("display_errors", "1");
error_reporting(E_ALL);


require_once 'Classes/Database.class.php';

if(Database::getSessionsDataGateway()->initializeTable()){
    echo "Table 'Sessions' initialized!</br>";
}
else echo "Could not initialize table!</br>";

if(Database::getGoesDataGateway()->initializeTable()){
    echo "Table 'Goes' initialized!</br>";
}
else echo "Could not initialize table!</br>";

?>