<?php

$curDirPath = dirname(__FILE__);
require_once("$curDirPath/../photo_upload/imgutils_core.php");
$targetImgDirPath = '../../../images/producers';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Only POST is supported.');
}

if (!is_array($_FILES) || !isset($_FILES['producerImages']['tmp_name'])) {
    exit('Uploaded files are invalid.');
}

if (is_uploaded_file($_FILES['producerImages']['tmp_name'])) {
    $sourcePath = $_FILES['producerImages']['tmp_name'];
    $fileName   = $_FILES['producerImages']['name'];
    $targetPath = "$targetImgDirPath/$fileName";

    if (isSupportedExtension($fileName) &&
        move_uploaded_file($sourcePath, $targetPath)) {
        echo $fileName;
    } else {
        echo "Failed to upload $fileName<br />";
    }
} else {
    echo 'Failed to upload the image.<br />';
}

?>