let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   navbar.classList.remove('active');
}
function addTextBox(){
   var selectedValue=document.getElementById("options").Value;
   if(selectedValue==="credit card")
   {
var textbox=document.createElement("input");
textbox.type="text";
textbox.name="dynamicTextbox";
textbox.placeholder="enter text"
var container=document.getElementById("textboxContainer");
container.appendChild(textbox)
   }
}