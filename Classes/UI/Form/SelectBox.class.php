<?php namespace Sandstation\UI\Form;

include_once 'FormElement.class.php';

/**
 * A form selection box input field.
 * 
 * @author Joshua Graf
 */
class SelectBox extends FormElement {

    private array $options;
    private $emptyOptionValue;

    /**
     * Sets the possible options.
     */
    public function setOptions(array $options) : void {

        $this->options = $options;
    }

    /**
     * Adds a new option or overrides its value.
     */
    public function setOption($option, $value) {

        $this->options[$option] = $value;
    }

    /**
     * Activates the empty option and sets its value.
     */
    public function setEmptyOption($value) {

        $this->emptyOptionValue = $value;
    }

    protected final function drawFormElement($elementId) : void {

        echo "<select class=\"form-control\" name=\"%s\" id=\"%s\">";

        if (isset($this->emptyOptionValue)) {

            echo sprintf("<option value=\"%d\">---</option>", $this->emptyOptionValue);
        }

        foreach ($this->options as $option => $value) {

            echo sprintf("<option value=\"%d\">%s</option>", $value, $option);
        }          

        echo "</select>";
    }
}

?>