<?php
require '../app/vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

function sanitize($input) {
    $sanitizedInput = htmlspecialchars($input);
    $sanitizedInput = addslashes($sanitizedInput);

    return $sanitizedInput;
}

function checkImageInput($fileInput, $pcID) {
    $acceptedTypes = array('image/jpeg', 'image/png');
    $maxFileSize = 4194304; // 4MB->bytes
    $error = '';

    $dir = __DIR__;
    $uploadDir = str_replace('app\core', 'public\img\characters\pcs\\', $dir);

    //$fileExtension = strtolower(pathinfo($fileInput['name'], PATHINFO_EXTENSION));
    $fileName = 'user'.$_SESSION['userID'].'pc'.$pcID . '.png';
    $fileType = strtolower($fileInput['type']);
    $fileSize = $fileInput['size'];
    $tmpName = $fileInput['tmp_name'];

    if ($fileSize > $maxFileSize) {
        $error = 'File exceeds 4MB limit';
    } elseif (!in_array($fileType, $acceptedTypes)) {
        $error = 'Invalid file type. Only JPEG, JPG, and PNG files are allowed.';
    } else {
        if (!getimagesize($tmpName)) {
            $error = 'Uploaded file is not a valid image';
        }
    }

    if (empty($error)) {
        $uploadedFile = $uploadDir . $fileName;
        if (move_uploaded_file($tmpName, $uploadedFile)) {
            resizeImage($uploadedFile, 256, 256);
            echo "Avatar uploaded successfully!";
        } else {
        $error = "Failed to upload image.";
        }
    }   
}

function resizeImage($imagePath, $width, $height) {
    try {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($imagePath);
        $image->resize($width, $height);
        $image->save($imagePath);
        /*
        $image->resize($width, $height, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->crop($width, $height);
        */
    } catch (Exception $e) {
        echo 'Error resizing image: ' . $e->getMessage();
    }
}

function checkImageUrl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);

    /*
    DO NOT INCLUDE THE TWO LINES BELOW OUTSIDE LOCALHOST... THEY CAN INVITE MITM ATTACKS
    only using them currently since XAMPP php.ini is having a hard time with curl cert files
    */
    //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($ch);
    $error = curl_error($ch) . '; ' . curl_errno($ch);
    curl_close($ch);
    if ($result !== false)
    {
        return true;
    } else {
        return $error;
    }
}