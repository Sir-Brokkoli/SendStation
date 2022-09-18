<?php namespace Sendstation\UI;

include_once 'IDrawable.php';
include_once 'CragProgressBar.class.php';
include_once 'GoesProgressSheet.class.php';

include_once 'Classes/Sessions/GoRepositoryImpl.php';

use Sendstation\Sessions\GoRepositoryImpl;

class ProgressDataSheet implements IDrawable {

    private bool $showMoreCrags = false;

    private array $cragProgressBars;
    private CragProgressBar $overallProgressBar;
    private GoesProgressSheet $goesProgressSheet;

    public function __construct(int $climberId, $showMoreCrags = false) {

        $this->showMoreCrags = $showMoreCrags;
        $this->fetchData($climberId);
    }

    public function draw() :void {

        echo "<div class=\"row g-3\">";
        echo "<div class=\"col-lg-6 p-3\">";

        $max = min($this->showMoreCrags ? 10 : 3, count($this->cragProgressBars));
        for ($i = 0; $i < $max; $i++) {
            $this->cragProgressBars[$i]->draw();
        }

        $btnText = $this->showMoreCrags ? "less" : "more";
        echo "<button class=\"btn btn-secondary\">Show {$btnText}</button>";
        echo "</div>";
            
        echo "<div class=\"col-lg-6 p-3\">";
        $this->overallProgressBar->draw();
            
        $this->goesProgressSheet->draw();
        echo "</br>";
        /*echo "<h5>Unfinished business:</h5>";
        echo "<ul>";
        echo "<li>Famouse potatoes of Idaho (3 Goes)</li>";
        echo "<li>Nackter Tiroler (1 Goes)</li>";
        echo "</ul>";*/
        echo "</div>";
        echo "</div>";
    }

    public function showMore(bool $value) {

        $this->showMoreCrags = $value;
    }

    private function fetchData(int $climberId) :void {

        $cragsData = GoRepositoryImpl::getInstance()->accummulateSendCountPerCrag($climberId);

        $totalSends = 0;
        $totalRoutes = 0;

        $this->cragProgressBars = array();

        while ($crag = $cragsData->fetch_assoc()) {
            $bar = new CragProgressBar($crag['name'], $crag['total'], $crag['sends']);
            array_push($this->cragProgressBars, $bar);

            $totalSends += $crag['sends'];
            $totalRoutes += $crag['total'];
        }

        $this->overallProgressBar = new CragProgressBar("Overall", $totalRoutes, $totalSends);
        $this->overallProgressBar->setBackgroundClass("bg-warning");

        $goesData = GoRepositoryImpl::getInstance()->accummulateGoesData($climberId)->fetch_assoc();

        $this->goesProgressSheet = new GoesProgressSheet(intval($goesData['sessions']), intval($goesData['goes']), 
                                                    intval($goesData['falls']), intval($goesData['mostFalls']));
    }
}

?>