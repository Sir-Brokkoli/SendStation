<?php namespace Sendstation\UI\Form;

include_once 'Classes\UI\Element.class.php';

use Sendstation\UI\Element;

/**
 * A data retrieval form.
 * 
 * @author Joshua Graf
 */
class Form extends Element {

    public function __construct($actionPath, $isPost = true) {

        parent::__construct("form");

        $this->setAnnotation("action", $actionPath);
        $this->setAnnotation("post", $isPost ? "post" : "get");

        $this->formElements = array();
        $this->hiddenElements = array();
    }
}

?>