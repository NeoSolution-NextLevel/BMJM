<!-- components/footer.php -->
<?php if (!isset($footer_included)): ?>
<?php $footer_included = true; ?>

<style>
    /* =========================================================
       PAGE FOOTER
       ========================================================= */
    .erp-footer {
        height: 32px;
        background: var(--erp-primary-dark);
        color: #fff;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px;
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 102;
    }

    .erp-footer__content {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    @media (max-width: 768px) {
        .erp-footer {
            font-size: 11px;
            padding: 0 12px;
        }
    }

    @media print {
        .erp-footer {
            display: none !important;
        }
    }
</style>

<!-- ================= PAGE FOOTER ================= -->
<footer class="erp-footer">
    <div class="erp-footer__content">
        © <span id="currentYear"><?php echo date('Y'); ?></span> - T All rights reserved.
    </div>
</footer>

<script>
    // Footer-specific JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year if not already set by PHP
        const currentYearSpan = document.getElementById('currentYear');
        if (currentYearSpan && !currentYearSpan.textContent.trim()) {
            currentYearSpan.textContent = new Date().getFullYear();
        }
    });
</script>
<?php endif; ?>