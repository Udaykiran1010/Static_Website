<?php
// Function to log messages to logs.txt
function log_message($message) {
    $log_file = '/home/ec-2user/log/logs.txt';
    $timestamp = date('Y-m-d H:i:s');
    $formatted_message = "[{$timestamp}] {$message}\n";
    file_put_contents($log_file, $formatted_message, FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        if ($file['error'] == UPLOAD_ERR_OK) {
            $upload_dir = '/var/www/html/uploads/';
            $upload_file = $upload_dir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $upload_file)) {
                $success_message = 'File successfully uploaded.';
                echo $success_message;
                log_message($success_message);
            } else {
                $error_message = 'Failed to move uploaded file.';
                echo $error_message;
                log_message($error_message);
            }
        } else {
            $error_message = 'File upload error: ' . $file['error'];
            echo $error_message;
            log_message($error_message);
        }
    } else {
        $error_message = 'No file uploaded.';
        echo $error_message;
        log_message($error_message);
    }
}
?>
