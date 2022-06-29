const side = document.getElementById('side_bar');
side.classList.add('display_none');


var txtPass = document.getElementById("textPassword");
var btnEye = document.getElementById("buttonEye");

btnEye.addEventListener("click",(e) => {
  e.preventDefault(); 
  if (txtPass.type === "text") {
      txtPass.type = "password";
      btnEye.className = "fa fa-eye";
    } else {
      txtPass.type = "text";
      btnEye.className = "fa fa-eye-slash";
    }
  });
