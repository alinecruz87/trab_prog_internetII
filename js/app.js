const voluntarioController =  new VoluntarioController();
const diaristaController =  new DiaristaController();

var body = document.querySelector("body");
body.onload = function () {
    document.querySelector("main").innerHTML = "<h2>HOME</h2>";
}

document.querySelector("#home").onclick = function() {
    document.querySelector("main").innerHTML = "<h2>HOME</h2>";
}


document.querySelector("#diaristas").onclick = function() {
    diaristaController.inicializa();
}


document.querySelector("#voluntarios").onclick = function() {
    voluntarioController.inicializa();
}

document.querySelector("#sobre").onclick = function() {
    document.querySelector("main").innerHTML = "<h2>by Aline Cruz</h2>";
}


