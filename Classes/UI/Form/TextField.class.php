<?php namespace Sendstation\UI\Form;

include_once 'FormElement.class.php';

/**
 * A form text input field.
 * 
 * @author Joshua Graf
 */
class TextField extends FormElement {

    public const TEXT = "text";
    public const EMAIL = "email";
    public const PASSWORD = "password";

    private $fieldType;

    public function __construct(string $id, string $name, string $label, int $size, string $fieldType = self::TEXT_TYPE) {

        parent::__construct($id, $name, $label, $size);

        $this->fieldType = $fieldType;
    }

    protected final function drawFormElement($elementId) : void {

        echo sprintf("<input type=\"%s\" class=\"form-control\" name=\"%s\" id=\"%s\">",
                $this->fieldType, $this->elementName, $elementId);
    }
}

?>