<?php namespace Sendstation\UI\Modal;

include_once 'Classes/IDrawable.php';

use Sendstation\UI\IDrawable;

class ModalTitleHeader implements IDrawable {

    private string $title;
    private int $titleSize;
    private bool $closeButton;

    public function __construct(string $title, int $titleSize = 6, bool $closeButton = true) {

        $this->title = $title;
        $this->titleSize = $titleSize;
        $this->closeButton = $closeButton;
    }

    public function draw() : void {

        echo "<div class=\"modal-header\">";
        echo "<h" . $this->titleSize . " class=\"modal-title\">" . $this->title . "</h" . $this->titleSize . ">";
        if ($this->closeButton) {

            echo "<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>";
        }
        echo "</div>";
    }

    public function hasCloseButton(bool $value) : void {

        $this->closeButton = $value;
    }
}

?>