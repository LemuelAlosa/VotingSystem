//STUDENT SHOW/HiDE PASSWORD
function studentPasswordshowhide() {
    var passwordInput = document.getElementById('studentpassword');
    var hidepassword = $("#hide");
    var showpassword = $("#show");
  
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      hidepassword.css("display", "none");
      showpassword.css("display", "block");
    } else {
      passwordInput.type = "password";
      showpassword.css("display", "none");
      hidepassword.css("display", "block");
    }
}

function seeResult(){
  window.location.href = './result_section/index.php';
}