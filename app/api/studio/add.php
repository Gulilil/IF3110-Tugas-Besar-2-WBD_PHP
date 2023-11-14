<?php
require_once(dirname(__DIR__,2).'/define.php');
require_once(BASE_DIR.'/models/Studio.php');

$s = new Studio();

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'name' => $_POST['name']
    ];

    // Check if established_date is set and not empty
    if (isset($_POST['established_date']) && !empty($_POST['established_date'])) {
        $data['established_date'] = $_POST['established_date'];
    } else {
        $data['established_date'] = null;
    }

    // Check if description is set
    if (isset($_POST['description'])) {
        $data['description'] = $_POST['description'];
    } else {
        $data['description'] = null;
    }

    // Check if an image is uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        // Define directory where the image will be stored
        $target_dir = BASE_DIR . "/public/img/studio/"; // Ensure this directory exists and has proper permissions
        $target_file = $target_dir . basename($_FILES['image']['name']);
    
        // Check file size (for example, limit to 5MB)
        if ($_FILES['image']['size'] > 5000000) {
            die("Sorry, your file is too large.");
        }
    
        // Check if the file is an actual image
        $check = getimagesize($_FILES['image']['tmp_name']);
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
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $data['image'] = str_replace(BASE_DIR, "", $target_file);;  // Save the path relative to your server root in the database
        } else {
            die("There was an error uploading your file.");
        }
    } else {
        $data['image'] = null;
    }
    

    // Call the insertClient method
    $result = $s->insertStudio($data);

    if ($result) {
        header("Location: /?admin/studio/page=1");
        exit();
    } else {
        echo "Failed to add studio. Please try again.";
    }
}
