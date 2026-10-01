<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php include_once './imports/need/session_setup.php'; ?>

<!-- IMPORTANT: make sure your <head> (page template) has this meta:
<meta name="viewport" content="width=device-width, initial-scale=1">
-->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kreon:wght@400;700&family=Open+Sans:wght@400;600&display=swap');

    .background {
        font-family: 'Open Sans', sans-serif;
        background: linear-gradient(135deg, rgba(189, 219, 213, 0.5), rgba(22, 33, 62, 0.8));
        min-height: 100vh;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('./assets/images/mosque.jpg') center/cover no-repeat;
        opacity: 0.3;
        z-index: 0;
    }

    .container {
        font-family: 'Open Sans', sans-serif;
        max-width: 600px;
        width: 90%;
        margin: 10vh auto;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: white;
        position: relative;
        z-index: 1;
    }

    .header {
        background-color: #8d9676;
        color: white;
        padding: 16px 20px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header h2 {
        margin: 0;
        font-size: 2.5em;
        font-family: 'Kreon', serif;
        font-weight: 700;
        text-align: center;
        width: 100%;
    }

    .back-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.5em;
        cursor: pointer;
        position: absolute;
        left: 20px;
        /* Changed to left */
        top: 60%;
        transform: translateY(-50%);
        transition: color 0.2s;
    }

    .back-btn:hover {
        color: #f4d747;
    }

    .back-btn i {
        margin-right: 5px;
        /* Space between icon and text if needed */
    }

    .search-container {
        padding: 20px;
        background-color: #f8f9fa;
        display: flex;
        gap: 10px;
        position: relative;
    }

    .search-container input {
        font-family: 'Kreon', serif;
        padding-right: 40px;
        /* Make space for the icon */
    }

    .search-box {
        padding: 10px 12px;
        width: 100%;
        border: 1px solid #ced4da;
        border-radius: 50px;
        font-size: 0.95em;
        transition: border-color 0.2s;
    }

    .search-box:focus {
        outline: none;
        border-color: #f4d747;
    }

    .search-icon {
        position: absolute;
        right: 30px;
        /* Position the icon inside the search container */
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.1em;
        pointer-events: none;
        /* Ensure clicks go through to the input */
    }

    .add-btn {
        padding: 10px 16px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.2s;
    }

    .add-btn:hover {
        background-color: #2980b9;
    }

    .road-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .road-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 20px;
        border-bottom: 1px solid #eee;
        background-color: white;
        transition: background-color 0.2s;
    }

    .road-item:hover {
        background-color: #f4d747;
    }

    .road-item:last-child {
        border-bottom: none;
    }

    .road-name {
        font-family: 'Kreon', serif;
        font-size: 1.2em;
        color: #333;
    }

    .select-btn {
        font-family: 'Kreon', serif;
        padding: 8px 16px;
        background-color: #8d9676;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
        /* Added transition for smooth scaling */
        text-decoration: none;
    }

    .select-btn:hover {
        background-color: #373c2e;
    }

    /* New hover effect for road items */
    .road-item:hover .select-btn {
        transform: scale(1.05);
        /* Makes button slightly larger on hover */
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .container {
            width: 95%;
        }
    }

    @media (max-width: 768px) {
        .container {
            width: 100%;
            margin: 5vh auto;
        }

        .header h2 {
            font-size: 1.4em;
        }
    }

    @media (max-width: 480px) {
        .background {
            padding: 10px;
        }

        .container {
            width: 100%;
            margin: 0;
            border-radius: 0;
            border-left: none;
            border-right: none;
            border-bottom: none;
        }

        .header h2 {
            font-size: 1.2em;
        }

        .search-icon {
            right: 30px;
            /* Adjust position for mobile */
        }
    }
</style>
<div class="background">
    <div class="container">
        <div class="header">

            <a href="<?php echo $pth; ?>index<?php echo $online_offline_extention; ?>" class="back-btn"><i class="fas fa-arrow-left"></i></a>
            <h2>Select Your Street</h2>
        </div>
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Search Streets...">
            <i class="fas fa-search search-icon"></i>
        </div>
        <ul class="road-list" id="front_member_road_data_bodydata_body_1">
            <!-- <li class="road-item">
                <span class="road-name">Street 1</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Street 2</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Street 3</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Street 4</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Street 5</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Street 6</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>

            <li class="road-item">
                <span class="road-name">Street 6</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>

            <li class="road-item">
                <span class="road-name">Street 6</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>

            <li class="road-item">
                <span class="road-name">Street 6</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>

            <li class="road-item">
                <span class="road-name">Street 6</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>

            <li class="road-item">
                <span class="road-name">Street 6</span>
                <a href="<?php echo $pth; ?>member-form<?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li> -->
        </ul>
    </div>
</div>