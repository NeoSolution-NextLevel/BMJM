<!DOCTYPE html>
<?php
include_once '../../imports/need/session_setup.php';
include_once '../../imports/Company_Info/Company_Info_Variable_List.php';

$company_obj = new Company_Info_Variable_List();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/images/logo.png">
    <title>Request Failed | bmjm</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --erp-primary: #0B2E24;
            --erp-primary-dark: #09261E;
            --erp-primary-light: #1B4B41;
            --erp-primary-subtle: rgba(201, 162, 39, 0.14);
            --erp-surface: #FFFFFF;
            --erp-surface-alt: #FAF7F0;
            --erp-border: #E6E0D0;
            --erp-text-primary: #1E2B26;
            --erp-text-secondary: #5A6A62;
            --erp-text-tertiary: #8B978F;
            --erp-error-light: #FDEDEC;
            --erp-error-medium: #F2A7A1;
            --erp-error-dark: #B0453A;
            --erp-error-darker: #8F352D;
            --erp-error-glow: rgba(176, 69, 58, 0.24);
            --erp-accent-success: #178A4E;
            --erp-accent-warning: #B8923D;
            --erp-accent-error: #B0453A;
            --erp-accent-info: #1B4B41;
            --erp-gold: #C9A227;
            --erp-gold-light: #E4C766;
            --erp-shadow-sm: 0 2px 8px rgba(11, 46, 36, 0.06);
            --erp-shadow-md: 0 6px 18px rgba(11, 46, 36, 0.12);
            --erp-shadow-lg: 0 20px 60px rgba(11, 46, 36, 0.16);
            --erp-radius-sm: 8px;
            --erp-radius-md: 8px;
            --erp-radius-lg: 22px;
            --erp-radius-full: 50%;
            --erp-space-xs: 8px;
            --erp-space-sm: 12px;
            --erp-space-md: 16px;
            --erp-space-lg: 24px;
            --erp-space-xl: 32px;
            --erp-space-2xl: 48px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            background: var(--erp-surface-alt);
            color: var(--erp-text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow-x: hidden;
        }

        .erp-container {
            width: 100%;
            max-width: 1040px;
        }

        .erp-container--login {
            max-width: 1040px;
        }

        .erp-error-card {
            width: 100%;
            min-height: 560px;
            background: var(--erp-surface);
            border: 1px solid var(--erp-border);
            border-radius: var(--erp-radius-lg);
            box-shadow: var(--erp-shadow-lg);
            overflow: hidden;
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
        }

        .erp-error-card__header {
            position: relative;
            overflow: hidden;
            background: linear-gradient(315deg, var(--erp-primary-light), var(--erp-primary-dark));
            color: #FFFFFF;
            padding: 42px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .erp-error-card__header::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(11, 46, 36, 0.78), rgba(11, 46, 36, 0.56));
            z-index: 1;
            pointer-events: none;
        }

        .erp-error-card__photo {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .erp-error-card__logo {
            position: relative;
            z-index: 2;
            width: 150px;
            height: 150px;
            object-fit: contain;
            color: var(--erp-gold-light);
        }

        .erp-error-card__brand-copy {
            position: relative;
            z-index: 2;
        }

        .erp-error-card__title {
            margin: 0 0 12px;
            color: #FFFFFF;
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 30px;
            line-height: 1.2;
            font-weight: 700;
        }

        .erp-error-card__subtitle {
            max-width: 330px;
            color: rgba(250, 247, 240, 0.78);
            font-size: 14px;
            line-height: 1.6;
        }

        .erp-error-card__body {
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .erp-error-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 26px;
        }

        .erp-error-circle {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid var(--erp-error-light);
            animation: circle-pulse 2s ease-out infinite;
        }

        .erp-error-circle:nth-child(2) {
            border-color: var(--erp-error-medium);
            animation-delay: .45s;
        }

        .erp-error-circle:nth-child(3) {
            border-color: var(--erp-error-dark);
            animation-delay: .9s;
        }

        @keyframes circle-pulse {
            from {
                transform: scale(.72);
                opacity: .8;
            }
            to {
                transform: scale(1.18);
                opacity: 0;
            }
        }

        .erp-error-icon {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: var(--erp-error-dark);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            box-shadow: 0 12px 28px var(--erp-error-glow);
            z-index: 2;
        }

        .erp-broken-piece,
        .erp-error-particle,
        .erp-error-details {
            display: none !important;
        }

        .erp-error-message {
            max-width: 620px;
            min-height: 70px;
            margin: 0 auto 14px;
            color: var(--erp-text-primary);
            text-align: center;
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 21px;
            line-height: 1.45;
            font-weight: 600;
        }

        .erp-text-center {
            text-align: center;
        }

        .erp-text-tertiary {
            color: var(--erp-text-tertiary);
        }

        .erp-text-sm {
            font-size: 13px;
        }

        .erp-mt-md {
            margin-top: 16px;
        }

        .erp-btn-group {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 28px;
        }

        .erp-btn {
            height: 48px;
            border-radius: var(--erp-radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border: none;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: transform .1s ease, box-shadow .15s ease, background .15s ease, color .15s ease;
        }

        .erp-btn:active {
            transform: translateY(1px);
        }

        .erp-btn--primary {
            background: linear-gradient(135deg, var(--erp-gold-light), var(--erp-gold));
            color: var(--erp-primary-dark);
            box-shadow: 0 4px 12px rgba(184, 146, 61, 0.35);
        }

        .erp-btn--primary:hover {
            box-shadow: 0 6px 18px rgba(184, 146, 61, 0.45);
        }

        .erp-btn--secondary {
            background: #FFFFFF;
            color: var(--erp-primary);
            border: 1px solid var(--erp-border);
            box-shadow: var(--erp-shadow-sm);
        }

        .erp-btn--secondary:hover {
            border-color: var(--erp-gold);
            background: var(--erp-primary-subtle);
        }

        .erp-btn--block {
            width: 100%;
        }

        .erp-error-card__footer {
            margin-top: 28px;
            color: var(--erp-text-tertiary);
            text-align: center;
            font-size: 11.5px;
        }

        .erp-footer__copyright,
        .erp-footer__version {
            margin: 0;
        }

        .erp-footer__version {
            display: none;
        }

        @media (max-width: 820px) {
            body {
                padding: 16px;
            }

            .erp-error-card {
                grid-template-columns: 1fr;
                min-height: 0;
            }

            .erp-error-card__header {
                min-height: 280px;
                padding: 34px 30px;
            }

            .erp-error-card__logo {
                width: 118px;
                height: 118px;
            }

            .erp-error-card__body {
                padding: 34px 28px 38px;
            }
        }

        @media (max-width: 560px) {
            .erp-btn-group {
                grid-template-columns: 1fr;
            }

            .erp-error-card__title {
                font-size: 25px;
            }

            .erp-error-message {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <?php include_once '../../imports/need/processing_loader.php'; ?>
    <?php include_once '../../UxUI-Back/Main/Failed-Page/Failed-Page.php'; ?>
    <?php include_once '../../UxUI-Back/Main/Failed-Page/JS/Failed-Page_JS.php'; ?>
</body>

</html>
