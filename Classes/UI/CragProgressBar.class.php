<?php namespace Sendstation\UI;

include_once 'IDrawable.php';

class CragProgressBar implements IDrawable {

    private string $title;
    private int $maxValue;
    private int $value;

    private bool $striped;
    private string $backgroundClass = "";

    public function __construct(string $title, int $maxValue, int $value, bool $striped = false) {

        $this->title = $title;
        $this->maxValue = $maxValue;
        $this->value = $value;
        $this->striped = $striped;
    }

    public function draw() :void {

        $progress = $this->value / $this->maxValue * 100;
        $stripedStr = $this->striped ? " progress-bar-striped" : "";

        echo "<h5>{$this->title} ({$this->value}/{$this->maxValue})</h5>";
        echo "<div class=\"progress my-3\">";
        echo "<div class=\"progress-bar{$stripedStr} {$this->backgroundClass}\" role=\"progressbar\" style=\"width: {$progress}%\"></div>";
        echo "</div>";
    }

    public function setBackgroundClass(string $value) {

        $this->backgroundClass = $value;
    }
}

?>