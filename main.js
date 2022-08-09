
function registration() {
    var y = document.getElementById("registerbut");
    var x = document.getElementById("loginbut");
      y.style.display = "block";
      x.style.display = "none";
  }
function login() {
    var c = document.getElementById("loginbut");
    var v = document.getElementById("registerbut")
      c.style.display = "block";
      v.style.display = "none";
}

window.onload=function(){
document.getElementById("subscriber").addEventListener("mouseover", mouseOver);
let subki = [document.getElementById("subki"), document.getElementById("subki2"), document.getElementById("subki3")]
subki.forEach(cuccok=>{cuccok.addEventListener("mouseover", mouseOut)});



function mouseOver() {
  let menu = [document.getElementById("sub-menu"), document.getElementById("sub-menu2"), document.getElementById("sub-menu3")]
  menu.forEach(elem =>{elem.style.display = "block"});
}


function mouseOut() {
  let menu = [document.getElementById("sub-menu"), document.getElementById("sub-menu2"), document.getElementById("sub-menu3")]
  menu.forEach(elem =>{elem.style.display = "none"});
}
}
