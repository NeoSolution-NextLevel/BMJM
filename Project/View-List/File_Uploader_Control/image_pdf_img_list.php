<?php

header('Content-Type: application/json');

include_once '../../imports/Company_Info/Company_Info_Variable_List.php';
$company_obj = new Company_Info_Variable_List();
$uploadDir = '../../Data/' . str_replace(' ', '_', $company_obj->get_compnay_short_name()) . '/';
$db_file_pth = 'Data/' . str_replace(' ', '_', $company_obj->get_compnay_short_name()) . '/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['imageData']) && !empty($_POST['imageData'])) {
        $imageData = $_POST['imageData'];
        $image_type = isset($_POST['image_uploder_image_TYPE']) ? $_POST['image_uploder_image_TYPE'] : "";

        if (strpos($imageData, 'data:image/jpeg;base64,') === 0) {
            $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $decodedData = base64_decode($imageData);

            $image_name_and_extention =  $image_type . "_" . uniqid() . '.jpg';
            $upload_imge_pth = $uploadDir . $image_name_and_extention;

            if (file_put_contents($upload_imge_pth, $decodedData)) {
                echo json_encode(['success' => true, 'filePath' => $db_file_pth . $image_name_and_extention]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to save the file.']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid image data.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No image data received.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
