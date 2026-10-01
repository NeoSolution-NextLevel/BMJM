<style>
    .site-footer-modern,
    .site-footer-modern * {
        box-sizing: border-box;
    }

    .site-footer-modern {
        background: #0B2E24;
        color: #FFFFFF;
        font-family: Inter, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif;
    }

    .site-footer-inner {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
        padding: 42px 0 28px;
        display: grid;
        grid-template-columns: minmax(260px, 1.2fr) repeat(3, minmax(160px, 1fr));
        gap: 28px;
    }

    .site-footer-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }

    .site-footer-brand img {
        width: 54px;
        height: 54px;
        object-fit: contain;
        border-radius: 12px;
        background: #FAF7F0;
        padding: 6px;
    }

    .site-footer-brand h2 {
        margin: 0;
        color: #FFFFFF;
        font-family: Poppins, Inter, sans-serif;
        font-size: 18px;
        line-height: 1.2;
        letter-spacing: 0;
    }

    .site-footer-brand p,
    .site-footer-note {
        margin: 4px 0 0;
        color: rgba(255, 255, 255, 0.72);
        font-size: 13px;
        line-height: 1.7;
    }

    .site-footer-col h3 {
        margin: 0 0 14px;
        color: #E4C766;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .site-footer-links {
        display: grid;
        gap: 10px;
    }

    .site-footer-links a,
    .site-footer-contact a {
        color: rgba(255, 255, 255, 0.78);
        text-decoration: none;
        font-size: 14px;
        line-height: 1.5;
    }

    .site-footer-links a:hover,
    .site-footer-contact a:hover {
        color: #E4C766;
    }

    .site-footer-contact {
        display: grid;
        gap: 12px;
    }

    .site-footer-contact p {
        margin: 0;
        color: rgba(255, 255, 255, 0.78);
        font-size: 14px;
        line-height: 1.6;
    }

    .site-footer-contact i {
        width: 18px;
        margin-right: 8px;
        color: #C9A227;
    }

    .site-footer-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 42px;
        width: fit-content;
        margin-top: 16px;
        padding: 0 16px;
        border-radius: 10px;
        background: #C9A227;
        color: #0B2E24;
        text-decoration: none;
        font-size: 13px;
        font-weight: 800;
    }

    .site-footer-bottom {
        border-top: 1px solid rgba(230, 224, 208, 0.18);
        background: #09261E;
    }

    .site-footer-bottom-inner {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
        padding: 16px 0;
        display: flex;
        justify-content: space-between;
        gap: 16px;
        color: rgba(255, 255, 255, 0.62);
        font-size: 13px;
        line-height: 1.5;
    }

    .site-footer-bottom a {
        color: #E4C766;
        text-decoration: none;
        font-weight: 700;
    }

    @media (max-width: 940px) {
        .site-footer-inner {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 640px) {
        .site-footer-inner {
            grid-template-columns: 1fr;
            padding-top: 34px;
        }

        .site-footer-bottom-inner {
            flex-direction: column;
        }
    }
</style>

<footer class="site-footer-modern" id="contact">
    <div class="site-footer-inner">
        <section class="site-footer-col">
            <div class="site-footer-brand">
                <img src="<?php echo $pth; ?>assets/images/common-images/logo.png" alt="Bambalapitiya Jumma Mosque">
                <div>
                    <h2>Bambalapitiya Jumma Mosque</h2>
                    <p>Member subscriptions and payment information.</p>
                </div>
            </div>
            <p class="site-footer-note">Members can log in to view subscription payments, receipts, and account payment history.</p>
            <a class="site-footer-cta" href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">Subscription Login</a>
        </section>

        <section class="site-footer-col">
            <h3>Payments</h3>
            <div class="site-footer-links">
                <a href="<?php echo $pth; ?>Login<?php echo $online_exnction; ?>">Subscription Login</a>
                <a href="<?php echo $pth; ?>Create-Masjid-Membership<?php echo $online_exnction; ?>">Membership Registration</a>
                <a href="<?php echo $pth; ?>payment-policy<?php echo $online_exnction; ?>">Payment Policy</a>
            </div>
        </section>

        <section class="site-footer-col">
            <h3>Policies</h3>
            <div class="site-footer-links">
                <a href="<?php echo $pth; ?>terms-and-conditions<?php echo $online_exnction; ?>">Terms & Conditions</a>
                <a href="<?php echo $pth; ?>refund-policy<?php echo $online_exnction; ?>">Refund Policy</a>
                <a href="<?php echo $pth; ?>index<?php echo $online_exnction; ?>">Home</a>
            </div>
        </section>

        <section class="site-footer-col">
            <h3>Contact</h3>
            <div class="site-footer-contact">
                <p><i class="fa-solid fa-phone"></i><a href="tel:+947034457812">+94 70 344 578 12</a></p>
                <p><i class="fa-solid fa-envelope"></i><a href="mailto:Bambalapitiyajummamasjid@gmail.com">Bambalapitiyajummamasjid@gmail.com</a></p>
                <p><i class="fa-solid fa-location-dot"></i>Bambalapitiya Jumma Mosque, Colombo</p>
            </div>
        </section>
    </div>

    <div class="site-footer-bottom">
        <div class="site-footer-bottom-inner">
            <span>Copyright @ 2026 - BAMBALAPITIYA JUMMA MOSQUE</span>
            <span>Design & Maintain by <a href="https://www.neosolution.lk/" target="_blank" rel="noopener noreferrer">Neo Solution</a></span>
        </div>
    </div>
</footer>
