<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/UI/ProgressDataSheet.class.php';
include_once 'Classes/Users/ClimberRepositoryImpl.php';

use Sendstation\UI\ProgressDataSheet;
use Sendstation\Users\ClimberRepositoryImpl;

\session_start();

$isLoggedInClimber = false;

$id = -1;
if (\key_exists('id', $_GET) && \is_numeric($_GET['id'])) {

    $id = $_GET['id'];
    $isLoggedInClimber = isset($_SESSION['id']) ? ($id == $_SESSION['id']) : false;
}
else if(isset($_SESSION['id'])) {

    $id = $_SESSION['id'];
    $isLoggedInClimber = true;
}
else {

    die();
}

$displayedClimber = ClimberRepositoryImpl::getInstance()->findById($id);

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
                                <p> <?= $displayedClimber->getNickname(); ?></p>
                                <h5>Description:</h5> 
                                <p><?= $displayedClimber->getDescription(); ?></p> 
                                <button class="btn btn-col2"><?= $isLoggedInClimber ? "Edit" : "Follow" ?></button>
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
                        $sheet = new ProgressDataSheet($id, true);
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