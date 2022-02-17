<?php namespace Sendstation\UI\Form;

include_once 'Classes/UI/IDrawable.php';

use Sendstation\UI\IDrawable;

/**
 * Abstract class for form data input elements.
 * 
 * @author Joshua Graf
 */
abstract class FormElement implements IDrawable {

    /**
     * The name of the data after the form commit.
     */
    protected $elementName;

    private $elementId;
    private $elementLabel;
    private $labelSize;

    /**
     * The draw function of the actual input element.
     */
    protected abstract function drawFormElement($elementId) : void;

    public function __construct($id, $name, $label, $size) {

        $this->elementId = $id;
        $this->elementName = $name;
        $this->elementLabel = $label;
        $this->labelSize = $size;
    }

    public final function draw() {

        echo "<div class=\"mb-3\">";
        echo sprintf("<label for=\"#%s\" class=\"h%d\">%s</label>", 
                $this->elementId, $this->labelSize, $this->elementLabel);
        drawFormElement($elementId);
        echo "</div>";
    }
}

?>