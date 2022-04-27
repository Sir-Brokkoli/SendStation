<?php namespace Sendstation\UI\Modal;

include_once 'Classes/IDrawable.php';

use Sendstation\UI\IDrawable;

class ModalBody implements IDrawable {

    private array $content;

    public function draw() : void {

        echo "<div class=\"modal-body\">";

        

        echo "</div>";
    }
}

?>