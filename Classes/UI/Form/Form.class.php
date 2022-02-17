<?php namespace Sendstation\UI\Form;

include_once 'Classes\UI\IDrawable.php';

use Sendstation\UI\IDrawable;

/**
 * A data retrieval form.
 * 
 * @author Joshua Graf
 */
class Form implements IDrawable {

    private $actionPath;
    private bool $isPost;

    private array $formElements;
    private array $hiddenElements;

    public function __construct($actionPath, $isPost = true) {

        $this->actionPath = $actionPath;
        $this->isPost = $isPost;

        $this->formElements = array();
        $this->hiddenElements = array();
    }

    public function draw() : void {

        echo sprintf("<form action=\"%s\" method=\"%s\">", $this->actionPath, $this->isPost ? "post" : "get");

        foreach ($this->formElements as $element) {

            $element->draw();
        }

        echo "</form>";
    }

    /**
     * Adds a form element for data input.
     */
    public function addFormElement(FormElement $formElement) : void {

        array_push($this->formElements, $formElement);
    }

    /**
     * Adds a hidden form element to include additional hidden data in the form.
     */
    public function addHiddenElement(HiddenElement $hiddenElement) : void {

        array_push($this->hiddenElements, $hiddenElement);
    }
}

?>