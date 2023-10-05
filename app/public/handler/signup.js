function checkSubmitButton(){
  if (document.getElementById('email-errmsg').innerHTML == '' && document.getElementById('username-errmsg').innerHTML == '' && document.getElementById('password-errmsg').innerHTML == ''){
    document.getElementById('signup-button').disabled = false;
  } else {
    document.getElementById('signup-button').disabled = true;
  }
}

function checkEmail() {
  let email = document.getElementById("email").value;
  let passed = email.toLowerCase().match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/);
  if (!passed) {
    document.getElementById("email").style.borderColor = 'red';
    document.getElementById("email-errmsg").innerHTML = "Invalid email detected";
  } else {
    document.getElementById("email").style.borderColor = 'blue';
    document.getElementById("email-errmsg").innerHTML = "";
  }
  checkSubmitButton();
}

function checkUsername() {
  let username = document.getElementById("username").value;
  let passed = username.match(/^[0-9a-zA-Z]*$/) && username.length >=5;
  
  if (!passed){
    document.getElementById('username').style.borderColor = 'red';
    document.getElementById('username-errmsg').innerHTML = "Username can only be alphanumeric with at lease 5 characters long";
  } else {
    document.getElementById("username").style.borderColor = 'blue';
    document.getElementById('username-errmsg').innerHTML = "";
  }
  checkSubmitButton();
}

function checkPassword() {
  let password = document.getElementById("password").value;
  if (password.length >= 8){
    document.getElementById('password').style.borderColor = 'blue';
    document.getElementById('password-errmsg').innerHTML = '';
  } else {
    document.getElementById('password').style.borderColor = 'red';
    document.getElementById('password-errmsg').innerHTML = 'Password needs to be at lease 8 characters long.';
  }
  checkSubmitButton();
}


