
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
function szerverkatt(){
  window.location = '../index.html';
}
//Menü
window.onload=function(){

//Regisztráció/Belépéshez használt változók
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
  document.getElementById("message").classList = '';
}

myInput.onblur = function() {
  if(letter2 == 1 && capital2 == 1 && number2 == 1 && length2 == 1 ){
  document.getElementById("message").classList = 'displaycucc';
  }
}
//A regisztráción belül a jelszónál bizonyos követelmények
myInput.onkeyup = function() {
  if(myInput2.value == myInput.value){
    document.getElementById("message2").classList = 'displaycucc';
    if(letter2 == 1 && capital2 == 1 && number2 == 1 && length2 == 1 ){
      myInput.classList = 'sarga loginobject psw-hide';
      myInput2.classList = 'sarga loginobject psw-hide';
    }
  }
  if(myInput2.value != myInput.value){
    document.getElementById("message2").classList = '';
    myInput2.classList = 'piros loginobject psw-hide';
    myInput.classList = 'piros loginobject psw-hide';
  }
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
//Regisztráció/Bejelentkezésnél gombnál az üresen hagyott kifejezéseket pirosra váltja, jelszavak nem egyeznek felirat megjelenitése/eltüntetése
myInput2.onkeyup = function() {
  if(myInput2.value == myInput.value){
    document.getElementById("message2").classList = 'displaycucc';
    if(letter2 == 1 && capital2 == 1 && number2 == 1 && length2 == 1 ){
      myInput2.classList = 'sarga loginobject psw-hide';
      myInput.classList = 'sarga loginobject psw-hide';
    }
  }
  if(myInput2.value != myInput.value){
    document.getElementById("message2").classList = '';
    myInput.classList = 'piros loginobject psw-hide';
    myInput2.classList = 'piros loginobject psw-hide';
  }
  }

let regist = document.getElementById('reg-button');
let email = document.getElementById('email');
let user = document.getElementById('username');
let uname = document.getElementById("usernamefirst");
let psw = document.getElementById("passwordfirst");
let logi = document.getElementById("logi");
psw.onkeyup = function(){
  if(psw.value != ""){
    psw.classList = 'sarga loginobject psw-hide';
  }
}
uname.onkeyup = function(){
  if(uname.value != ""){
    uname.classList = 'sarga loginobject';
  }
}
logi.onclick = function(){
  if(uname.value == ""){
    uname.classList = 'piros loginobject';
  }
  if(psw.value == ""){
    psw.classList = 'piros loginobject psw-hide';
  }
}
email.onkeyup = function(){
  if(email.value.includes("@") == true){
    email.classList = 'sarga loginobject';
  }
  if(email.value.includes("@") == false){
    email.classList = 'piros loginobject';
  }
}
user.onkeyup = function(){
  if(user.value != ""){
    user.classList = 'sarga loginobject';
  }
}


regist.onclick = function(){
  if(myInput.value == ""){
    myInput.classList = 'piros loginobject psw-hide';
  }
  if(myInput2.value == ""){
    myInput2.classList = 'piros loginobject psw-hide';
  }
  if(email.value.includes("@") == true){
    email.classList = 'sarga loginobject';
  }
  if(email.value == ""){
    email.classList = 'piros loginobject';
  }
  if(user.value == ""){
    user.classList = 'piros loginobject';
  }
}
  
}
// Jelszó megjelenítése / eltünetése gombbal 
function jelszonezes() {
  var x = document.getElementById("passwordfirst");
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

//itt kezdodik a keop valtozás

let slideIndex = 0;
showSlides();
        
function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 1500);
    }