<?php namespace Sendstation\UI\Form;

include_once 'Form.class.php';

include_once 'FormElement.class.php';
include_once 'HiddenField.class.php';

include_once 'TextField.class.php';
include_once 'NumberField.class.php';
include_once 'CheckBox.class.php';
include_once 'SelectBox.class.php';

/**
 * The builder class for compact form creation.
 * 
 * @author Joshua Graf
 */
final class FormBuilder {

    private Form $form;

    private function __construct($actionPath, $usePost = true) {

        $this->form = new Form($actionPath, $usePost);
    }

    /**
     * Returns a new form builder for with the given commit path and commit type.
     * 
     * @param string $actionPath The path to the commit handler file.
     * @param bool $usePost Determines usage of post or get system.
     * 
     * @return FormBuilder A form builder instance.
     */
    public static function form(string $actionPath, bool $isPost = true) : FormBuilder {

        return new FormBuilder($actionPath, $isPost = true);
    }

    /**
     * Finishes the build.
     * 
     * @return Form The builded form instance.
     */
    public function build() : Form {

        return $this->form;
    }

    /**
     * Adds a standard text input field to the form.
     * 
     * @param string $id The HTML id of the input field.
     * @param string $name The commit name of the input field.
     * @param string $label The label text of the input field.
     * @param int $labelSize The size of the label text (1-6).
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addTextField(string $id, string $name, string $label, int $labelSize) : FormBuilder {

        $textElement = new TextField($id, $name, $label, $labelSize, TextField::TEXT);
        $this->form->addContent($textElement);

        return $this;
    }

    /**
     * Adds an email text input field to the form.
     * 
     * @param string $id The HTML id of the input field.
     * @param string $name The commit name of the input field.
     * @param string $label The label text of the input field.
     * @param int $labelSize The size of the label text (1-6).
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addEmailField(string $id, string $name, string $label, int $labelSize) : FormBuilder {

        $textElement = new TextField($id, $name, $label, $labelSize, TextField::EMAIL);
        $this->form->addContent($textElement);

        return $this;
    }

    /**
     * Adds a password input field to the form.
     * 
     * @param string $id The HTML id of the input field.
     * @param string $name The commit name of the input field.
     * @param string $label The label text of the input field.
     * @param int $labelSize The size of the label text (1-6).
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addPasswordField(string $id, string $name, string $label, int $labelSize) : FormBuilder {

        $textElement = new TextField($id, $name, $label, $labelSize, TextField::PASSWORD);
        $this->form->addContent($textElement);

        return $this;
    }

    /**
     * Adds a number input field to the form.
     * 
     * @param string $id The HTML id of the input field.
     * @param string $name The commit name of the input field.
     * @param string $label The label text of the input field.
     * @param int $labelSize The size of the label text (1-6).
     * @param array $range The allowed range of the number as array [min, max].
     * @param $step The step size.
     * @param $value The initial value of the input field.
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addNumberField(string $id, string $name, string $label, int $labelSize, 
                            array $range = null, $step = null, $value = null) : FormBuilder {

        $numberField = new NumberField($id, $name, $label, $labelSize);
        
        if(isset($range)) {

            if(isset(range[0])) {

                $numberField->setMin(range[0]);
            }

            if(isset(range[1])) {

                $numberField->setMax(range[1]);
            }
        }

        $numberField->setStep($step);
        $numberField->setValue($value);

        $this->form->addContent($numberField);

        return $this;
    }

    /**
     * Adds a check box input field to the form.
     * 
     * @param string $id The HTML id of the input field.
     * @param string $name The commit name of the input field.
     * @param string $label The label text of the input field.
     * @param int $labelSize The size of the label text (1-6).
     * @param bool $defaultValue The initial state of the checkbox.
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addCheckBox(string $id, string $name, string $label, int $labelSize, 
                            bool $defaultValue = false) : FormBuilder {

        $checkBox = new CheckBox($id, $name, $label, $labelSize, $defaultValue);

        $this->form->addContent($checkBox);

        return $this;
    }

    /**
     * Adds a select box input field to the form.
     * 
     * @param string $id The HTML id of the input field.
     * @param string $name The commit name of the input field.
     * @param string $label The label text of the input field.
     * @param int $labelSize The size of the label text (1-6).
     * @param array $options The options of the input field.
     * @param $emptyOption The value of the empty option if not null.
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addSelectBox(string $id, string $name, string $label, int $labelSize, 
                            array $options, $emptyOption = null) : FormBuilder {

        $selectBox = new SelectBox($id, $name, $label, $labelSize);
        $selectBox->setOptions($options);
        $selectBox->setEmptyOption($emptyOption);

        $this->form->addContent($selectBox);

        return $this;
    }

    /**
     * Adds a hidden field to the form.
     * 
     * @param string $id The HTML id of the hidden field.
     * @param string $name The commit name of the hidden field.
     * 
     * @return FormBuilder The updated form builder instance.
     */
    public function addHidden($id, $name) : FormBuilder {

        $hiddenField = new HiddenField($id, $name);
        $this->form->addContent($hiddenField);

        return $this;
    }
}

?>