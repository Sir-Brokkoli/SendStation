<?php namespace Sendstation\UI\Form;

include_once 'FormElement.class.php';

/**
 * A form number input field.
 * 
 * @author Joshua Graf
 */
class NumberField extends FormElement {

    private $min;
    private $max;
    private $step;
    private $value;

    public function setMin($min) {

        $this->min = $min;
    }

    public function setMax($max) {

        $this->max = $max;
    }

    public function setStep($step) {

        $this->step = $step;
    }

    public function setValue($value) {

        $this->value = $value;
    }

    protected final function drawFormElement($elementId) : void {

        echo sprintf("<input type=\"number\"%s%s%s%s class=\"form-control\" name=\"%s\" id=\"%s\">",
                isset($this->min) ? " min=\"%d\"" : "",
                isset($this->max) ? " max=\"%d\"" : "",
                isset($this->step) ? " step=\"%d\"" : "",
                isset($this->value) ? " value=\"%d\"" : "",
                $this->elementName);
    }
}

?>