<?php
include_once '../../../imports/need/session_setup.php';
include_once '../../../imports/need/DB.php';
include_once '../../../Controller/bank_account_details/bank_account_details_ADD_UPDATE.php';
include_once '../../../Controller/bank_account_details/bank_account_details_LIST.php';
include_once '../../../Controller/User-Login/Cook_Managment/Cook_Managing.php';

$json = array();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bank_name = isset($_POST['val_01']) ? $_POST['val_01'] : null;
    $branch = isset($_POST['val_02']) ? $_POST['val_02'] : null;
    $ac_no = isset($_POST['val_03']) ? $_POST['val_03'] : null;
    $ac_name = isset($_POST['val_04']) ? $_POST['val_04'] : null;
    $swif_code = isset($_POST['val_05']) ? $_POST['val_05'] : null;
    $dis = isset($_POST['val_08']) ? $_POST['val_08'] : null;
    $bank_account_id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if (
        trim((string) $bank_name) === '' ||
        trim((string) $branch) === '' ||
        trim((string) $ac_no) === '' ||
        trim((string) $ac_name) === '' ||
        trim((string) $swif_code) === '' ||
        trim((string) $dis) === ''
    ) {
        $json[] = ['error' => 'Please complete all required bank account fields.'];
        echo json_encode($json);
        exit;
    }

    $check_login_obj = new Cook_Management($user_main_cook_id);

    if ($check_login_obj->check_login_availability()) {
        $bank_account_details = new bank_account_details_ADD_UPDATE($check_login_obj->get_user_id());


        $bank_account_details->get_data($bank_name, $branch, $ac_no, $ac_name, $swif_code, $dis);

        $bank_account_list_obj = new bank_account_details_LIST();

        $bank_account_list_obj->filter_by_ac_no($ac_no);
        if ($bank_account_id > 0) {
            $bank_account_list_obj->filter_by_id_not($bank_account_id);
        }

        $get_result = $bank_account_list_obj->get_result();

        if (isset($_POST['current_ac'])) {
            // echo "code is hear ";
            $bank_account_details->is_current_ac();
        } else {
            $bank_account_details->is_not_current_ac();
        }

        if (isset($_POST['savings_ac'])) {
            // echo "code is hear ";
            $bank_account_details->is_savings_ac();
        } else {
            $bank_account_details->is_not_savings_ac();
        }


        if ($bank_account_id > 0) {
            $bank_account_details->set_id($bank_account_id);

            if (isset($_POST['remove']) && $_POST['remove'] == '1') {

                $bank_account_details->remove();
                if ($bank_account_details->process_update()) {
                    $state['error'] = "0";
                    $state['id'] = $bank_account_id;
                } else {
                    $state['error'] = $bank_account_details->get_error();
                }
                $json[] = $state;
                echo json_encode($json);
                exit;
            }
        }

        if ($bank_account_id > 0) {
            if ($get_result && $get_result->num_rows > 0) {
                $state['error'] = "already have Account Number";
            } elseif ($bank_account_details->process_update()) {
                $state['error'] = "0";
                $state['id'] = $bank_account_id;
            } else {
                $state['error'] = $bank_account_details->get_error();
            }
        } else {
            if ($get_result && $get_result->num_rows == 0) {
                if ($bank_account_details->process_new_record()) {
                    $state['error'] = "0";
                    $state['id'] = $bank_account_details->get_id();
                } else {
                    $state['error'] = $bank_account_details->get_error();
                }
            } else {
                $state['error'] = "already have Account Number";
            }
        }

        $json[] = $state;
    } else {
        $state['error'] = $check_login_obj->get_error_msg();
        $json[] = $state;
    }
} else {
    $state['error'] = "Invalid request method";
    $json[] = $state;
}

echo json_encode($json);
