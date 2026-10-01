<?php

include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
$company_obj = new Company_Info_Variable_List();
// Define the upload directory
$uploadDir = '../../Data/' . str_replace(' ', '_', $company_obj->get_compnay_short_name()) . '/';
$db_file_pth = 'Data/' . str_replace(' ', '_', $company_obj->get_compnay_short_name()) . '/';

// Check if the upload directory exists, if not, create it
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true); // 0755 sets the permissions, true allows the creation of nested directories
}

// Get all files in the upload directory
$uploadedFiles = array_diff(scandir($uploadDir), array('.', '..'));

// Set the maximum folder size allowed (1GB in bytes)
$max_folder_size_from_bytes = 1073741824; // 1GB in bytes 1073741824
$image_size_from_bytes = 5242880; // 5MB in bytes
$image_size = "5MB";
$max_folder_size="1GB";

$json = array();

// Function to calculate folder size
function getFolderSize($dir) {
    $size = 0;
    foreach (scandir($dir) as $file) {
        if ($file !== '.' && $file !== '..') {
            $size += filesize($dir . $file);
        }
    }
    return $size;
}

// Calculate current folder size
$currentFolderSize = getFolderSize($uploadDir);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image_uploder_image'])) {

        $image_type = isset($_POST['image_uploder_image_TYPE']) ? $_POST['image_uploder_image_TYPE'] : "";

        $file = $_FILES['image_uploder_image'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $fileActualExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                // Check if adding the new file will exceed the folder size limit
                if ($currentFolderSize + $fileSize <= $max_folder_size_from_bytes) {
                    if ($fileSize <= $image_size_from_bytes) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = $uploadDir . str_replace(' ', '_', $company_obj->get_compnay_short_name()) . "_" . $image_type . "_" . $fileNameNew;
                        $db_file_pth = $db_file_pth .str_replace(' ', '_', $company_obj->get_compnay_short_name()) . "_" . $image_type . "_" . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $state['error'] = "0";
                        $state['img_pth'] = $db_file_pth;
                        $json[] = $state;
                    } else {
                        $state['error'] = "File size exceeds " . $image_size . " limit.";
                        $json[] = $state;
                    }
                } else {
                    $state['error'] = "Your package size limit of ".$max_folder_size." exceeded.";
                    $json[] = $state;
                }
            } else {
                $state['error'] = "Error uploading file.";
                $json[] = $state;
            }
        } else {
            $state['error'] = "Invalid file type.";
            $json[] = $state;
        }
    } else {
        $state['error'] = "No file uploaded.";
        $json[] = $state;
    }
}
echo json_encode($json);
?>
