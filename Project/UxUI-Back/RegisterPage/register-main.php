<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
<?php include_once './imports/need/session_setup.php'; ?>

<!-- IMPORTANT: make sure your <head> (page template) has this meta:
<meta name="viewport" content="width=device-width, initial-scale=1">
-->

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

    .conference-container {
        font-family: 'Inter', sans-serif;
        color: white;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px 20px;
        box-sizing: border-box;
        position: relative;
        overflow: hidden;
    }

    /* Background image with overlay */
    .conference-container::before {
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

    /* Gradient overlay */
    .conference-container::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(189, 219, 213, 0.5), rgba(22, 33, 62, 0.8));
        z-index: 1;
    }

    /* Ensure content is above overlays */
    .conference-container>* {
        position: relative;
        z-index: 2;
    }

    .logo {
        margin-bottom: 1rem;
        max-width: 600px;
    }

    .logo img {
        width: 30vw;
        height: auto;
        max-width: 300px;
    }

    .conference-title {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        max-width: 90%;
    }

    .conference-subtitle {
        font-size: 1.1rem;
        margin-bottom: 2.5rem;
        opacity: 0.9;
        max-width: 500px;
    }

    .registration-form {
        display: flex;
        justify-content: center;
        gap: 0;
        margin-bottom: 2rem;
        max-width: 500px;
        width: 100%;
    }

    .register-btn {
        font-family: 'Inter', sans-serif;
        padding: 15px 30px;
        background: #f4d747;
        color: #000;
        border: none;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.3s;
        width: 50%;
    }

    .register-btn:hover {
        background: #f3aa35;
    }

    a {
        text-decoration: none;
        color: #000;
    }

    /* Responsive adjustments */

    /* Tablet styles */
    @media (max-width: 1024px) {
        .logo img {
            width: 40vw;
        }

        .registration-form {
            max-width: 400px;
        }

        .register-btn {
            width: 60%;
        }
    }

    /* Mobile styles */
    @media (max-width: 768px) {
        .conference-container {
            padding: 30px 15px;
            justify-content: flex-start;
            padding-top: 60px;
        }

        .logo {
            margin-top: 20vh;
            margin-bottom: 1.5rem;
        }

        .logo img {
            width: 60vw;
            max-width: 250px;
        }

        .conference-title {
            font-size: clamp(1.8rem, 6vw, 2.5rem);
            margin-bottom: 1.2rem;
        }

        .conference-subtitle {
            font-size: 1rem;
            margin-bottom: 2rem;
            padding: 0 10px;
        }

        .registration-form {
            max-width: 100%;
        }

        .register-btn {
            width: 70%;
            padding: 14px 25px;
            font-size: 1.1rem;
        }
    }

    /* Small mobile styles */
    @media (max-width: 480px) {
        .conference-container {
            padding: 25px 10px;
            padding-top: 50px;
        }

        .logo {
            margin-top: 20vh;
        }

        .logo img {
            width: 70vw;
        }

        .conference-title {
            font-size: 1.8rem;
        }

        .conference-subtitle {
            font-size: 0.95rem;
            margin-bottom: 1.8rem;
        }

        .register-btn {
            width: 80%;
            padding: 12px 20px;
            font-size: 1rem;
        }
    }
</style>

<div class="conference-container">
    <div class="logo">
        <img src="./assets/images/logo1.png" alt="w2gem Logo">
    </div>
    <h1 class="conference-title">Join our community of faith</h1>
    <p class="conference-subtitle">An interactive online experience by the community, free for everyone</p>
    <form class="registration-form">
        <a href="<?php echo $pth; ?>road-list<?php echo $online_offline_extention; ?>?type=new"
            class="register-btn">Register</a>
    </form>

    <form class="registration-form">
        <a href="<?php echo $pth; ?>road-list<?php echo $online_offline_extention; ?>?type=old"
            class="register-btn">Exciting New Member</a>
    </form>

</div>