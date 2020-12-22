<?php

function addFile($photoUpload)
{
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($photoUpload["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $message = '';
    // Check if image file is a actual image or fake image
    $check = getimagesize($photoUpload["tmp_name"]);
    if ($check !== false) {
        $message = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
        return array($message, $uploadOk);
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $message = "Sorry, file already exists.";
        $uploadOk = 0;
        return array($message, $uploadOk);
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        return array($message, $uploadOk);
    } else {
        if (move_uploaded_file($photoUpload["tmp_name"], $target_file)) {
            $message = "The file " . htmlspecialchars(basename($photoUpload["name"])) . " has been uploaded.";
            return array($message, $uploadOk);
        } else {
            $message = "Sorry, there was an error uploading your file.";
            return array($message, $uploadOk);
        }
    }
}
