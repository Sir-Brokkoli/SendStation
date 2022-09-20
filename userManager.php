<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/Users/ClimberServiceImpl.php';

include_once 'Classes/UI/DataTable.class.php';
include_once 'Classes/UI/Controller/CragsTableController.class.php';

require_once 'Classes/Security/AuthenticationFailureException.php';

use Sendstation\UI\DataTable;
use Sendstation\UI\Controller\CragsTableController;

use Sendstation\Users\ClimberServiceImpl;

use Sendstation\Security\AuthenticationFailureException;

include('Style/header.php');
$climbers;
try {
    $climbers = ClimberServiceImpl::getInstance()->getAllClimbers();
} catch (AuthenticationFailureException $e) { $climbers = array(); }
?>

<div class="d-flex flex-column flex-fill bgTrain">
    <section class="p-md-5 pt-5 mt-5">
        <div class="container">
            <div id="cragTable" class="py-5">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th class="text-light" scope="col">Id</th>
                            <th class="text-light" scope="col">Username</th>
                            <th class="text-light" scope="col">Email</th>
                            <th class="text-light" scope="col">Reg Date</th>
                            <th class="text-light" scope="col">Controls</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

foreach ($climbers as $climber) {

    echo "<tr id=\"entry_{$climber->getId()}\">
        <td>{$climber->getId()}</td>
        <td>{$climber->getNickname()}</td>
        <td>{$climber->getEmail()}</td>
        <td>{$climber->getRegistrationDate()}</td>
        <td>
            <button class=\"btn btn-light px-2\" data-bs-toggle=\"modal\" data-bs-target=\"#editClimberModal\">Edit</button>
            <button data-bs-toggle=\"modal\" data-bs-target=\"#deleteClimberModal\" data-climber-id=\"{$climber->getId()}\" class=\"btn btn-dark px-2\">Delete</button>
        </td></tr>";
}

?>
                        <tr id="entry_new">
                            <td>new</td><td></td><td></td><td></td>
                            <td>
                                <button class="btn btn-light px-2" data-bs-toggle="modal" data-bs-target="#editClimberModal">New User</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php

include('Style/footer.php');
?>

<!-- Edit Route Modal -->
<div class="modal fade" id="editClimberModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="userManager.climberEditCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit climber</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="#climberModal.id" class="h6">Id</label>
                        <input type="text" class="form-control" name="id" id="climberModal.id" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="#climberModal.username" class="h6">Username</label>
                        <input type="text" class="form-control" name="username" id="climberModal.username">
                    </div>
                    <div class="mb-3">
                        <label for="#climberModal.email" class="h6">Email</label>
                        <input type="text" class="form-control" name="email" id="climberModal.email">
                    </div>
                    <div class="mb-3">
                        <label for="#climberModal.regdate" class="h6">Reg date</label>
                        <input type="text" class="form-control" name="regdate" id="climberModal.regdate" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">Save edit</button>
                    </br>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Route Modal -->
<div class="modal fade" id="deleteClimberModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="cragsManager.routeDeleteCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Delete route</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sure you want to delete?</p>
                    <input type="hidden" class="form-control" name="id" id="climberModal.deleteId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">Delete</button>
                    </br>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Fetch route edit modal data
document.getElementById("editRouteModal").addEventListener("show.bs.modal", function (event) {

    var id = event.relatedTarget.getAttribute('data-climber-id');
    var row = document.getElementById("entry_" + id);

    document.getElementById("climberModal.id").value = row.childNodes[0].innerHTML;
    document.getElementById("climberModal.username").value = row.childNodes[1].innerHTML;
    document.getElementById("climberModal.email").value = row.childNodes[2].innerHTML;
    document.getElementById("climberModal.regdate").innerHTML = row.childNodes[3].innerHTML;
});

// Fetch route delete data
document.getElementById("deleteClimberModal").addEventListener("show.bs.modal", function (event) {

    var id = event.relatedTarget.getAttribute('data-climber-id');

    document.getElementById("climberModal.deleteId").value = id;
});
</script>