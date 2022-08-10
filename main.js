
function registration() {
    var y = document.getElementById("registerbut");
    var x = document.getElementById("loginbut");
      y.style.display = "block";
      x.style.display = "none";
  }
function login() {
    var c = document.getElementById("loginbut");
    var v = document.getElementById("registerbut");
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
  
  document.getElementById("ads").addEventListener("mouseover", adsOver);
  let adski = [document.getElementById("adski"), document.getElementById("adski2"), document.getElementById("adski3")]
  adski.forEach(cuccok=>{cuccok.addEventListener("mouseover", kiadol)});
  
  
  function adsOver() {
    let menu = [document.getElementById("ads-menu1"), document.getElementById("ads-menu2"), document.getElementById("ads-menu3")]
    menu.forEach(elem =>{elem.style.display = "block"});
  }
  
  
  function kiadol(event) {
    let menu = [document.getElementById("ads-menu1"), document.getElementById("ads-menu2"), document.getElementById("ads-menu3"), document.getElementById("game-menu1"), document.getElementById("game-menu2"), document.getElementById("game-menu3")]
    menu.forEach(elem =>{elem.style.display = "none"});
  }


  let myInput = document.getElementById("passwd");
  let myInput2 = document.getElementById("passwd2");
  let letter = document.getElementById("letter");
  let capital = document.getElementById("capital");
  let number = document.getElementById("number");
  let length = document.getElementById("length");
  let letter2 = 0;
  let capital2 = 0;
  let number2 = 0;
  let length2 = 0;


myInput.onfocus = function() {
  myInput2.classList = 'loginobject psw-hide margin-fent';
  document.getElementById("message").classList = '';
}

myInput.onblur = function() {
  if(letter2 == 1 && capital2 == 1 && number2 == 1 && length2 == 1 ){
  document.getElementById("message").classList = 'displaycucc';
  myInput2.classList = 'loginobject psw-hide';
  }
}
myInput.onkeyup = function() {
  let lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
    letter2 = 1;
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
    letter2 = 0;
  }
  
  let upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
    capital2 = 1;
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
    capital2 = 0;
  }

  let numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
    number2 = 1;
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
    number2 = 0;
  }
  
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
    length2 = 1;
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
    length2 = 0;
  }
}
myInput2.onkeyup = function() {
  if(myInput.value == myInput2.value){
    document.getElementById("message2").classList = 'displaycucc';
  }
  else{
    document.getElementById("message2").classList = '';
  }
  }

}
function jelszonezes() {
  var x = document.getElementById("psw");
  if (x.type === "password") {
      x.type = "text";
  }
  else {
      x.type = "password";
  }
}

function jelszonezes2() {
  var x = document.getElementById("passwd");
  if (x.type === "password") {
      x.type = "text";
  }
  else {
      x.type = "password";
  }
}

