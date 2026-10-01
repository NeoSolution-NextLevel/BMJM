<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php include_once '../../imports/need/session_setup.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Kreon:wght@400;700&family=Open+Sans:wght@400;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Enhanced Background with Islamic-inspired pattern */
    .background {
        font-family: 'Open Sans', sans-serif;
        background: linear-gradient(135deg, rgba(141, 150, 118, 0.4), rgba(213, 188, 117, 0.3));
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
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 25% 25%, rgba(141, 150, 118, 0.1) 0%, transparent 55%),
            radial-gradient(circle at 75% 75%, rgba(213, 188, 117, 0.1) 0%, transparent 55%);
        background-size: 50px 50px;
        opacity: 0.6;
        z-index: 0;
    }

    /* Enhanced Form container styling */
    .form-container {
        font-family: 'Open Sans', sans-serif;
        max-width: 800px;
        width: 100%;
        margin: 20px auto;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        background: white;
        position: relative;
        z-index: 1;
        margin-top: 100px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .form-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }

    /* Enhanced Header with decorative elements */
    .form-header {
        background: linear-gradient(135deg, #8d9676, #a5af8d);
        color: white;
        padding: 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-header::before,
    .form-header::after {
        content: '\f0c8';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        color: rgba(255, 255, 255, 0.1);
        font-size: 120px;
        z-index: 0;
    }

    .form-header::before {
        top: -30px;
        left: -30px;
        transform: rotate(45deg);
    }

    .form-header::after {
        bottom: -30px;
        right: -30px;
        transform: rotate(225deg);
    }

    .form-header h2 {
        margin: 0;
        font-size: 2.5em;
        font-family: 'Kreon', serif;
        font-weight: 700;
        position: relative;
        z-index: 1;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .form-header p {
        margin-top: 8px;
        font-size: 1.1em;
        opacity: 0.9;
        position: relative;
        z-index: 1;
    }

    /* Enhanced Form Styling */
    .member-form {
        padding: 25px;
        overflow: visible;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 1.05em;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="tel"],
    .form-group input[type="number"] {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid #ced4da;
        border-radius: 8px;
        font-size: 16px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
    }

    .form-group input:focus {
        outline: none;
        border-color: #d5bc75;
        box-shadow: 0 0 0 3px rgba(213, 188, 117, 0.2);
        background-color: white;
    }

    /* Enhanced Radio and Checkbox Groups */
    .radio-group,
    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-top: 5px;
    }

    .radio-group label,
    .checkbox-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: normal;
        cursor: pointer;
        transition: color 0.2s;
    }

    .radio-group label:hover,
    .checkbox-group label:hover {
        color: #8d9676;
    }

    .radio-group input[type="radio"],
    .checkbox-group input[type="checkbox"] {
        accent-color: #8d9676;
        transform: scale(1.1);
    }

    .mobile-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mobile-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: normal;
    }

    /* Enhanced Form Sections */
    .form-section {
        border-top: 2px solid #f0f0f0;
        padding-top: 20px;
        margin-top: 20px;
        position: relative;
    }

    .form-section::before {
        content: '';
        position: absolute;
        top: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(to right, #d5bc75, #8d9676);
    }

    .form-section h3 {
        font-family: 'Kreon', serif;
        color: #D5BC75;
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 1.4em;
        position: relative;
        display: inline-block;
    }



    /* Enhanced Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
        overflow: visible;
        padding-top: 20px;
        border-top: 1px solid #eaeaea;
    }

    .cancel-btn,
    .process-btn {
        padding: 14px 28px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-align: center;
        white-space: nowrap;
        position: relative;
        overflow: hidden;
    }

    .cancel-btn {
        background-color: #777;
        color: white;
    }

    .cancel-btn:hover {
        background-color: #555;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .process-btn {
        background: linear-gradient(135deg, #8d9676, #a5af8d);
        color: white;
        box-shadow: 0 4px 10px rgba(141, 150, 118, 0.3);
    }

    .process-btn:hover {
        background: linear-gradient(135deg, #7a8365, #8d9676);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 15px rgba(141, 150, 118, 0.4);
    }

    .process-btn::after {
        content: '\f061';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        transition: transform 0.3s ease;
    }

    .process-btn:hover::after {
        transform: translateX(3px);
    }

    /* Error Message Styling */
    .w3-panel {
        border-radius: 8px;
        overflow: hidden;
        margin: 20px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
            margin-top: 60px !important;
        }

        .form-header h2 {
            font-size: 2em;
        }

        .member-form {
            padding: 20px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="number"] {
            padding: 14px 16px;
            font-size: 16px;
        }

        .mobile-group {
            flex-direction: column;
        }

        .radio-group,
        .checkbox-group {
            flex-direction: column;
            gap: 10px;
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
            margin-top: 60px !important;
        }

        .form-header {
            padding: 15px;
        }

        .form-header h2 {
            font-size: 1.6em;
        }

        .member-form {
            padding: 15px;
            overflow: visible;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="tel"],
        .form-group input[type="number"] {
            padding: 14px;
            font-size: 16px;
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

    /* Form Error Content Styling */
    .form-error-content {
        color: red;
        font-weight: bold;
        margin-top: 15px;
        padding: 10px;
        text-align: center;
        border: 1px solid red;
        border-radius: 8px;
        background-color: rgba(255, 0, 0, 0.1);
    }
</style>

<?php
include_once '../NewMemberForm/JS/new-member-form_old_member_JS.php'

?>

<div class="background">
    <div class="form-container">
        <div class="form-header">
            <h2>Existing Member Registration</h2>
            <p>Bambalapitiya Jumma Masjid Membership Registration</p>
        </div>

        <form class="member-form" onsubmit="return Old_member_front_from_01_SUBMIT(event)">
            <input type="hidden" id="front_member_road_id" name="val_20" value="">


            <div class="form-group">
                <label>Membership No*</label>
                <input type="number" id="New_member_front_form_from_01_val_27" placeholder="0012012" required>
            </div>

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
                <input type="number" placeholder="XXXXXXXXXXX" id="New_member_front_form_from_01_val_05" required>
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

                <div class="form-group" style="display: none;">
                    <label>Opening Balance</label>
                    <input type="number" placeholder="0000.00" id="New_member_front_form_from_01_val_17" value="0">
                </div>

            </div>
            <div class="form-error-content" style="display: none;" id="new_member_form_old_member_error_content">
                <p id="new_member_form_old_member_error_txt">This is a placeholder for an error message. Please correct the highlighted fields.</p>
            </div>



            <div class=" checkbox-group" style="display: none;">
                <label><input type="checkbox" id="New_member_front_form_from_01_val_19_check_01"> Subscription</label>
                <label><input type="checkbox" id="New_member_front_form_from_01_val_19_check_02"> Zakath Payee</label>
                <label><input type="checkbox" id="New_member_front_form_from_01_val_19_check_03"> Zakath receive</label>
            </div>

            <div class="form-actions">
                <a href="<?php echo $pth; ?>road-list<?php echo $online_offline_extention; ?>" class="cancel-btn">
                    <i class="fas fa-times"></i> Cancel
                </a>
                <button type="submit" class="process-btn">
                    Submit
                </button>
            </div>

        </form>
    </div>
</div>