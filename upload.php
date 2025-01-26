<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $image = $_FILES['image'];

    if ($image['error'] == UPLOAD_ERR_OK) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), $allowed_extensions)) {
            $upload_dir = 'uploads/';
            $file_name = uniqid() . '.' . $extension;
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($image['tmp_name'], $file_path)) {
                $stmt = $conn->prepare("INSERT INTO photos (title, image_path) VALUES (?, ?)");
                $stmt->bind_param('ss', $title, $file_path);
                $stmt->execute();
                $stmt->close();
                header('Location: index.php');
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file type.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>