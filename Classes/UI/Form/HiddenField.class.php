<?php namespace Sendstation\UI\Form;

include_once 'Classes/IDrawable.php';

use Sendstation\UI\IDrawable;

/**
 * Hidden element in the form for data transfer hidden for the view.
 * 
 * @author Joshua Graf
 */
class HiddenField extends IDrawable {

    private $elementId;
    private $elementName;

    public function __construct($elementId, $elementName) {

        $this->elementId = $elementId;
        $this->elementName = $elementName;
    }

    public function draw() : void {

        echo sprintf("<div><input type=\"hidden\" name=\"%s\" id=\"%s\"></div>", 
                $this->elementName, $this->elementId);
    }
}

?>