<?php
include_once __DIR__ . '/../../imports/need/session_setup.php';

if (!function_exists('bmjm_policy_escape')) {
    function bmjm_policy_escape($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

$policy_title = isset($policy_title) ? $policy_title : 'Policy';
$policy_intro = isset($policy_intro) ? $policy_intro : '';
$policy_updated = isset($policy_updated) ? $policy_updated : 'September 11, 2026';
$policy_sections = isset($policy_sections) && is_array($policy_sections) ? $policy_sections : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo bmjm_policy_escape($policy_intro); ?>">
    <link rel="icon" type="image/png" href="./assets/favicon.png">
    <title><?php echo bmjm_policy_escape($policy_title); ?> | Bambalapitiya Jumma Masjid</title>
    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: #1f2d27;
            background: #f7f5ef;
            font-family: Arial, sans-serif;
        }

        .policy-page {
            padding-top: 126px;
        }

        .policy-hero {
            min-height: 280px;
            padding: 72px 20px 52px;
            color: #ffffff;
            text-align: center;
            background:
                linear-gradient(180deg, rgba(12, 44, 32, 0.72), rgba(12, 44, 32, 0.76)),
                url("./assets/images/mosque.jpg") center/cover no-repeat;
        }

        .policy-hero h1 {
            margin: 0 auto 14px;
            max-width: 900px;
            font-family: Georgia, serif;
            font-size: clamp(32px, 5vw, 56px);
            line-height: 1.1;
            letter-spacing: 0;
        }

        .policy-hero p {
            max-width: 760px;
            margin: 0 auto;
            font-size: 17px;
            line-height: 1.7;
        }

        .policy-updated {
            display: inline-block;
            margin-top: 24px;
            padding: 8px 16px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.12);
            font-size: 14px;
        }

        .policy-wrap {
            width: min(1120px, calc(100% - 32px));
            margin: 44px auto;
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            gap: 28px;
            align-items: start;
        }

        .policy-nav,
        .policy-card,
        .policy-cta {
            border: 1px solid #e3ded0;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 12px 36px rgba(31, 45, 39, 0.08);
        }

        .policy-nav {
            position: sticky;
            top: 150px;
            padding: 18px;
        }

        .policy-nav h2,
        .policy-cta h2 {
            margin: 0 0 14px;
            color: #173d31;
            font-size: 18px;
            letter-spacing: 0;
        }

        .policy-nav a {
            display: block;
            padding: 10px 0;
            color: #41534b;
            text-decoration: none;
            border-top: 1px solid #eee8dc;
            font-size: 15px;
        }

        .policy-nav a:hover {
            color: #997834;
        }

        .policy-card {
            padding: clamp(24px, 5vw, 48px);
        }

        .policy-section {
            padding-bottom: 28px;
            margin-bottom: 28px;
            border-bottom: 1px solid #eee8dc;
        }

        .policy-section:last-child {
            padding-bottom: 0;
            margin-bottom: 0;
            border-bottom: 0;
        }

        .policy-section h2 {
            margin: 0 0 14px;
            color: #173d31;
            font-size: clamp(22px, 3vw, 30px);
            font-family: Georgia, serif;
            letter-spacing: 0;
        }

        .policy-section p,
        .policy-section li {
            color: #41534b;
            font-size: 16px;
            line-height: 1.8;
        }

        .policy-section p {
            margin: 0 0 14px;
        }

        .policy-section ul {
            margin: 12px 0 0;
            padding-left: 20px;
        }

        .policy-cta {
            grid-column: 2;
            padding: 28px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
        }

        .policy-cta p {
            margin: 0;
            color: #52625b;
            line-height: 1.6;
        }

        .policy-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-end;
        }

        .policy-action {
            display: inline-block;
            min-width: 150px;
            padding: 12px 18px;
            border-radius: 8px;
            color: #ffffff;
            background: #858E6F;
            text-align: center;
            text-decoration: none;
            font-weight: 700;
        }

        .policy-action.secondary {
            color: #173d31;
            background: #D5BC75;
        }

        @media (max-width: 900px) {
            .policy-page {
                padding-top: 84px;
            }

            .policy-wrap {
                grid-template-columns: 1fr;
            }

            .policy-nav {
                position: static;
            }

            .policy-cta {
                grid-column: 1;
                flex-direction: column;
                align-items: flex-start;
            }

            .policy-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>
    <?php include_once __DIR__ . '/header.php'; ?>

    <main class="policy-page">
        <section class="policy-hero">
            <h1><?php echo bmjm_policy_escape($policy_title); ?></h1>
            <p><?php echo bmjm_policy_escape($policy_intro); ?></p>
            <span class="policy-updated">Last updated: <?php echo bmjm_policy_escape($policy_updated); ?></span>
        </section>

        <div class="policy-wrap">
            <aside class="policy-nav" aria-label="Policy pages">
                <h2>Policy Pages</h2>
                <a href="<?php echo $pth; ?>payment-policy<?php echo $online_exnction; ?>">Payment Policy</a>
                <a href="<?php echo $pth; ?>terms-and-conditions<?php echo $online_exnction; ?>">Terms & Conditions</a>
                <a href="<?php echo $pth; ?>refund-policy<?php echo $online_exnction; ?>">Refund Policy</a>
                <a href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">Subscription Login</a>
            </aside>

            <article class="policy-card">
                <?php foreach ($policy_sections as $section) : ?>
                    <section class="policy-section">
                        <h2><?php echo bmjm_policy_escape($section['title']); ?></h2>

                        <?php if (!empty($section['paragraphs'])) : ?>
                            <?php foreach ($section['paragraphs'] as $paragraph) : ?>
                                <p><?php echo bmjm_policy_escape($paragraph); ?></p>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($section['items'])) : ?>
                            <ul>
                                <?php foreach ($section['items'] as $item) : ?>
                                    <li><?php echo bmjm_policy_escape($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </section>
                <?php endforeach; ?>
            </article>

            <section class="policy-cta">
                <div>
                    <h2>Membership & Subscription</h2>
                    <p>Members can sign in to view available payments, subscription details, and receipts.</p>
                </div>
                <div class="policy-actions">
                    <a class="policy-action secondary" href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">Subscription Login</a>
                    <a class="policy-action" href="<?php echo $pth; ?>Create-Masjid-Membership<?php echo $online_exnction; ?>">Become a Member</a>
                </div>
            </section>
        </div>
    </main>

    <?php include_once __DIR__ . '/footer-home.php'; ?>
</body>

</html>
