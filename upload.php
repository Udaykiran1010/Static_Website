
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        if ($file['error'] == UPLOAD_ERR_OK) {
            $upload_dir = '/var/www/html/uploads/';
            $upload_file = $upload_dir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $upload_file)) {
                echo 'File successfully uploaded.';
            } else {
                echo 'Failed to move uploaded file.';
            }
        } else {
            echo 'File upload error: ' . $file['error'];
        }
    } else {
        echo 'No file uploaded.';
    }
}
?>

