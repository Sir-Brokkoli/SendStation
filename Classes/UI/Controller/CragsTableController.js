class CragsTableController {

    constructor(containerId) {

        this.containerId = containerId;
    }

    showCrag(id) {

        if (id == "") {

            document.getElementById(this.containerId).innerHTML = "";
            return;
        }

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(containerId).innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "blabla.php?q=" + id, true);
        xhttp.send();
    }
}