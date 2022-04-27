<?php namespace Sendstation;

include_once 'Classes/UI/ProgressDataSheet.class.php';

use Sendstation\UI\ProgressDataSheet;

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

    $sheet = new ProgressDataSheet($_SESSION['id']);
    $sheet->draw();
}
else{
    echo "Error: You are not logged in! Log in to continue.";
}

?>