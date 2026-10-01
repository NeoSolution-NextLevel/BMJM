<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php include_once './imports/need/session_setup.php'; ?>

<!-- IMPORTANT: make sure your <head> (page template) has this meta:
<meta name="viewport" content="width=device-width, initial-scale=1">
-->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kreon:wght@400;700&family=Open+Sans:wght@400;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Background styling from first code */
    .background {
        font-family: 'Open Sans', sans-serif;
        background: linear-gradient(135deg, rgba(189, 219, 213, 0.5), rgba(22, 33, 62, 0.8));
        min-height: 100vh;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        position: relative;
        overflow: auto;
    }

    .background::before {
        margin: 0;
        padding: 0;
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /*        background: url('./assets/images/mosque.jpg') center/cover no-repeat;*/
        opacity: 0.3;
        z-index: 0;
    }

    /* Form container styling */
    .form-container {
        font-family: 'Open Sans', sans-serif;
        max-width: 800px;
        width: 100%;
        margin: 20px auto;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        /* Changed from hidden to visible for buttons */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: white;
        position: relative;
        z-index: 1;
    }

    .form-header {
        background-color: #8d9676;
        color: white;
        padding: 16px 20px;
        text-align: center;
    }

    .form-header h2 {
        margin: 0;
        font-size: 2.5em;
        font-family: 'Kreon', serif;
        font-weight: 700;
    }

    .member-form {
        padding: 20px;
        overflow: visible;
        /* Ensure form content doesn't cause scroll */
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="number"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 16px;
        /* Larger font for better mobile readability */
        box-sizing: border-box;
        transition: border-color 0.2s;
    }

    .form-group input:focus {
        outline: none;
        border-color: #f4d747;
    }

    .radio-group label,
    .checkbox-group label {
        display: inline-block;
        margin-right: 15px;
        font-weight: normal;
        color: #333;
    }

    .mobile-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .mobile-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: normal;
    }

    .form-section {
        border-top: 1px solid #eee;
        padding-top: 15px;
        margin-top: 15px;
    }

    .form-section h3 {
        font-family: 'Kreon', serif;
        color: #8d9676;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        overflow: visible;
        /* Ensure buttons don't cause scroll */
    }

    .cancel-btn,
    .process-btn {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
        font-size: 16px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        white-space: nowrap;
        /* Prevent text wrapping */
    }

    .cancel-btn {
        background-color: #777;
        color: white;
    }

    .cancel-btn:hover {
        background-color: #555;
    }

    .process-btn {
        background-color: #8d9676;
        color: white;
    }

    .process-btn:hover {
        background-color: #373c2e;
        transform: scale(1.05);
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .form-container {
            width: 95%;
        }
    }

    @media (max-width: 768px) {
        .form-container {
            width: 100%;
            margin: 10px auto;
        }

        .form-header h2 {
            font-size: 2em;
        }

        .member-form {
            padding: 15px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="number"] {
            padding: 14px 16px;
            font-size: 16px;
            /* Prevents zoom on iOS */
        }

        .mobile-group {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .background {
            padding: 10px;
            align-items: flex-start;
        }

        .form-container {
            width: 100%;
            margin: 0;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            overflow: visible;
            /* Allow buttons to extend if needed */
        }

        .form-header {
            padding: 12px 15px;
        }

        .form-header h2 {
            font-size: 1.6em;
        }

        .member-form {
            padding: 15px;
            overflow: visible;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="number"] {
            padding: 14px;
            font-size: 16px;
            /* Crucial for mobile usability */
        }

        .form-actions {
            flex-direction: column;
            gap: 12px;
            overflow: visible;
        }

        .cancel-btn,
        .process-btn {
            width: 100%;
            padding: 14px;
            font-size: 16px;
        }

        .radio-group label,
        .checkbox-group label {
            display: block;
            margin-bottom: 10px;
            margin-right: 0;
        }

        .form-section h3 {
            font-size: 1.2em;
        }
    }

    /* Extra small devices */
    @media (max-width: 360px) {
        .member-form {
            padding: 12px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="number"] {
            padding: 12px;
        }

        .form-header h2 {
            font-size: 1.4em;
        }

        .cancel-btn,
        .process-btn {
            padding: 12px;
        }
    }
</style>

<div class="background">
    <div class="form-container">
        <div class="form-header">
            <h2>Process New Member</h2>
        </div>

        <form class="member-form" onsubmit="return New_member_front_from_01_SUBMIT(event)">
            <input type="hidden" id="front_member_road_id" name="val_20" value="">

            <div class="form-group">
                <label>Name *</label>
                <input type="text" id="New_member_front_form_from_01_val_01" placeholder="John Smith" required>
            </div>

            <div class="form-group">
                <label>Residence Address *</label>
                <input type="text" id="New_member_front_form_from_01_val_02" placeholder="123 Main Street, Springfield, USA" required>
            </div>

            <div class="form-group">
                <label>What is your current residing status</label>
                <div class="radio-group">
                    <label><input type="radio" id="New_member_front_form_from_01_val_04_check_01" name="residing_status"> Own House</label>
                    <label><input type="radio" name="residing_status" id="New_member_front_form_from_01_val_04_check_02"> Renting House</label>
                </div>
            </div>

            <div class="form-group">
                <label>NIC No *</label>
                <input type="text" placeholder="XXXXXXXXXXX" id="New_member_front_form_from_01_val_05" required>
            </div>

            <div class="form-section">
                <h3>Notification data and contact details</h3>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="example@gmail.com" id="New_member_front_form_from_01_val_12">
                </div>

                <div class="form-group">
                    <label>Mobile (Local Notification)</label>
                    <div class="mobile-group">
                        <input type="tel" placeholder="07x xxx xxxx">
                        <label><input type="checkbox" id="New_member_front_form_from_01_val_11"> WhatsApp on this number?</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>WhatsApp Number *</label>
                    <input type="tel" placeholder="07x xxx xxxx" id="New_member_front_form_from_01_val_10" required>
                </div>

                <div class="form-group">
                    <label>Secondary Number *</label>
                    <input type="tel" placeholder="07x xxx xxxx" id="New_member_front_form_from_01_val_09" required>
                </div>
            </div>

            <div class="form-section">
                <div class="form-group">
                    <label>Profession</label>
                    <input type="text" placeholder="xxx" id="New_member_front_form_from_01_val_13" required>
                </div>

                <div class="form-group">
                    <label>Monthly Subscription Amount (Minimum 500LKR)</label>
                    <input type="number" placeholder="0000.00" id="New_member_front_form_from_01_val_15">
                </div>

                <div class="form-group">
                    <label>Opening Balance</label>
                    <input type="number" placeholder="0000.00" id="New_member_front_form_from_01_val_17">
                </div>

            </div>

            <div class="form-section">
                <h3>Recommended Person 01 Details</h3>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" placeholder="John Smith" id="New_member_front_form_from_01_val_21">
                </div>

                <div class="form-group">
                    <label>Membership number</label>
                    <input type="number" placeholder="07x xxx xxxx" id="New_member_front_form_from_01_val_22" required>
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" placeholder="07x xxx xxxx" id="New_member_front_form_from_01_val_23" required>
                </div>
            </div>


            <div class="form-section">
                <h3>Recommended Person 02 Details</h3>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" placeholder="John Smith" id="New_member_front_form_from_01_val_24">
                </div>

                <div class="form-group">
                    <label>Membership number</label>
                    <input type="number" placeholder="00010xxxxx" id="New_member_front_form_from_01_val_25" required>
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="tel" placeholder="07x xxx xxxx" id="New_member_front_from_01_val_26" required>
                </div>


                <!-- <div class="checkbox-group">
                    <label><input type="checkbox" id="New_member_front_form_from_01_val_19_check_01"> Subscription</label>
                    <label><input type="checkbox" id="New_member_front_form_from_01_val_19_check_02"> Zakath Payee</label>
                    <label><input type="checkbox" id="New_member_front_form_from_01_val_19_check_03"> Zakath receive</label>
                </div> -->

                <div class="w3-panel w3-red" id="body_01_01_C_01_error_msg_body" style="display: none;">
                    <h3>Error Message!</h3>
                    <p id="member_create_front_error_msg"></p>
                </div>



            </div>


            <div class="form-actions">
                <a href="<?php echo $pth; ?>road-list<?php echo $online_offline_extention; ?>" class="cancel-btn">Cancel</a>
                <button type="submit" class="process-btn">Process</button>
            </div>
        </form>
    </div>
</div>