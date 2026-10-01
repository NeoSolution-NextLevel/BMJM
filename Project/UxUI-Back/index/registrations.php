<link href="https://fonts.googleapis.com/css2?family=Kadwa&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .registration-section {
        display: flex;
        flex-direction: column;
        font-family: 'Kadwa', serif;
        width: 100%;
        height: 100%;
        margin: 0 auto;
    }

    /* Left Image Section */
    .registration-left {
        width: 100%;

        overflow: hidden;
    }

    .registration-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Right Content Section */
    .registration-right {
        width: 100%;
        background-color: #8D9676;
        /* olive tone */
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem 1.5rem;
    }

    .registration-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    /* Cards */
    .registration-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-top: 1px solid rgba(255, 255, 255, 0.3);
        padding: 1.5rem 0;
        gap: 1rem;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        width: 100%;
    }

    .icon-text {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        width: 100%;
    }

    .icon {
        width: 50px;
        height: 50px;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
    }

    .icon.mosque {
        background-image: url('https://img.icons8.com/ios-filled/50/ffffff/mosque.png');
    }

    .icon.zakat {
        background-image: url('https://img.icons8.com/ios-filled/50/ffffff/charity.png');
    }

    .icon.madrasa {
        background-image: url('https://img.icons8.com/ios-filled/50/ffffff/open-book.png');
    }

    .registration-card h2 {
        font-size: 1.2rem;
        font-weight: bold;
        margin: 0;
    }

    .registration-card p {
        font-size: 0.9rem;
        color: #e5e5e5;
        margin-top: 0.5rem;
        line-height: 1.4;
    }

    /* Button */
    .reg-btn {
        font-family: 'Kadwa', serif;
        display: inline-block;
        text-align: center;
        text-decoration: none;
        background-color: #D5BC75;
        color: white;
        border: none;
        border-radius: 30px;
        width: 100%;
        max-width: 200px;
        padding: 0.8rem 1.5rem;
        font-weight: bold;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .reg-btn:hover {
        background-color: #c8a75f;
        transform: translateY(-2px);
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.3);
    }

    .reg-btn:active {
        background-color: #D5BC75;
        transform: translateY(0);
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
    }

    /* Tablet Styles */
    @media (min-width: 768px) {
        .registration-section {
            flex-direction: row;
            height: 100%;
        }

        .registration-left {
            height: auto;
        }

        .registration-right {
            padding: 2rem;
        }

        .registration-card {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .card-content {
            flex-direction: row;
            align-items: center;
            text-align: left;
        }

        .icon-text {
            flex-direction: row;
            text-align: left;
            align-items: center;
            width: auto;
        }

        .reg-btn {
            width: auto;
            min-width: 150px;
        }
    }

    /* Desktop Styles */
    @media (min-width: 1024px) {
        .registration-section {
            height: 100%;
        }


        .registration-right {
            padding: 3rem;
        }

        .registration-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .icon {
            width: 40px;
            height: 40px;
        }

        .registration-card h2 {
            font-size: 1rem;
        }

        .reg-btn {
            width: 25%;
        }
    }

    /* Large Desktop Styles */
    @media (min-width: 1400px) {
        .registration-section {
            height: 100%;
        }
    }
</style>

<div class="registration-section">
    <div class="registration-left">
        <img src="<?php echo $home_page; ?>assets/images/index_page/registration.jpg" alt="Masjid Image">
    </div>

    <div class="registration-right">
        <h1 class="registration-title">REGISTRATIONS</h1>

        <div class="registration-card">
            <div class="card-content">
                <div class="icon-text">
                    <div class="icon mosque"></div>
                    <div>
                        <h2>MASJID MEMBERSHIP</h2>
                        <p>Join our community and grow in faith</p>
                    </div>
                </div>
            </div>
            <a href="<?php echo $pth; ?>Create-Masjid-Membership<?php echo $online_exnction; ?>" class="reg-btn">Register Now</a>
        </div>

        <div class="registration-card">
            <div class="card-content">
                <div class="icon-text">
                    <div class="icon zakat"></div>
                    <div>
                        <h2>MONTHLY SUBSCRIPTION</h2>
                        <p>Login to view and complete your member payments</p>
                    </div>
                </div>
            </div>
            <a href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>" class="reg-btn">Subscribe</a>
        </div>

        <div class="registration-card">
            <div class="card-content">
                <div class="icon-text">
                    <div class="icon madrasa"></div>
                    <div>
                        <h2>PAYMENT POLICIES</h2>
                        <p>Review the terms, payment process, and refund rules</p>
                    </div>
                </div>
            </div>
            <a href="<?php echo $pth; ?>payment-policy<?php echo $online_exnction; ?>" class="reg-btn">View Policies</a>
        </div>
    </div>
</div>
