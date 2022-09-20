<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/Crags/CragServiceImpl.php';

include_once 'Classes/UI/DataTable.class.php';
include_once 'Classes/UI/Controller/CragsTableController.class.php';

use Sendstation\UI\DataTable;
use Sendstation\UI\Controller\CragsTableController;

use Sendstation\Crags\CragServiceImpl;

include('Style/header.php');

$tableController = new CragsTableController(1);
if($tableController == null) { 

    echo "Failed to initialize table controller"; 
}

$id = (\key_exists('id', $_GET) && \is_numeric($_GET['id'])) ? $_GET['id'] : "";

$crags = CragServiceImpl::getInstance()->getCrags();
?>

<div class="d-flex flex-column flex-fill bgTrain">
    <section class="p-md-5 pt-5 mt-5">
        <div class="container">
            <select onchange="showCrag(this.value)">
                <option value = ""> - </option>
<?php
foreach ($crags as $crag) {

    echo "<option value=\"" . $crag->getId() . "\">" . $crag->getName() . "</option>";
}
?>
            </select>
            <button class="btn btn-dark px-2" data-bs-toggle="modal" data-bs-target="#editCragModal">New Crag</button>
            <div id="cragTable" class="py-5"></div>
        </div>
    </section>
</div>
<?php

include('Style/footer.php');
?>

<!-- Edit Route Modal -->
<div class="modal fade" id="editRouteModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="cragsManager.routeEditCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit route</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="#routeModal.idField" class="h6">Id</label>
                        <input type="text" class="form-control" name="id" id="routeModal.idField" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="#routeModal.cragIdField" class="h6">Crag Id</label>
                        <input type="text" class="form-control" name="cragId" id="routeModal.cragIdField" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="#routeModal.inputName" class="h6">Name</label>
                        <input type="text" class="form-control" name="name" id="routeModal.inputName">
                    </div>
                    <div class="mb-3">
                        <label for="#routeModal.inputGrade" class="h6">Grade</label>
                        <input type="text" class="form-control" name="grade" id="routeModal.inputGrade">
                    </div>
                    <div class="mb-3">
                        <label for="#routeModal.inputDescription" class="h6">Description</label>
                        <textarea class="form-control" name="description" id="routeModal.inputDescription" rows="5"></textarea>
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
<div class="modal fade" id="deleteRouteModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="cragsManager.routeDeleteCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Delete route</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sure you want to delete?</p>
                    <input type="hidden" class="form-control" name="id" id="routeModal.deleteId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">Delete</button>
                    </br>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- New Crag Modal -->
<div class="modal fade" id="newCragModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="cragsManager.cragEditCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">New crag</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="#newCragModal.idField" class="h6">Id</label>
                        <input type="text" class="form-control" name="id" id="newCragModal.idField" value="N/O" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="#newCragModal.inputName" class="h6">Name</label>
                        <input type="text" class="form-control" name="name" id="newCragModal.inputName" value="Crag Name">
                    </div>
                    <div class="mb-3">
                        <label for="#newCragModal.inputDescription" class="h6">Description</label>
                        <textarea class="form-control" name="description" id="newCragModal.inputDescription" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">Save</button>
                    </br>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Crag Modal -->
<div class="modal fade" id="editCragModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="cragsManager.cragEditCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit crag</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="#cragModal.idField" class="h6">Id</label>
                        <input type="text" class="form-control" name="id" id="cragModal.idField" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="#cragModal.inputName" class="h6">Name</label>
                        <input type="text" class="form-control" name="name" id="cragModal.inputName">
                    </div>
                    <div class="mb-3">
                        <label for="#cragModal.inputDescription" class="h6">Description</label>
                        <textarea class="form-control" name="description" id="cragModal.inputDescription" rows="5"></textarea>
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

<!-- Delete Crag Modal -->
<div class="modal fade" id="deleteCragModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="cragsManager.cragDeleteCommit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Delete crag</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Sure you want to delete?</p>
                    <input type="hidden" class="form-control" name="id" id="cragModal.deleteId">
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
function showCrag(id) {
    if (id == "") {

        document.getElementById("cragTable").innerHTML = "";
        return;
    }

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cragTable").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "cragsManager.routesRequest.php?q=" + id, true);
    xhttp.send();
}

document.getElementById("editRouteModal").addEventListener("show.bs.modal", function (event) {

    var id = event.relatedTarget.getAttribute('data-route-id');
    var row = document.getElementById("entry_" + id);

    document.getElementById("routeModal.idField").value = row.childNodes[0].innerHTML;
    document.getElementById("routeModal.inputName").value = row.childNodes[1].innerHTML;
    document.getElementById("routeModal.inputGrade").value = row.childNodes[2].innerHTML;
    document.getElementById("routeModal.inputDescription").innerHTML = row.childNodes[3].innerHTML;

    document.getElementById("routeModal.cragIdField").value = document.getElementById("cragId").innerHTML;
});

document.getElementById("deleteCragModal").addEventListener("show.bs.modal", function (event) {

    var id = event.relatedTarget.getAttribute('data-crag-id');

    document.getElementById("cragModal.deleteId").value = id;
});

document.getElementById("deleteRouteModal").addEventListener("show.bs.modal", function (event) {

    var id = event.relatedTarget.getAttribute('data-route-id');

    document.getElementById("routeModal.deleteId").value = id;
});

document.getElementById("editCragModal").addEventListener("show.bs.modal", function (event) {

    document.getElementById("cragModal.idField").value = document.getElementById("cragId").innerHTML;
    document.getElementById("cragModal.inputName").value = document.getElementById("cragName").innerHTML;
    document.getElementById("cragModal.inputDescription").innerHTML = document.getElementById("cragDescription").innerHTML;
});
</script>