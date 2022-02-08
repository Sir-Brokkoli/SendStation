<?php 
namespace Sendstation\UI;

use Sendstation\Route;

include_once 'IDrawable.php';
include_once 'Route.class.php';

class ActiveSessionRouteCard implements IDrawable{

    private $route;
    private $numGoes;
    private $wasSent;
    private $wasToproped;

    public function __construct($route, $numGoes, $wasSent, $wasToproped){
        $this->route = $route;
        $this->numGoes = $numGoes;
        $this->wasSent = $wasSent;
        $this->wasToproped = $wasToproped;
    }

    public function draw(){
        //Change background-color if route was sent in toprope or lead
        $bgColor = $this->selectBackgroundColor();

        echo "<div class=\"card " . $bgColor . " text-dark my-1 p-1\">" .
                "<div class=\"row g-2 align-items-center justify-content-between text-center\">" .
                    "<div class=\"col-md-6 text-left\">" .
                        "<h5>" . $this->route->getName() . "</h5>" .
                    "</div>" .
                    "<div class=\"col-md-1 text-left\">" .
                        "<h5>" . $this->route->getGrade() . "</h5>" .
                    "</div>" .
                    "<div class=\"col-md-2\">" .
                        "<h6>" . $this->numGoes . ($this->numGoes == 1 ? " Go" : " Goes") . "</h6>" .
                    "</div>" .
                    "<div class=\"col-md-3\">" .
                        "<span>" .
                            "<button type=\"button\" class=\"btn btn-col2 text-light mx-2\" data-bs-toggle=\"modal\" data-bs-target=\"#addGoModal\" data-route-id=\"" . $this->route->getId() . "\" " . ($this->wasSent ? "disabled" : "") . ">Add Go</button>" .
                            //"<button type=\"button\" class=\"btn btn-secondary btn-close\"></button>" .
                        "</span>" .
                    "</div>" .
                "</div>" .
            "</div>";
    }

    private function selectBackgroundColor(){
        $bgColor = "bg-light";
        if($this->wasSent){
            $bgColor = "bg-col1";
        }
        else if($this->wasToproped){
            $bgColor = "bg-secondary";
        }

        return $bgColor;
    }
}