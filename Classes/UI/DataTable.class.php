<?php namespace Sendstation\UI;

include_once 'IDrawable.php';
include_once 'Controller/IDataTableController.class.php';

use Sendstation\UI\Controller\IDataTableController;

class DataTable implements IDrawable {

    private $tableController;

    public function __construct($tableController) {

        $this->tableController = $tableController;
    }

    public function draw() {

        $columnScheme = $this->tableController->getScheme();

        echo "<table class=\"table table-bordered table-dark\">";
        echo "<thead><tr>";
        foreach ($columnScheme as $col) {

            echo "<th class=\"text-light\" scope=\"col\">" . $col . "</th>";
        }
        echo "<th class=\"text-light\" scope=\"col\">Controls</th>";
        echo "</tr></thead>";
        echo "<tbody>";

        while ($this->tableController->hasNext()) {

            $row = $this->tableController->getNextRow();

            echo "<tr>";
            foreach ($columnScheme as $col) {

                echo "<td>" . $row[$col] . "</td>";
            }
            echo "<td><button>Edit</button><button>Delete</button></td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
    }
}

?>