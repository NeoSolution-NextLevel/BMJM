<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php include_once '../imports/need/session_setup.php'; ?>
<html>

<head>
    <meta charset="UTF-8">

    <?php
    include_once '../imports/Company_Info/Company_Info_Variable_List.php';
    include_once '../imports/header/basic_header.php';

    // include_once '../Controller/User-Login/Cook_Managment/Cook_Managing.php';
    // include_once '../imports/need/DB.php';

    ?>
    <title><?php echo $company_obj->get_compnay_name(); ?> | DashBoard</title>

</head>

<body class="w3-theme-light">
    <div class="container-fluid" id="Member_body_01_D_01">
        <div class="row w3-theme-l3">
            <div class="col-lg-3"></div>
            <div class="col-lg-6  ">
                <div class="container-fluid w3-theme-l4 w3-margin-bottom">
                    <div class="row w3-theme-dark w3-padding-16">
                        <div class="col-lg-10 w3-xxlarge w3-strong w3-header w3-animate-zoom" id="Member_body_01_D_01_headding">
                            Approve Stage 02
                        </div>
                        <div class="col-lg-2 w3-xlarge">
                            <button class="w3-button w3-round w3-theme-dark w3-hover-theme w3-padding w3-block w3-animate-zoom" onclick="Member_body_01_A_OPEN()">
                                <span class="fa fa-times"></span>
                            </button>
                        </div>
                    </div>
                    <form method="POST" id="Member_body_01_D_form_01" onsubmit="return Member_body_01_D_01_from_01_SUBMIT(event, isCancel = false)">


                        <div class="container-fluid " id="Member_body_01_D_01_approve_01_data_body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_01">
                                        <div class="row w3-theme-l3 w3-padding w3-margin-top">
                                            <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                Member Name
                                            </div>
                                            <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                :
                                            </div>
                                            <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_01"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_02">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                Address
                                            </div>
                                            <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                :
                                            </div>
                                            <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_02"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_03">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                Contact No
                                            </div>
                                            <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                :
                                            </div>
                                            <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_03"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="container-fluid " id="Member_body_01_D_01_data_body_04">
                                <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                    <div class="col-lg-6 w3-padding w3-padding w3-animate-zoom">
                                        Office
                                    </div>
                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                        :
                                    </div>
                                    <div class="col-lg-4" id="Member_body_01_D_01_approve_01_val_04"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_04">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                Whatsapp number
                                            </div>
                                            <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                :
                                            </div>
                                            <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_05"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_04">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                current residing status
                                            </div>
                                            <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                :
                                            </div>
                                            <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_06"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_04">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                Profession
                                            </div>
                                            <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                :
                                            </div>
                                            <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_07"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row w3-margin-bottom">
                                <div class="col-lg-12">
                                    <div class="container-fluid" id="New_admission_04_A_03_data_body_08">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12 w3-strong w3-large">
                                                        Recommended Person 01 Details
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                        Name
                                                    </div>
                                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_08"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                        Membership No
                                                    </div>
                                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_09"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                        Contact No
                                                    </div>
                                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_10"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid" id="New_admission_04_A_03_data_body_08">
                                        <div class="row w3-theme-l3 w3-padding   w3-margin-top">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-12 w3-strong w3-large">
                                                        Recommended Person 02 Details
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                        Name
                                                    </div>
                                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_11"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                        Membership No
                                                    </div>
                                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_12"></div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-4 w3-padding w3-animate-zoom">
                                                        Contact No
                                                    </div>
                                                    <div class="col-lg-1 w3-padding w3-animate-zoom">
                                                        :
                                                    </div>
                                                    <div class="col-lg-6 w3-padding" id="Member_body_01_D_01_approve_01_val_13"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_04">
                                        <div class="row   w3-margin-top">
                                            <div class="col-lg-12 w3-padding w3-animate-zoom">
                                                Opening Balance
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 w3-animate-zoom">
                                                <input type="number" class="w3-input w3-round w3-border w3-border-black w3-animate-zoom" step="0.01" placeholder="0000.00" id="Member_body_01_D_01_approve_01_val_14" name="Member_body_01_C_4_from_01_val_0014" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="container-fluid " id="Member_body_01_D_01_data_body_04">
                                        <div class="row   w3-margin-top">
                                            <div class="col-lg-12 w3-padding w3-animate-zoom">
                                                Monthly Subscription Amount
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 w3-animate-zoom">
                                                <input type="number" class="w3-input w3-round w3-border w3-border-black w3-animate-zoom" step="0.01" placeholder="0000.00" id="Member_body_01_D_01_approve_01_val_15" name="Member_body_01_C_4_from_01_val_0015" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row w3-margin-top w3-theme-l3 ">

                                <div class="col-lg-4  w3-animate-zoom w3-margin-top w3-margin-bottom">
                                    <input type="checkbox" id="Member_body_01_D_01_approve_01_val_16" name="Member_body_01_C_4_form_from_01_val_19_check_001" class="w3-check" disabled>
                                    <strong>Subscription </strong>
                                </div>
                                <div class="col-lg-4  w3-animate-zoom w3-margin-top w3-margin-bottom">
                                    <input type="checkbox" id="Member_body_01_D_01_approve_01_val_17" name="Member_body_01_C_4_form_from_01_val_19_check_002" class="w3-check" disabled>
                                    <strong>Zakath Payee </strong>

                                </div>
                                <div class="col-lg-4  w3-animate-zoom w3-margin-top w3-margin-bottom">
                                    <input type="checkbox" id="Member_body_01_D_01_approve_01_val_18" name="Member_body_01_C_4_form_from_01_val_19_check_003" class="w3-check" disabled>
                                    <strong>Zakath receive </strong>

                                </div>

                            </div>
                        </div>

                        <div class="row w3-margin-top w3-margin-bottom">
                            <div class="col-lg-4 ">
                                <button type="button" class="w3-theme-dark w3-round w3-padding-16 w3-strong w3-button w3-block w3-animate-zoom" id="Member_body_01_D_01_cancel_btn" onclick="Member_body_01_D_01_from_01_SUBMIT(event, isCancel = true)">
                                    Cancel
                                </button>
                            </div>


                            <div class="col-lg-8 ">
                                <button type="submit" class="w3-theme-dark w3-round w3-padding-16 w3-strong w3-button w3-block w3-animate-zoom" id="Member_body_01_D_01_approve_btn">
                                    Approve
                                </button>
                            </div>
                        </div>

                    </form>


                </div>

            </div>
        </div>

        <div class="col-lg-3"></div>
    </div>
</body>

</html>