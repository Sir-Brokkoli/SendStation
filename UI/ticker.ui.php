<?php
namespace Sendstation;

use Sendstation\Database\ConnectionMysql;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('./Classes/ConnectionMysql.class.php');
include_once('./Classes/config.php');
include_once('./DEBUG/DEBUG.php');
include_once('./Classes/DateHandler.php');

$numEntries = 20;

if($sessionData = ConnectionMysql::getDataFromTable(DT_SESSIONS, "id, id_crag, date", "", "ORDER BY date DESC LIMIT ?", $numEntries)){
    if($sessionData->num_rows > 0){
        while($session = $sessionData->fetch_assoc()){
            //Fetch crag name
            if($cragData = ConnectionMysql::getDataFromTable(DT_CRAGS, "name", "id = ?", "", $session['id_crag'])){
                if($cragData->num_rows > 0 && $crag = $cragData->fetch_assoc()){
                    $html = "<div class=\"card bg-dark text-light mb-1 px-1\">" .
                        "<div class=\"card-body row\">" .
                            "<div class=\"col-10\">" .
                                "<p class=\"card-text\">" .
                                    "<span class=\"text-col2\">" . $_SESSION['nickname'] . "</span> finished a session in " . $crag['name'] . ".</br>" .
                                    "<small>- " . DateHandler::HandleDateToString($session['date']) . "</small>" .
                                "</p>" .
                            "</div>" .
                            "<div class=\"col-2\">" .
                                "<button class=\"btn btn-sm btn-dark m-auto p-auto\"><i class=\"bi bi-heart text-col1\"></i></button>" .
                            "</div>" .
                        "</div>" .
                    "</div>";

                    echo $html;
                }
            }
        }
    }
    else{
        echo "<p class = \"text-dark\"> No entries so far. </p>";
    }
}
else{
    echo ERR_SQL_EXECUTE;
}

?>