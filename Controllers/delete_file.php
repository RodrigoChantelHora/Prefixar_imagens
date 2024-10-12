<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_POST['file'];

    if (file_exists($file)) {
        if (unlink($file)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'file_not_found';
    }
}

