<!DOCTYPE html>
<?php include_once './imports/need/session_setup.php'; ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bambalapitiya Jumma Mosque payment, subscription, terms, and refund policy pages.">
    <link rel="icon" type="image/png" href="./assets/favicon.png">
    <title>Bmjm | Payment Information</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bmjm-green-950: #0B2E24;
            --bmjm-green-800: #123832;
            --bmjm-green-700: #1B4B41;
            --bmjm-gold-600: #B8923D;
            --bmjm-gold-500: #C9A227;
            --bmjm-gold-300: #E4C766;
            --bmjm-cream-50: #FAF7F0;
            --bmjm-cream-100: #F2EDE0;
            --bmjm-white: #FFFFFF;
            --bmjm-ink-900: #1E2B26;
            --bmjm-ink-600: #5A6A62;
            --bmjm-ink-400: #8B978F;
            --bmjm-border: #E6E0D0;
        }

        body {
            min-height: 100vh;
            background:
                linear-gradient(180deg, rgba(242, 237, 224, 0.82), rgba(250, 247, 240, 1)),
                var(--bmjm-cream-50);
            color: var(--bmjm-ink-900);
            font-family: Inter, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;
        }

        .approval-home {
            min-height: 74vh;
            padding: 128px 20px 58px;
        }

        .approval-shell {
            width: min(1180px, 100%);
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(360px, 1.05fr);
            gap: 28px;
            align-items: stretch;
        }

        .approval-intro,
        .approval-panel {
            border: 1px solid var(--bmjm-border);
            border-radius: 18px;
            background: var(--bmjm-white);
            box-shadow: 0 12px 32px rgba(11, 46, 36, 0.06);
        }

        .approval-intro {
            padding: clamp(28px, 5vw, 46px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            position: relative;
        }

        .approval-intro::before {
            content: "";
            position: absolute;
            inset: 0 0 auto;
            height: 7px;
            background: linear-gradient(90deg, var(--bmjm-green-950), var(--bmjm-gold-500));
        }

        .approval-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            margin-bottom: 18px;
            padding: 8px 12px;
            border: 1px solid rgba(201, 162, 39, 0.34);
            border-radius: 999px;
            background: rgba(201, 162, 39, 0.12);
            color: var(--bmjm-green-800);
            font-size: 13px;
            font-weight: 800;
        }

        .approval-intro h1 {
            max-width: 560px;
            margin: 0 0 16px;
            color: var(--bmjm-green-950);
            font-family: Poppins, Inter, sans-serif;
            font-size: clamp(34px, 5vw, 58px);
            line-height: 1.04;
            letter-spacing: 0;
        }

        .approval-intro p {
            max-width: 610px;
            color: var(--bmjm-ink-600);
            font-size: 16px;
            line-height: 1.7;
        }

        .approval-primary-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .approval-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 800;
        }

        .approval-action.primary {
            background: var(--bmjm-green-950);
            color: var(--bmjm-white);
            box-shadow: 0 10px 24px rgba(11, 46, 36, 0.16);
        }

        .approval-action.secondary {
            background: var(--bmjm-cream-100);
            color: var(--bmjm-green-950);
            border: 1px solid var(--bmjm-border);
        }

        .approval-panel {
            padding: 22px;
        }

        .approval-panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 18px;
        }

        .approval-panel-head h2 {
            margin: 0;
            color: var(--bmjm-green-950);
            font-family: Poppins, Inter, sans-serif;
            font-size: 18px;
            letter-spacing: 0;
        }

        .approval-status {
            padding: 7px 10px;
            border-radius: 999px;
            background: #DCFCE7;
            color: #15803D;
            border: 1px solid #86EFAC;
            font-size: 12px;
            font-weight: 800;
        }

        .approval-links {
            display: grid;
            gap: 12px;
        }

        .approval-link {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr) 18px;
            align-items: center;
            gap: 14px;
            min-height: 74px;
            padding: 14px;
            border: 1px solid var(--bmjm-border);
            border-radius: 14px;
            background: var(--bmjm-cream-50);
            color: var(--bmjm-ink-900);
            text-decoration: none;
            transition: transform 160ms ease, border-color 160ms ease, box-shadow 160ms ease;
        }

        .approval-link:hover {
            transform: translateY(-2px);
            border-color: rgba(201, 162, 39, 0.58);
            box-shadow: 0 12px 28px rgba(11, 46, 36, 0.08);
        }

        .approval-link i:first-child {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--bmjm-green-950);
            color: var(--bmjm-gold-300);
        }

        .approval-link strong {
            display: block;
            color: var(--bmjm-green-950);
            font-size: 15px;
            line-height: 1.3;
        }

        .approval-link span {
            display: block;
            margin-top: 3px;
            color: var(--bmjm-ink-600);
            font-size: 13px;
            line-height: 1.4;
        }

        .approval-link i:last-child {
            color: var(--bmjm-ink-400);
        }

        @media (max-width: 900px) {
            .approval-home {
                padding-top: 106px;
            }

            .approval-shell {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .approval-home {
                padding: 92px 12px 38px;
            }

            .approval-intro,
            .approval-panel {
                border-radius: 14px;
            }

            .approval-panel {
                padding: 14px;
            }

            .approval-link {
                grid-template-columns: 38px minmax(0, 1fr);
            }

            .approval-link i:last-child {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include_once './UxUI-Back/Needs/header.php'; ?>

    <main class="approval-home">
        <div class="approval-shell">
            <section class="approval-intro">
                <div>
                    <div class="approval-kicker"><i class="fa-solid fa-shield-halved"></i>Bambalapitiya Jumma Mosque</div>
                    <h1>Bmjm Payment Information</h1>
                    <p>Access the required subscription, membership, payment policy, terms, refund, and contact pages for online payment approval.</p>
                </div>

                <div class="approval-primary-actions">
                    <a class="approval-action primary" href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>"><i class="fa-solid fa-lock"></i> Subscription Login</a>
                    <a class="approval-action secondary" href="<?php echo $pth; ?>Registration<?php echo $online_exnction; ?>"><i class="fa-solid fa-user-plus"></i> Membership</a>
                </div>
            </section>

            <section class="approval-panel" aria-label="Payment information links">
                <div class="approval-panel-head">
                    <h2>Quick Access</h2>
                    <span class="approval-status">Ready</span>
                </div>

                <div class="approval-links">
                    <a class="approval-link" href="<?php echo $pth; ?>payment-policy<?php echo $online_exnction; ?>">
                        <i class="fa-solid fa-credit-card"></i>
                        <span><strong>Payment Policy</strong><span>Accepted payments, confirmation, and support.</span></span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                    <a class="approval-link" href="<?php echo $pth; ?>terms-and-conditions<?php echo $online_exnction; ?>">
                        <i class="fa-solid fa-file-contract"></i>
                        <span><strong>Terms & Conditions</strong><span>Website, membership, and payment terms.</span></span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                    <a class="approval-link" href="<?php echo $pth; ?>refund-policy<?php echo $online_exnction; ?>">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span><strong>Refund Policy</strong><span>Duplicate, mistaken, and failed payment review.</span></span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                    <a class="approval-link" href="#contact">
                        <i class="fa-solid fa-phone"></i>
                        <span><strong>Contact Details</strong><span>Phone, email, and office location details.</span></span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </div>
            </section>
        </div>
    </main>

    <?php include_once './UxUI-Back/Needs/footer-home.php'; ?>
</body>

</html>
