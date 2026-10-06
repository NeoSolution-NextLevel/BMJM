<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
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
        --bmjm-border: #E6E0D0;
        --bmjm-shadow: 0 12px 32px rgba(11, 46, 36, 0.08);
    }

    .site-header-shell,
    .site-header-shell * {
        box-sizing: border-box;
    }

    .site-header-shell {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        padding: 12px 20px;
        font-family: Inter, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;
    }

    .site-header {
        max-width: 1180px;
        min-height: 68px;
        margin: 0 auto;
        padding: 10px 12px 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        border: 1px solid rgba(230, 224, 208, 0.88);
        border-radius: 18px;
        background: rgba(250, 247, 240, 0.94);
        box-shadow: var(--bmjm-shadow);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
    }

    .site-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 220px;
        color: var(--bmjm-ink-900);
        text-decoration: none;
    }

    .site-brand img {
        width: 44px;
        height: 44px;
        object-fit: contain;
    }

    .site-brand-title {
        display: block;
        font-family: Poppins, Inter, sans-serif;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.1;
        letter-spacing: 0;
    }

    .site-brand-subtitle {
        display: block;
        margin-top: 2px;
        color: var(--bmjm-ink-600);
        font-size: 12px;
        font-weight: 500;
    }

    .site-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        flex: 1;
    }

    .site-nav a,
    .site-mobile-nav a {
        color: var(--bmjm-ink-600);
        text-decoration: none;
        font-weight: 700;
        letter-spacing: 0;
        transition: color 160ms ease, background 160ms ease, border-color 160ms ease;
    }

    .site-nav a {
        padding: 10px 12px;
        border-radius: 10px;
        font-size: 13px;
        white-space: nowrap;
    }

    .site-nav a:hover,
    .site-nav a.active {
        color: var(--bmjm-green-950);
        background: var(--bmjm-cream-100);
    }

    .site-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .site-header-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 0 16px;
        border-radius: 10px;
        background: var(--bmjm-green-950);
        color: var(--bmjm-white);
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 8px 22px rgba(11, 46, 36, 0.16);
    }

    .site-header-btn:hover {
        background: var(--bmjm-green-700);
    }

    .site-menu-toggle {
        display: none;
        width: 42px;
        height: 42px;
        border: 1px solid var(--bmjm-border);
        border-radius: 10px;
        background: var(--bmjm-white);
        color: var(--bmjm-green-950);
        cursor: pointer;
        font-size: 18px;
    }

    .site-mobile-panel,
    .site-mobile-overlay {
        display: none;
    }

    .site-mobile-overlay.active {
        display: block;
        position: fixed;
        inset: 0;
        z-index: 1000;
        background: rgba(11, 46, 36, 0.48);
    }

    .site-mobile-panel.active {
        display: flex;
        position: fixed;
        top: 14px;
        right: 14px;
        bottom: 14px;
        z-index: 1001;
        width: min(360px, calc(100vw - 28px));
        padding: 18px;
        flex-direction: column;
        border: 1px solid var(--bmjm-border);
        border-radius: 18px;
        background: var(--bmjm-white);
        box-shadow: 0 24px 60px rgba(11, 46, 36, 0.22);
        font-family: Inter, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;
    }

    .site-mobile-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 14px;
        border-bottom: 1px solid var(--bmjm-border);
    }

    .site-mobile-title {
        color: var(--bmjm-green-950);
        font-family: Poppins, Inter, sans-serif;
        font-size: 16px;
        font-weight: 700;
    }

    .site-mobile-close {
        width: 38px;
        height: 38px;
        border: 1px solid var(--bmjm-border);
        border-radius: 10px;
        background: var(--bmjm-cream-50);
        color: var(--bmjm-green-950);
        cursor: pointer;
        font-size: 18px;
    }

    .site-mobile-nav {
        display: grid;
        gap: 8px;
        padding: 18px 0;
    }

    .site-mobile-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        min-height: 48px;
        padding: 0 14px;
        border: 1px solid transparent;
        border-radius: 12px;
        font-size: 15px;
    }

    .site-mobile-nav a:hover,
    .site-mobile-nav a.active {
        border-color: var(--bmjm-border);
        background: var(--bmjm-cream-50);
        color: var(--bmjm-green-950);
    }

    .site-mobile-contact {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--bmjm-border);
        color: var(--bmjm-ink-600);
        font-size: 13px;
        line-height: 1.7;
    }

    .site-mobile-contact a {
        color: var(--bmjm-green-700);
        text-decoration: none;
        font-weight: 700;
    }

    @media (max-width: 1050px) {
        .site-header {
            min-height: 64px;
        }

        .site-nav,
        .site-header-btn {
            display: none;
        }

        .site-brand {
            min-width: 0;
        }

        .site-menu-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    }

    @media (max-width: 520px) {
        .site-header-shell {
            padding: 8px;
        }

        .site-header {
            border-radius: 14px;
            padding: 8px 10px;
        }

        .site-brand img {
            width: 38px;
            height: 38px;
        }

        .site-brand-title {
            font-size: 13px;
        }

        .site-brand-subtitle {
            font-size: 11px;
        }
    }
</style>

<div class="site-header-shell">
    <header class="site-header" aria-label="Main navigation">
        <a class="site-brand" href="<?php echo $pth; ?>index<?php echo $online_exnction; ?>">
            <img src="<?php echo $pth; ?>assets/images/common-images/logo.png" alt="Bambalapitiya Jumma Masjid">
            <span>
                <span class="site-brand-title">Bambalapitiya Jumma Masjid</span>
                <!-- <span class="site-brand-subtitle">Payment gateway information</span> -->
            </span>
        </a>

        <nav class="site-nav" aria-label="Primary">
            <a href="<?php echo $pth; ?>index<?php echo $online_exnction; ?>">Home</a>
            <a href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">Subscription</a>
            <a href="<?php echo $pth; ?>payment-policy<?php echo $online_exnction; ?>">Payment Policy</a>
            <a href="<?php echo $pth; ?>terms-and-conditions<?php echo $online_exnction; ?>">Terms</a>
            <a href="<?php echo $pth; ?>refund-policy<?php echo $online_exnction; ?>">Refund</a>
            <a href="<?php echo $pth; ?>index<?php echo $online_exnction; ?>#contact">Contact</a>
        </nav>

        <div class="site-header-actions">
            <a class="site-header-btn" href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">
                <i class="fa-solid fa-lock"></i>
                Login
            </a>
            <button class="site-menu-toggle" type="button" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>
</div>

<div class="site-mobile-overlay"></div>
<aside class="site-mobile-panel" aria-label="Mobile navigation">
    <div class="site-mobile-head">
        <div class="site-mobile-title">Menu</div>
        <button class="site-mobile-close" type="button" aria-label="Close menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <nav class="site-mobile-nav">
        <a href="<?php echo $pth; ?>index<?php echo $online_exnction; ?>"><i class="fa-solid fa-house"></i> Home</a>
        <a href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>"><i class="fa-solid fa-lock"></i> Subscription Login</a>
        <a href="<?php echo $pth; ?>Create-Masjid-Membership<?php echo $online_exnction; ?>"><i class="fa-solid fa-user-plus"></i> Membership</a>
        <a href="<?php echo $pth; ?>payment-policy<?php echo $online_exnction; ?>"><i class="fa-solid fa-credit-card"></i> Payment Policy</a>
        <a href="<?php echo $pth; ?>terms-and-conditions<?php echo $online_exnction; ?>"><i class="fa-solid fa-file-contract"></i> Terms & Conditions</a>
        <a href="<?php echo $pth; ?>refund-policy<?php echo $online_exnction; ?>"><i class="fa-solid fa-rotate-left"></i> Refund Policy</a>
        <a href="<?php echo $pth; ?>index<?php echo $online_exnction; ?>#contact"><i class="fa-solid fa-phone"></i> Contact</a>
    </nav>

    <div class="site-mobile-contact">
        <div><a href="tel:+947034457812">+94 70 344 578 12</a></div>
        <div><a href="mailto:Bambalapitiyajummamasjid@gmail.com">Bambalapitiyajummamasjid@gmail.com</a></div>
        <div>Bambalapitiya Jumma Masjid, Colombo</div>
    </div>
</aside>

<script>
    (function() {
        const toggle = document.querySelector('.site-menu-toggle');
        const close = document.querySelector('.site-mobile-close');
        const panel = document.querySelector('.site-mobile-panel');
        const overlay = document.querySelector('.site-mobile-overlay');
        const navLinks = document.querySelectorAll('.site-nav a, .site-mobile-nav a');

        function openMenu() {
            panel.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            panel.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (toggle) toggle.addEventListener('click', openMenu);
        if (close) close.addEventListener('click', closeMenu);
        if (overlay) overlay.addEventListener('click', closeMenu);

        navLinks.forEach((link) => {
            const href = link.getAttribute('href') || '';
            const currentPath = window.location.pathname.split('/').pop() || 'index.php';
            const linkFile = href.split('#')[0].split('/').pop() || 'index.php';

            if (currentPath === linkFile && href.indexOf('#') === -1) {
                link.classList.add('active');
            }

            link.addEventListener('click', closeMenu);
        });
    })();
</script>
