function showTable(tableId) {
  // Hide all tables
  const tables = document.querySelectorAll(".table");
  tables.forEach((table) => {
    table.style.display = "none";
  });

  // Remove active class from all menu items
  const menuItems = document.querySelectorAll(".menu-item");
  menuItems.forEach((item) => {
    item.classList.remove("active");
  });

  // Show the selected table
  document.getElementById(tableId).style.display = "block";

  // Add the active class to the clicked menu item
  const activeMenu = Array.from(menuItems).find((item) =>
    item.getAttribute("onclick").includes(tableId)
  );
  activeMenu.classList.add("active");
}

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".delete-btn-client").forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      let clientId = e.target.getAttribute("client-id");

      if (confirm("Are you sure you want to delete this client?")) {
        window.location.href = `/api/client/delete.php?id=${clientId}`;
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".delete-btn-anime").forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      let animeId = e.target.getAttribute("anime-id");

      if (confirm("Are you sure you want to delete this anime?")) {
        window.location.href = `/api/anime/delete.php?id=${animeId}`;
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".delete-btn-studio").forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      let studioId = e.target.getAttribute("studio-id");

      if (confirm("Are you sure you want to delete this studio?")) {
        window.location.href = `/api/studio/delete.php?id=${studioId}`;
      }
    });
  });
});

function openAddModal(activeMenuItem) {
  if (activeMenuItem === "client") {
    document.getElementById("addClientModal").style.display = "block";
  } else if (activeMenuItem === "anime") {
    document.getElementById("addAnimeModal").style.display = "block";
  } else if (activeMenuItem === "studio") {
    document.getElementById("addStudioModal").style.display = "block";
  }
}

function closeAddModal(activeMenuItem) {
  if (activeMenuItem === "client") {
    document.getElementById("addClientModal").style.display = "none";
  } else if (activeMenuItem === "anime") {
    document.getElementById("addAnimeModal").style.display = "none";
  } else if (activeMenuItem === "studio") {
    document.getElementById("addStudioModal").style.display = "none";
  }
}

function openUpdateModal(activeMenuItem) {
  if (activeMenuItem === "client") {
    document.getElementById("updateClientModal").style.display = "block";
  } else if (activeMenuItem === "anime") {
    document.getElementById("updateAnimeModal").style.display = "block";
  } else if (activeMenuItem === "studio") {
    document.getElementById("editStudioModal").style.display = "block";
  } else if (activeMenuItem === "reference") {
    document.getElementById("editReferenceModal").style.display = "block";
  }
}

function closeUpdateModal(activeMenuItem) {
  if (activeMenuItem === "client") {
    document.getElementById("updateClientModal").style.display = "none";
  } else if (activeMenuItem === "anime") {
    document.getElementById("updateAnimeModal").style.display = "none";
  } else if (activeMenuItem === "studio") {
    document.getElementById("updateStudioModal").style.display = "none";
  } else if (activeMenuItem === "reference") {
    document.getElementById("updateReferenceModal").style.display = "none";
  }
}

function openEditStudioModal(button) {
  // Extract data from the button's data attributes.
  const studioId = button.getAttribute("data-studio-id");
  const name = button.getAttribute("data-name");
  const description = button.getAttribute("data-description");
  const establishedDate = button.getAttribute("data-established-date");
  const imagePath = button.getAttribute("data-image");

  if (establishedDate) {
    document.getElementById("editEstablishedDate").value = establishedDate;
  } else {
    document.getElementById("editEstablishedDate").value = null;
  }

  // Populate the modal's fields with the extracted data.
  document.getElementById("editStudioId").value = studioId;
  document.getElementById("editName").value = name;
  document.getElementById("editDescription").innerText = description;

  const imageElement = document.getElementById("currentStudioImage");
  if (imagePath) {
    imageElement.src = imagePath;
    imageElement.alt = "Current Image";
    imageElement.style.display = ""; // show image
  } else {
    imageElement.style.display = "none"; // hide image
  }

  // Display the modal.
  const modal = document.getElementById("editStudioModal");
  modal.style.display = "block";
}

function closeEditStudioModal() {
  const modal = document.getElementById("editStudioModal");
  modal.style.display = "none";
}

function openEditClientModal(button) {
  const clientId = button.getAttribute("data-client-id");
  const username = button.getAttribute("data-username");
  const email = button.getAttribute("data-email");
  const password = button.getAttribute("data-password");
  const admin_status = button.getAttribute("data-admin-status");
  const birthdate = button.getAttribute("data-birthdate");
  const bio = button.getAttribute("data-bio");
  const imagePath = button.getAttribute("data-image");

  // Populate the modal's fields with the extracted data
  document.getElementById("editClientId").value = clientId;
  document.getElementById("editUsername").value = username;
  document.getElementById("editEmail").value = email;
  document.getElementById("editPassword").value = password;
  document.getElementById("editAdminStatus").value = admin_status;
  document.getElementById("editBio").value = bio;

  const imageElement = document.getElementById("currentImage");
  if (imagePath) {
    imageElement.src = imagePath;
    imageElement.alt = "Current Image";
    imageElement.style.display = ""; // show image
  } else {
    imageElement.style.display = "none"; // hide image
  }

  if (birthdate) {
    document.getElementById("editBirthdate").value = birthdate;
  } else {
    document.getElementById("editBirthdate").value = null;
  }

  // Display the modal
  const modal = document.getElementById("editClientModal");
  modal.style.display = "block";
}

function closeEditClientModal() {
  const modal = document.getElementById("editClientModal");
  modal.style.display = "none";
}

function openEditAnimeModal(button) {
  // Get attributes from the button
  const animeId = button.getAttribute("data-anime-id");
  const title = button.getAttribute("data-title");
  const type = button.getAttribute("data-type");
  const status = button.getAttribute("data-status");
  const release_date = button.getAttribute("data-release_date");
  const episodes = button.getAttribute("data-episodes");
  const rating = button.getAttribute("data-rating");
  const score = button.getAttribute("data-score");
  const imagePath = button.getAttribute("data-image");
  const trailerPath = button.getAttribute("data-trailer");
  const synopsis = button.getAttribute("data-synopsis");
  const studio_id = button.getAttribute("data-studio-id");

  // Populate the modal's fields with the extracted data
  document.getElementById("editAnimeId").value = animeId;
  document.getElementById("editTitle").value = title;
  document.getElementById("editType").value = type;
  document.getElementById("editStatus").value = status;
  document.getElementById("editScore").value = score;
  document.getElementById("editRelease_date").value = release_date;
  document.getElementById("editEpisodes").value = episodes;
  document.getElementById("editRating").value = rating;

  const imageElement = document.getElementById("currentAnimeImage");
  if (imagePath) {
    imageElement.src = imagePath;
    imageElement.alt = "Current Image";
    imageElement.style.display = ""; // show image
  } else {
    imageElement.style.display = "none"; // hide image
  }

  const trailerElement = document.getElementById("currentTrailer");
  if (trailerPath) {
    trailerElement.src = trailerPath;
    trailerElement.alt = "Current Trailer";
    trailerElement.style.display = "";
  } else {
    trailerElement.style.display = "none";
  }

  document.getElementById("editSynopsis").value = synopsis;
  document.getElementById("editStudio_id").value = studio_id;

  // Display the modal
  const modal = document.getElementById("editAnimeModal");
  modal.style.display = "block";
}

function closeEditAnimeModal() {
  const modal = document.getElementById("editAnimeModal");
  modal.style.display = "none";
}

function openEditReferenceModal(button) {
  // Get attributes from the button
  const referenceId = button.getAttribute("data-reference-id");
  const anime_account_id = button.getAttribute("data-anime-account-id");
  const forum_account_id = button.getAttribute("data-forum-account-id");
  const referral_code = button.getAttribute("data-referral-code");
  const point = button.getAttribute("data-point");

  // Populate the modal's fields with the extracted data
  document.getElementById("editReferenceId").value = referenceId;
  document.getElementById("editAnimeAccountId").value = anime_account_id;
  document.getElementById("editForumAccountId").value = forum_account_id;
  document.getElementById("editReferralCode").value = referral_code;
  document.getElementById("editPoint").value = point;

  // Display the modal
  const modal = document.getElementById("editReferenceModal");
  modal.style.display = "block";
}

function closeEditReferenceModal() {
  const modal = document.getElementById("editReferenceModal");
  modal.style.display = "none";
}
