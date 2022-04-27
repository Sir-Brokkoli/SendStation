<?php namespace Sendstation\UI;

include_once 'IDrawable.php';

class GoesProgressSheet implements IDrawable {

    private int $sessions;
    private int $goes;
    private int $totalFalls;
    private int $maxFalls;

    public function __construct(int $sessions, int $goes, int $totalFalls, int $maxFalls) {

        $this->sessions = $sessions;
        $this->goes = $goes;
        $this->totalFalls = $totalFalls;
        $this->maxFalls = $maxFalls;
    }

    public function draw() :void {

        $avgGoes = $this->sessions == 0 ? "0" : \number_format($this->goes / $this->sessions, 2);
        $avgFalls = $this->goes == 0 ? "0" : \number_format($this->totalFalls / $this->goes, 2);

        echo "<div class=\"row g-3\">";
        echo "<div class=\"col-sm-6\">";
        echo "<h5>Sessions: {$this->sessions}</h5>";
        echo "<h5>Goes: {$this->goes}</h5>";
        echo "<h5>Falls: {$this->totalFalls}</h5>";
        echo "</div>";
        echo "<div class=\"col-sm-6\">";
        echo "<h5>Avg goes: {$avgGoes}</h5>";
        echo "<h5>Avg falls: {$avgFalls}</h5>";
        echo "<h5>Max falls: {$this->maxFalls}</h5>";
        echo "</div>";
        echo "</div>";
    }
}