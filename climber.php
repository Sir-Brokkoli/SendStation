<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/UI/ProgressDataSheet.class.php';

use Sendstation\UI\ProgressDataSheet;

\session_start();

$id = -1;
if (\key_exists('id', $_GET) && \is_numeric($_GET['id'])) {

    $id = $_GET['id'];
}
else if(isset($_SESSION['id'])) {

    $id = $_SESSION['id'];
}
else {

    die();
}

include('Style/header.php'); ?>

<div class="d-flex flex-column flex-fill bgTrain">
    <section class="p-5 mt-5">
        <div class="row g-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 p-3">
                <div class="card bg-dark text-light shadowbox mb-4">
                    <div class="card-body text-left">
                        <h3 class="card-title text-col1 my-3">Info</h3>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <h5>Name:</h5>
                                <p>Bananenbaron</p>
                                <h5>Description:</h5> 
                                <p>I bims, der Lockomotivenführer!!</p> 
                                <button class="btn btn-col2">Follow</button>
                            </div>
                            <div class="col-sm-6">
                                Picture here?
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card bg-dark text-light shadowbox mb-4">
                    <div class="card-body text-left">
                        <h3 class="card-title text-col1 my-3">Progress</h3>
                        <?php 
                        $sheet = new ProgressDataSheet($id);
                        $sheet->draw();
                        ?>
                    </div>
                </div>
                <div class="card bg-dark text-light shadowbox mb-4">
                    <div class="card-body text-left">
                        <h3 class="card-title text-col1 my-3">Achievements</h3>
                        To be implemented soon!
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>

<?php include('Style/footer.php'); ?>