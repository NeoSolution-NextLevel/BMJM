<?php

// Path to the image file
$imagePath = isset($_POST['pth_of_image']) ? "../../" . $_POST['pth_of_image'] : "";
$json = array();

// Check if the file exists
if (file_exists($imagePath)) {
    // Attempt to delete the file
    if (unlink($imagePath)) {
        
    } else {
        $state['error'] = "something went wrong";
        $json[] = $state;
    }
} else {
    $state['error'] = "image not found";
    $json[] = $state;
}

echo json_encode($json);
