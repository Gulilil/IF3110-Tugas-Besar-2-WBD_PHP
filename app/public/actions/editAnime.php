<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Anime.php');

$a = new Anime();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['anime_id']) || empty($_POST['anime_id'])) {
        echo "No anime ID provided. Cannot proceed with edit.";
        exit();
    }
    $data = [
        'anime_id' => $_POST['anime_id'],
        'title' => $_POST['title'],
        'type' => $_POST['type'],
        'status' => $_POST['status'],
        'rating' => $_POST['rating'],
        'studio_id' => $_POST['studio_id'],
        'score' => null
    ];

    // Check if release_date is set and not empty
    if (isset($_POST['release_date']) && !empty($_POST['release_date'])) {
        $data['release_date'] = $_POST['release_date'];
    } else {
        $data['release_date'] = null;
    }

    if (isset($_POST['episodes'])) {
        $data['episodes'] = $_POST['episodes'];
    } else {
        $data['episodes'] = null;
    }

    if (isset($_POST['synopsis'])) {
        $data['synopsis'] = $_POST['synopsis'];
    } else {
        $data['synopsis'] = null;
    }

    if (isset($_FILES['newImage']['name']) && $_FILES['newImage']['error'] == 0) {
        // Define directory where the image will be stored
        $target_dir = BASE_DIR . "/public/img/anime/"; // Ensure this directory exists and has proper permissions
        $target_file = $target_dir . basename($_FILES['newImage']['name']);
    
        // Check file size (for example, limit to 5MB)
        if ($_FILES['newImage']['size'] > 5000000) {
            die("Sorry, your file is too large.");
        }
    
        // Check if the file is an actual image
        $check = getimagesize($_FILES['newImage']['tmp_name']);
        if ($check === false) {
            die("File is not an image.");
        }
    
        // Only allow certain file formats (JPEG and PNG in this case)
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            die("Sorry, only JPG, JPEG, and PNG files are allowed.");
        }
    
        // Check if file already exists, if so, append a number
        $original_name = $target_file;
        $counter = 1;
        while (file_exists($target_file)) {
            $info = pathinfo($original_name);
            $target_file = $info['dirname'] . '/' . $info['filename'] . '_' . $counter . '.' . $info['extension'];
            $counter++;
        }
    
        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['newImage']['tmp_name'], $target_file)) {
            $data['image'] = str_replace(BASE_DIR, "", $target_file);;  // Save the path relative to your server root in the database
        } else {
            die("There was an error uploading your file.");
        }
    } else {
        $animeId = $_POST['anime_id'];
        $result = $a->getAnimeByID($animeId);

        if ($result) {
            $data['image'] = $result['image'];
        } else {
            // Optionally handle the case where no existing image path is found.
            // $data['image'] = 'default/path/for/no/image.jpg';
            // Or leave it as null if your application logic handles that case:
            $data['image'] = null;
        }
    }

    if (isset($_FILES['newTrailer']['name']) && $_FILES['newTrailer']['error'] == 0) {
        // Define directory where the trailer will be stored
        $target_dir = BASE_DIR . "/public/vid/"; // Ensure this directory exists and is writable
        $target_file = $target_dir . basename($_FILES['newTrailer']['name']);
    
        // Check file size (for example, limit to 50MB)
        if ($_FILES['newTrailer']['size'] > 50000000) {
            die("Sorry, your file is too large.");
        }
    
        // Only allow certain file formats (MP4 in this case)
        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($videoFileType != "mp4") {
            die("Sorry, only MP4 files are allowed.");
        }
    
        // Check if file already exists, if so, append a number
        $original_name = $target_file;
        $counter = 1;
        while (file_exists($target_file)) {
            $info = pathinfo($original_name);
            $target_file = $info['dirname'] . '/' . $info['filename'] . '_' . $counter . '.' . $info['extension'];
            $counter++;
        }
    
        // Try to move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['newTrailer']['tmp_name'], $target_file)) {
            $data['trailer'] = str_replace(BASE_DIR, "", $target_file);  // Save the path relative to your server root in the database
        } else {
            die("There was an error uploading your file.");
        }
    } else {
        $animeId = $_POST['anime_id'];
        $result = $a->getAnimeByID($animeId);

        if ($result) {
            $data['trailer'] = $result['trailer'];
        } else {
            // Optionally handle the case where no existing image path is found.
            // $data['image'] = 'default/path/for/no/image.jpg';
            // Or leave it as null if your application logic handles that case:
            $data['trailer'] = null;
        }
    }

    // Call the updateclient method
    $result = $a->updateAnime($data);

    if ($result) {
        header("Location: /?admin");
        exit();
    } else {
        echo "Failed to edit anime. Please try again.";
    }
}
