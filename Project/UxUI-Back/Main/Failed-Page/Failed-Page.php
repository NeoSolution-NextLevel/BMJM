<?php
if (!isset($company_obj) || !is_object($company_obj)) {
    include_once __DIR__ . '/../../../imports/Company_Info/Company_Info_Variable_List.php';
    $company_obj = new Company_Info_Variable_List();
}
?>

<div class="erp-container erp-container--login">
    <div class="erp-error-card">
        <div class="erp-error-card__header">
            <img class="erp-error-card__photo" src="../../assets/images/mosque-photo.jpg" alt="" aria-hidden="true" onerror="this.style.display='none'">
            <img class="erp-error-card__logo" src="../../assets/images/logo_dashboard.png" alt="bmjm logo" onerror="this.style.display='none'">

            <div class="erp-error-card__brand-copy">
                <h1 class="erp-error-card__title" id="error-title">Request Failed</h1>
                <p class="erp-error-card__subtitle" id="error-subtitle">We could not complete this action.</p>
            </div>
        </div>

        <div class="erp-error-card__body">
            <div class="erp-error-container" aria-hidden="true">
                <div class="erp-error-circle"></div>
                <div class="erp-error-circle"></div>
                <div class="erp-error-circle"></div>
                <div class="erp-error-icon">
                    <i class="fas fa-xmark"></i>
                </div>
                <div class="erp-broken-piece" id="piece-1"></div>
                <div class="erp-broken-piece" id="piece-2"></div>
                <div class="erp-broken-piece" id="piece-3"></div>
            </div>

            <div class="erp-text-center">
                <p class="erp-error-message" id="error-message"></p>

                <div class="erp-error-details" id="error-details">
                    <div class="erp-error-details__title">
                        <i class="fas fa-circle-info"></i>
                        <span>Error Details</span>
                    </div>
                    <div class="erp-error-details__content" id="error-details-content"></div>
                </div>

                <p class="erp-text-tertiary erp-text-sm erp-mt-md" id="error-code">
                    Error Code: <span id="error-code-value">ERR-500</span>
                </p>
            </div>

            <div class="erp-btn-group">
                <button type="button" class="erp-btn erp-btn--primary erp-btn--block" id="retry-btn">
                    <i class="fas fa-rotate-right"></i>
                    <span id="retry-text">Try Again</span>
                </button>

                <button type="button" class="erp-btn erp-btn--secondary erp-btn--block" id="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    <span id="back-text">Go Back</span>
                </button>
            </div>

            <div class="erp-error-card__footer" id="footer-particles">
                <p class="erp-footer__copyright" id="copyright">
                    &copy; <span id="current-year"><?php echo date('Y'); ?></span> <?php echo htmlspecialchars($company_obj->get_compnay_name(), ENT_QUOTES, 'UTF-8'); ?> | Powered by Neo Solution
                </p>
                <p class="erp-footer__version"></p>
            </div>
        </div>
    </div>
</div>
