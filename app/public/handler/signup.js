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
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../api/auth/signup.php', true);
    xhr.onload = function(){
      if (this.status == 200){
        let response = JSON.parse(this.responseText);
        console.log(this.responseText);
        if (response.status == "success"){
          document.getElementById("email").style.borderColor = 'blue';
          document.getElementById("email-errmsg").innerHTML = "";
        } else {
          document.getElementById("email").style.borderColor = 'red';
          document.getElementById("email-errmsg").innerHTML = response.message;
        }
      }
      checkSubmitButton();
    }
    xhr.send(JSON.stringify({"email": email}));
  }
  checkSubmitButton();
}

function checkUsername() {
  let username = document.getElementById("username").value;
  let passed = username.match(/^[0-9a-zA-Z]*$/) && username.length >=5;
  
  if (!passed) {
    document.getElementById("username").style.borderColor = 'red';
    document.getElementById("username-errmsg").innerHTML = "Invalid username detected";
  } else {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../../api/auth/signup.php', true);
    xhr.onload = function(){
      if (this.status == 200){
        let response = JSON.parse(this.responseText);
        if (response.status == "success"){
          document.getElementById("username").style.borderColor = 'blue';
          document.getElementById("username-errmsg").innerHTML = "";
        } else {
          document.getElementById("username").style.borderColor = 'red';
          document.getElementById("username-errmsg").innerHTML = response.message;
        }
      }
      checkSubmitButton();
    }
    xhr.send(JSON.stringify({"username": username}));
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


