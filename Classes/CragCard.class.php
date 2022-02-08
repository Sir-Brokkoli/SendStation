<?php 
namespace Sendstation\UI;

include_once 'IDrawable.php';

class CragCard implements IDrawable{

    private $crag;
    private $routes;

    public function __construct($crag, $routes){
        $this->crag = $crag;
        $this->routes = $routes;
    }

    public function draw(){

        echo "<div class=\"col-md-4\">";
        echo "<div class=\"card bg-dark text-light\" style=\"box-shadow: 7px 5px 5px rgb(0.9,0.9,0.9);\">";
        echo "<div class=\"card-body text-center\">";

        echo "<h3 class=\"card-title text-col1 my-3\">" . $this->crag->getName() . "</h3>";     
        echo "<p class=\"card-text mb-3\">" . $this->crag->getDescription() . "</p>";
        echo "<p class=\"h3 mb-3\">~</p>";

        echo "<table class=\"table table-bordered table-dark\">";
        echo "<thead><tr><th class=\"text-light\" scope=\"col\">Grade</th><th class=\"text-light\" scope=\"col\">Route Name</th></tr></thead>";
        echo "<tbody>";

        foreach($this->routes as $route){
            echo "<tr>";
            echo "<td>" . $route->getGrade() . "</td>";
            echo "<td>" . $route->getName() . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table></div></div></div>";
    }
}