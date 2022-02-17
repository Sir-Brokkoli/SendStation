<?php 
namespace Sendstation;

include('Style/header.php');

require_once('Classes/CragHandler.class.php'); 

?>

<div class="d-flex flex-column flex-fill bgQuickdraws">
    <section class="p-5 mt-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8 p-3">
                    <div class="card bg-col2 text-light shadowbox mb-4">
                        <div class="card-body">
                            <h2 class="card-title my-2">Welcome back <?php echo $_SESSION['nickname']; ?>!</h2>
                            <p id="demo"></p>
                            <p class="card-text">This is your personal page where you can manage your profile, register and review sessions and check for the state of the challange.</p>
                        </div>
                    </div>
                    <div class="card bg-dark text-light shadowbox mb-4">
                        <div class="card-body text-left">
                            <h3 class="card-title text-col1 my-3">Active sessions</h3>
                            <?php include('UI/activeSession.ui.php'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-3">
                    <div class="card bg-dark text-light shadowbox">
                        <div class="card-body text-left">
                            <h3 class="card-title text-col1 my-3">Newsticker</h3>
                            <div class="card-body">
                                <div class="card bg-col2-light p-3">
                                    <div class="card bg-dark text-light my-1 px-1">
                                        <div class="card-body row">
                                            <div class="col-10">
                                                <p class="card-text"><span class="text-col1">Bananenbaron</span> had a session at Dschungelbuch</p>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-sm btn-dark m-auto p-auto"><i class="bi bi-heart-fill text-col1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-dark text-light my-1 px-1">
                                        <div class="card-body row">
                                            <div class="col-10">
                                                <p class="card-text">
                                                    <span class="text-col1">Bananenbaron</span> sended Haifisch (7a).</br>
                                                    <small>- Yesterday, 19:34</small>
                                                </p>
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-sm btn-dark m-auto p-auto"><i class="bi bi-heart-fill text-col1"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php include('UI/ticker.ui.php'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Start Session Modal -->
<div class="modal fade" id="startSessionModal">
    <div class="modal-dialog">
        <form action="startSession.commit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Start an active session!</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="#inputCrag" class="h6">Crag</label>
                        <select class="form-control" name="crag" id="inputCrag">
                            <option value="-1"> --- </option>
                            <?php
                            $crags = CragHandler::getCrags();

                            foreach($crags as $crag){
                                echo "<option value=\"" . $crag->getId() . "\">";
                                echo $crag->getName();
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="#inputEco" class="h6">
                            Eco-friendly (bike, public transport)
                        </label>
                        <input type="checkbox"  name="eco" id="inputEco">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Start session!</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Go Modal -->
<div class="modal fade" id="addGoModal">
    <div class="modal-dialog modal-dialog-centered">
        <form action="addGo.commit.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Had a go?</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="#inputFalls" class="h6">Number of falls</label>
                        <input type="number" min="0" step="1" value="0" class="form-control" name="falls" id="inputFalls">
                    </div>
                    <div class="mb-3">
                        <label for="#inputToprope" class="h6">
                            <input type="checkbox" name="toprope" id="inputToprope">
                            Toprope ascend
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="#inputSend" class="h6">
                            <input type="checkbox" name="send" id="inputSend">
                            Lead ascend
                        </label>
                    </div>
                    <div>
                        <input type="hidden" name="id_route" id="hiddenRouteId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mx-auto">Enter!</button>
                    </br>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
var modal = document.getElementById("addGoModal");

modal.addEventListener("shown.bs.modal", function (event) {
    element = document.getElementById("hiddenRouteId");

    var routeId = event.relatedTarget.getAttribute('data-route-id');

    element.value = routeId;
});
</script>

<!-- Delete Active Session Modal -->
<div class="modal fade" id="delActiveSessionModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Discard active session</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-text">
                    Are you sure you want to discard your active session? All information will be lost.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a type="button" class="btn btn-col2 text-light" href="cancelActiveSession.commit.php">Discard</a>
                </br>
            </div>
        </div>
    </div>
</div>

<!-- Finish Active Session Modal -->
<div class="modal fade" id="finishSessionModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Finish active session</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-text">
                    Are you sure you want to finish your active session? The session cannot be modified afterwards. Be sure all your goes are logged.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a type="button" class="btn btn-col2 text-light" href="finishSession.commit.php">Send it!</a>
                </br>
            </div>
        </div>
    </div>
</div>

<?php include('Style/footer.php'); ?>