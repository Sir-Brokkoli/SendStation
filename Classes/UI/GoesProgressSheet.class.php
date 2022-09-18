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
        echo "<table class=\"table table-dark\"><tbody>";
        echo "<tr class=\"h5\"><td>Sessions:</td><td>{$this->sessions}</td></tr>";
        echo "<tr class=\"h5\"><td>Goes:</td><td>{$this->goes}</td></tr>";
        echo "<tr class=\"h5\"><td>Falls:</td><td>{$this->totalFalls}</td></tr>";
        echo "</tbody></table>";
        echo "</div>";
        echo "<div class=\"col-sm-6\">";
        echo "<table class=\"table table-dark\"><tbody>";
        echo "<tr class=\"h5\"><td>Avg goes:</td><td>{$avgGoes}</td></tr>";
        echo "<tr class=\"h5\"><td>Avg falls:</td><td>{$avgFalls}</td></tr>";
        echo "<tr class=\"h5\"><td>Max falls:</td><td>{$this->maxFalls}</td></tr>";
        echo "</tbody></table>";
        echo "</div>";
        echo "</div>";
    }
}