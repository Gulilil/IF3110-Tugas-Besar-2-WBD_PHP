function openModal(button){
  const clientId = button.getAttribute('data-client-id');
  const username = button.getAttribute('data-username');
  const email = button.getAttribute('data-email');
  const password = button.getAttribute('data-password');
  const birthdate = button.getAttribute('data-birthdate');
  const bio = button.getAttribute('data-bio');
  const imagePath = button.getAttribute('data-image');

  // Populate the modal's fields with the extracted data
  document.getElementById('editClientId').value = clientId;
  document.getElementById('editUsername').value = username;
  document.getElementById('editEmail').value = email;
  document.getElementById('editPassword').value = password;
  document.getElementById('editBio').value = bio;

  const imageElement = document.getElementById('currentImage');
  if(imagePath) {
      imageElement.src = imagePath;
      imageElement.alt = "Current Image";
      imageElement.style.display = "";  // show image
  } else {
      imageElement.style.display = "none";  // hide image
  }
  
  
  if (birthdate) {
      document.getElementById('editBirthdate').value = birthdate;
  } else {
      document.getElementById('editBirthdate').value = null;
  }

  // Display the modal
  document.getElementById('edit-modal').style.display = 'block';
}

function closeModal(){
  document.getElementById('edit-modal').style.display = 'none';
}