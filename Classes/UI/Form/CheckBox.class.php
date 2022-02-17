<?php namespace Sandstation\UI\Form;

include_once 'FormElement.class.php';

/**
 * A form checkbox input field.
 *
 * @author Joshua Graf
 */
class CheckBox extends FormElement {

    private bool $defaultValue;

    public function __construct($id, $name, $label, $labelSize, bool $defaultValue = false) {

        parent::__construct($id, $name, $label, $labelSize);
        $this->defaultValue = $defaultValue;
    }

    protected final function drawFormElement($elementId) : void {

        echo sprintf("<input type=\"checkbox\" name=\"%s\" value=\"%s\" id=\"%s\">",
                $this->elementName, $this->defaultValue ? "on" : "off", $elementId);
    }
}

?>