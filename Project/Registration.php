<?php
include_once 'imports/need/session_setup.php';
include_once 'imports/Company_Info/Company_Info_Variable_List.php';

$company_obj = new Company_Info_Variable_List();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#0B2E24">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Member Signup | bmjm</title>
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bmjm-member-mobile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        :root {
            --sg-green-950: #0B2E24;
            --sg-green-800: #123832;
            --sg-green-700: #1B4B41;
            --sg-gold: #C9A227;
            --sg-gold-600: #B8923D;
            --sg-gold-300: #E4C766;
            --sg-cream: #FAF7F0;
            --sg-cream-100: #F2EDE0;
            --sg-white: #FFFFFF;
            --sg-ink: #1E2B26;
            --sg-muted: #5A6A62;
            --sg-faint: #8B978F;
            --sg-border: #E6E0D0;
            --sg-danger: #B0453A;
            --sg-radius: 16px;
            --sg-shadow: 0 16px 40px rgba(11, 46, 36, 0.10);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; min-height: 100%; overflow-x: hidden; }
        body {
            min-height: 100vh;
            background:
                radial-gradient(900px 420px at 8% -10%, rgba(201, 162, 39, 0.12), transparent 55%),
                radial-gradient(700px 380px at 100% 0%, rgba(27, 75, 65, 0.10), transparent 50%),
                var(--sg-cream);
            color: var(--sg-ink);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
            padding: 20px 16px 32px;
            padding-bottom: max(32px, env(safe-area-inset-bottom));
        }

        .signup-shell {
            width: 100%;
            max-width: 760px;
            margin: 0 auto;
        }

        .signup-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
            padding: 4px 16px;
            background: linear-gradient(135deg, var(--sg-green-800), var(--sg-green-950));
            border-radius: 14px;
        }
        .signup-top-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
            min-width: 0;
        }
        .signup-brand-badge {
            width: 112px;
            height: 112px;
            border-radius: 0;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: visible;
            flex: 0 0 112px;
        }
        .signup-brand-badge img {
            width: 112px;
            height: 112px;
            max-width: none;
            object-fit: contain;
            background: transparent;
        }
        .signup-brand-badge.is-fallback img { display: none; }
        .signup-brand-badge.is-fallback::after {
            content: "W";
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--sg-gold-300);
        }
        .signup-top-brand strong {
            display: block;
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 16px;
            color: var(--sg-cream);
            line-height: 1.1;
        }
        .signup-top-brand small {
            display: block;
            color: var(--sg-gold-300);
            font-size: 12px;
            margin-top: 2px;
        }
        .signup-top-link {
            height: 38px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid rgba(228, 199, 102, 0.45);
            background: rgba(250, 247, 240, 0.10);
            color: var(--sg-cream);
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }

        .signup-steps {
            display: grid;
            grid-template-columns: auto 1fr auto 1fr auto;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }
        .signup-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--sg-faint);
            white-space: nowrap;
        }
        .signup-step span {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--sg-cream-100);
            color: var(--sg-muted);
            font-size: 11px;
            font-weight: 700;
        }
        .signup-step.is-active { color: var(--sg-green-950); }
        .signup-step.is-active span,
        .signup-step.is-done span {
            background: var(--sg-green-800);
            color: var(--sg-cream);
        }
        .signup-step.is-done span {
            font-size: 0;
        }
        .signup-step.is-done span::before {
            content: "";
            width: 8px;
            height: 5px;
            border-left: 2px solid var(--sg-cream);
            border-bottom: 2px solid var(--sg-cream);
            transform: rotate(-45deg) translateY(-1px);
        }
        .signup-steps-line {
            height: 2px;
            background: var(--sg-border);
            border-radius: 2px;
        }

        .signup-card {
            background: var(--sg-white);
            border: 1px solid var(--sg-border);
            border-radius: var(--sg-radius);
            box-shadow: var(--sg-shadow);
            overflow: hidden;
        }
        .signup-card-head {
            padding: 22px 24px 16px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }
        .signup-card-head h1 {
            margin: 0;
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--sg-green-950);
        }
        .signup-card-head p {
            margin: 6px 0 0;
            color: var(--sg-muted);
            font-size: 13.5px;
            line-height: 1.45;
        }
        .signup-change-road {
            border: 1px solid var(--sg-border);
            background: var(--sg-cream);
            color: var(--sg-green-700);
            border-radius: 999px;
            height: 34px;
            padding: 0 12px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }
        .signup-card-body { padding: 0 24px 24px; }

        .signup-search-wrap {
            position: relative;
            margin-bottom: 14px;
        }
        .signup-search-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--sg-faint);
            pointer-events: none;
        }
        .signup-search-wrap input {
            width: 100%;
            height: 48px;
            border: 1px solid var(--sg-border);
            border-radius: 12px;
            padding: 0 14px 0 42px;
            background: var(--sg-cream);
            font: inherit;
            font-size: 15px;
            color: var(--sg-ink);
            outline: none;
        }
        .signup-search-wrap input:focus {
            background: #fff;
            border-color: var(--sg-gold);
            box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.16);
        }

        .signup-road-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: min(52vh, 420px);
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .signup-road-row {
            display: grid;
            grid-template-columns: 40px 1fr auto;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: var(--sg-cream);
            border: 1px solid var(--sg-border);
            border-radius: 12px;
        }
        .signup-road-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--sg-green-800);
            color: var(--sg-gold-300);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .signup-road-icon svg { width: 18px; height: 18px; }
        .signup-road-name {
            font-weight: 700;
            font-size: 14.5px;
            color: var(--sg-green-950);
            min-width: 0;
            overflow-wrap: anywhere;
        }
        .signup-road-select {
            height: 36px;
            padding: 0 14px;
            border: none;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--sg-gold-300), var(--sg-gold));
            color: var(--sg-green-950);
            font-weight: 700;
            font-size: 12.5px;
            cursor: pointer;
        }
        .signup-empty {
            text-align: center;
            color: var(--sg-faint);
            padding: 28px 8px;
            font-size: 13.5px;
        }

        .signup-form { padding: 0 24px 20px; }
        .signup-selected-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 16px;
            flex-wrap: wrap;
        }
        .signup-road-chip {
            display: inline-flex;
            align-items: center;
            max-width: 100%;
            margin: 0;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--sg-cream-100);
            color: var(--sg-green-800);
            font-size: 12.5px;
            font-weight: 700;
        }
        .signup-road-chip:empty { display: none; }
        .signup-selected-bar:has(.signup-road-chip:empty) .signup-change-road { display: none; }

        .signup-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .signup-span-2 { grid-column: 1 / -1; }
        .signup-field { display: flex; flex-direction: column; gap: 6px; min-width: 0; }
        .signup-field label {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--sg-muted);
        }
        .signup-required { color: var(--sg-danger); }
        .signup-field input[type="text"],
        .signup-field input[type="email"],
        .signup-field input[type="tel"],
        .signup-field input[type="number"] {
            width: 100%;
            height: 46px;
            border: 1px solid var(--sg-border);
            border-radius: 10px;
            padding: 0 12px;
            font: inherit;
            font-size: 15px;
            background: var(--sg-cream);
            color: var(--sg-ink);
            outline: none;
        }
        .signup-field input:focus {
            background: #fff;
            border-color: var(--sg-gold);
            box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.16);
        }
        .signup-error { display: none; font-size: 12px; color: var(--sg-danger); }
        .signup-invalid input { border-color: var(--sg-danger) !important; }
        .signup-invalid .signup-error { display: block; }

        .signup-choice-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .signup-choice {
            display: block;
            position: relative;
            cursor: pointer;
        }
        .signup-choice input { position: absolute; opacity: 0; pointer-events: none; }
        .signup-choice span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 10px;
            border: 1px solid var(--sg-border);
            border-radius: 10px;
            background: var(--sg-cream);
            font-size: 13.5px;
            font-weight: 700;
            color: var(--sg-green-800);
            text-align: center;
        }
        .signup-choice input:checked + span {
            background: var(--sg-green-800);
            border-color: var(--sg-green-800);
            color: var(--sg-cream);
        }

        .signup-inline-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 4px;
            font-size: 13px;
            font-weight: 600;
            color: var(--sg-muted);
            cursor: pointer;
        }
        .signup-inline-check input { width: 16px; height: 16px; accent-color: var(--sg-green-700); }

        .signup-block {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            padding: 16px;
            background: var(--sg-cream);
            border: 1px solid var(--sg-border);
            border-radius: 14px;
        }
        .signup-block h2 {
            grid-column: 1 / -1;
            margin: 0;
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 14px;
            color: var(--sg-green-800);
        }

        .signup-flags {
            grid-column: 1 / -1;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .signup-flag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: var(--sg-cream);
            border: 1px solid var(--sg-border);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .signup-flag input { width: 16px; height: 16px; accent-color: var(--sg-green-700); }
        .signup-flag:has(input:checked) {
            background: var(--sg-green-800);
            border-color: var(--sg-green-800);
            color: var(--sg-cream);
        }
        #signup-field-whatsapp { display: none; }

        .signup-form-error {
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            background: rgba(176, 69, 58, 0.08);
            color: var(--sg-danger);
            font-size: 13px;
            font-weight: 600;
        }

        .signup-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }
        .signup-btn {
            height: 48px;
            padding: 0 18px;
            border-radius: 10px;
            border: none;
            font: inherit;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .signup-btn-ghost {
            flex: 0 0 auto;
            background: var(--sg-white);
            border: 1px solid var(--sg-border);
            color: var(--sg-muted);
        }
        .signup-btn-primary {
            flex: 1;
            background: linear-gradient(135deg, var(--sg-gold-300), var(--sg-gold));
            color: var(--sg-green-950);
            box-shadow: 0 6px 16px rgba(184, 146, 61, 0.28);
        }
        .signup-btn-primary:disabled { opacity: 0.65; }

        .signup-success {
            padding: 40px 24px 36px;
            text-align: center;
        }
        .signup-success-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: var(--sg-green-800);
            color: var(--sg-gold-300);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .signup-success-icon svg { width: 28px; height: 28px; }
        .signup-success h1 {
            margin: 0 0 8px;
            font-family: 'Poppins', Inter, sans-serif;
            font-size: 22px;
            color: var(--sg-green-950);
        }
        .signup-success p {
            margin: 0 0 22px;
            color: var(--sg-muted);
            font-size: 14.5px;
            line-height: 1.55;
        }
        .signup-success .signup-btn { width: min(100%, 260px); }

        .signup-foot {
            margin: 16px 0 0;
            text-align: center;
            color: var(--sg-faint);
            font-size: 12px;
        }
        .signup-foot a { color: var(--sg-green-700); font-weight: 700; text-decoration: none; }

        @media (max-width: 720px) {
            body { padding: 0; padding-bottom: env(safe-area-inset-bottom); }
            .signup-shell { max-width: none; }
            .signup-top {
                margin: 0;
                padding: 12px 16px;
                padding-top: max(12px, env(safe-area-inset-top));
                background: linear-gradient(135deg, var(--sg-green-800), var(--sg-green-950));
                border-radius: 0;
            }
            .signup-steps { padding: 12px 16px 0; margin-bottom: 10px; gap: 4px; }
            .signup-step { font-size: 11px; gap: 5px; }
            .signup-card {
                border-radius: 16px 16px 0 0;
                border-left: 0;
                border-right: 0;
                box-shadow: none;
                min-height: calc(100vh - 130px);
            }
            .signup-card-head,
            .signup-card-body,
            .signup-form { padding-left: 16px; padding-right: 16px; }
            .signup-card-head { padding-top: 18px; flex-wrap: wrap; }
            .signup-card-head h1 { font-size: 20px; }
            .signup-grid,
            .signup-block,
            .signup-choice-row { grid-template-columns: 1fr; }
            .signup-field input[type="text"],
            .signup-field input[type="email"],
            .signup-field input[type="tel"],
            .signup-field input[type="number"],
            .signup-search-wrap input,
            .signup-btn { height: 48px; font-size: 16px; }
            .signup-road-row { grid-template-columns: 40px 1fr auto; }
            .signup-road-select { width: auto; min-width: 76px; height: 40px; }
            .signup-actions {
                position: sticky;
                bottom: 0;
                margin: 16px -16px 0;
                padding: 12px 16px calc(12px + env(safe-area-inset-bottom));
                background: linear-gradient(180deg, rgba(255,255,255,0), #fff 18%);
            }
            .signup-btn-ghost { flex: 1; }
            .signup-success { padding: 32px 16px; }
        }
    </style>
</head>

<body>
    <?php include_once 'imports/need/processing_loader.php'; ?>
    <?php
    include_once 'UxUI-Back/Main/Main_User_Account_Create/User_Registration_A_01.php';
    include_once 'UxUI-Back/Main/Main_User_Account_Create/JS/User_Registration_A_01_JS.php';
    ?>
</body>

</html>
