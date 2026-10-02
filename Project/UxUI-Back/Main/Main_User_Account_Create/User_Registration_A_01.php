<?php
if (!isset($company_obj) || !is_object($company_obj)) {
    include_once __DIR__ . '/../../../imports/Company_Info/Company_Info_Variable_List.php';
    $company_obj = new Company_Info_Variable_List();
}
$needed_contact_person_count = method_exists($company_obj, 'get_needed_contact_person_count')
    ? (int) $company_obj->get_needed_contact_person_count() : 0;
$needed_contact_person_count = max(0, $needed_contact_person_count);
$company_name = htmlspecialchars($company_obj->get_compnay_name(), ENT_QUOTES, 'UTF-8');
?>

<div class="signup-shell" id="signup-shell" data-step="road">
    <header class="signup-top">
        <a class="signup-top-brand" href="<?php echo $home_page ?>Login.php">
            <span class="signup-brand-badge" aria-hidden="true">
                <img src="<?php echo $home_page ?>assets/images/logo_dashboard.png" alt="" onerror="this.parentNode.classList.add('is-fallback')">
            </span>
            <span>
                <strong>Bmjm</strong>
                <small>Member Signup</small>
            </span>
        </a>
        <a class="signup-top-link" href="<?php echo $home_page ?>Login.php">Sign in</a>
    </header>

    <nav class="signup-steps" aria-label="Signup progress">
        <div class="signup-step is-active" data-step-item="road">
            <span>1</span>
            Select road
        </div>
        <div class="signup-steps-line"></div>
        <div class="signup-step" data-step-item="form">
            <span>2</span>
            Your details
        </div>
        <div class="signup-steps-line"></div>
        <div class="signup-step" data-step-item="success">
            <span>3</span>
            Pending
        </div>
    </nav>

    <section class="signup-card" id="signup-step-road" aria-label="Select a road">
        <div class="signup-card-head">
            <div>
                <h1>Select your road</h1>
                <p>Choose the street where you live to continue registration.</p>
            </div>
        </div>

        <div class="signup-card-body">
            <div class="signup-search-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-3.5-3.5"/>
                </svg>
                <input type="text" id="signup-road-search" placeholder="Search streets..." autocomplete="off">
            </div>

            <div class="signup-road-list" id="signup-road-list"></div>
            <div class="signup-empty" id="signup-road-empty" style="display:none;">
                No streets match that search.
            </div>
        </div>
    </section>

    <section class="signup-card" id="signup-step-form" aria-label="Member information" style="display:none;">
        <div class="signup-card-head">
            <div>
                <h1>Member details</h1>
                <p>Fill in your information. Admin will approve before you can sign in.</p>
            </div>
        </div>

        <form class="signup-form" id="signup-member-form" onsubmit="return signupMemberSubmit(event)" novalidate>
            <input type="hidden" id="signup-road-id" name="val_20" value="">
            <div class="signup-selected-bar">
                <div class="signup-road-chip" id="signup-selected-road-label"></div>
                <button type="button" class="signup-change-road" id="signup-form-close">Change</button>
            </div>

            <div class="signup-grid">
                <div class="signup-field signup-span-2" id="signup-field-name">
                    <label for="signup-name">Full name<span class="signup-required">*</span></label>
                    <input type="text" id="signup-name" name="name" placeholder="Mohamed Aadhil" required>
                    <span class="signup-error">Please enter your full name.</span>
                </div>

                <div class="signup-field signup-span-2" id="signup-field-address">
                    <label for="signup-address">Residence address<span class="signup-required">*</span></label>
                    <input type="text" id="signup-address" name="address" placeholder="No. 45/3, Hampden Lane, Colombo 06" required>
                    <span class="signup-error">Please enter the residence address.</span>
                </div>

                <div class="signup-field signup-span-2">
                    <label>Residing status<span class="signup-required">*</span></label>
                    <div class="signup-choice-row">
                        <label class="signup-choice">
                            <input type="checkbox" id="signup-own-house" name="residingStatus" value="own">
                            <span>Own house</span>
                        </label>
                        <label class="signup-choice">
                            <input type="checkbox" id="signup-rented-house" name="residingStatus" value="rented">
                            <span>Rented house</span>
                        </label>
                    </div>
                    <span class="signup-error" id="signup-residing-error" style="display:none;">Please select Own house or Rented house.</span>
                </div>

                <div class="signup-field signup-span-2" id="signup-field-nic">
                    <label for="signup-nic">NIC number<span class="signup-required">*</span></label>
                    <input type="text" id="signup-nic" name="nic" placeholder="199012345678 or 123456789V" required>
                    <span class="signup-error">Enter a valid NIC (9 digits + V/X or 12 digits).</span>
                </div>

                <div class="signup-block">
                    <h2>Contact details</h2>

                    <div class="signup-field signup-span-2">
                        <label for="signup-email">Email</label>
                        <input type="email" id="signup-email" name="email" placeholder="name@example.com">
                    </div>

                    <div class="signup-field signup-span-2" id="signup-field-mobile">
                        <label for="signup-mobile">Mobile number<span class="signup-required">*</span></label>
                        <input type="tel" id="signup-mobile" name="mobile" placeholder="07x xxx xxxx" required>
                        <label class="signup-inline-check">
                            <input type="checkbox" id="signup-whatsapp-same" name="whatsapp_same" checked>
                            WhatsApp on this number
                        </label>
                        <span class="signup-error">Enter a 10-digit mobile starting with 07.</span>
                    </div>

                    <div class="signup-field signup-span-2" id="signup-field-whatsapp">
                        <label for="signup-whatsapp">WhatsApp number<span class="signup-required">*</span></label>
                        <input type="tel" id="signup-whatsapp" name="whatsappNumber" placeholder="07x xxx xxxx">
                        <span class="signup-error">Please enter a WhatsApp number.</span>
                    </div>

                    <div class="signup-field signup-span-2" id="signup-field-secondary">
                        <label for="signup-secondary">Secondary number<span class="signup-required">*</span></label>
                        <input type="tel" id="signup-secondary" name="secondaryNumber" placeholder="011 2xx xxxx" required>
                        <span class="signup-error">Enter a 10-digit number starting with 0.</span>
                    </div>
                </div>

                <div class="signup-field">
                    <label for="signup-profession">Profession</label>
                    <input type="text" id="signup-profession" name="profession" placeholder="Teacher, Engineer...">
                </div>

                <div class="signup-field" id="signup-field-subscription">
                    <label for="signup-subscription">Monthly subscription<span class="signup-required">*</span></label>
                    <input type="number" id="signup-subscription" name="subscriptionAmount" min="500" step="0.01" placeholder="Minimum 500 LKR">
                    <span class="signup-error">Must be at least 500 LKR.</span>
                </div>

                <?php for ($cp_idx = 1; $cp_idx <= $needed_contact_person_count; $cp_idx++): ?>
                <div class="signup-block signup-contact-person" data-index="<?php echo $cp_idx; ?>">
                    <h2>Recommended person <?php echo str_pad((string) $cp_idx, 2, '0', STR_PAD_LEFT); ?></h2>

                    <div class="signup-field signup-span-2">
                        <label for="signup-ref<?php echo $cp_idx; ?>-name">Name</label>
                        <input type="text" id="signup-ref<?php echo $cp_idx; ?>-name" class="signup-contact-name" placeholder="Member name">
                    </div>

                    <div class="signup-field" id="signup-field-ref<?php echo $cp_idx; ?>-membership">
                        <label for="signup-ref<?php echo $cp_idx; ?>-membership">Membership no<span class="signup-required">*</span></label>
                        <input type="text" id="signup-ref<?php echo $cp_idx; ?>-membership" class="signup-contact-membership" placeholder="00<?php echo $cp_idx; ?>xxxx" required>
                        <span class="signup-error">Required.</span>
                    </div>

                    <div class="signup-field" id="signup-field-ref<?php echo $cp_idx; ?>-contact">
                        <label for="signup-ref<?php echo $cp_idx; ?>-contact">Contact no<span class="signup-required">*</span></label>
                        <input type="tel" id="signup-ref<?php echo $cp_idx; ?>-contact" class="signup-contact-contact" placeholder="07x xxx xxxx" required>
                        <span class="signup-error">Required.</span>
                    </div>
                </div>
                <?php endfor; ?>

                <div class="signup-flags">
                    <label class="signup-flag">
                        <input type="checkbox" id="signup-subscription-flag" name="subscription" checked>
                        Subscription
                    </label>
                    <label class="signup-flag">
                        <input type="checkbox" id="signup-zakath-payee" name="zakathPayee">
                        Zakath payee
                    </label>
                    <label class="signup-flag">
                        <input type="checkbox" id="signup-zakath-receive" name="zakathReceive">
                        Zakath receive
                    </label>
                </div>
            </div>

            <div class="signup-form-error" id="signup-form-error" style="display:none;"></div>

            <div class="signup-actions">
                <button type="button" class="signup-btn signup-btn-ghost" id="signup-cancel-btn">Back</button>
                <button type="submit" class="signup-btn signup-btn-primary" id="signup-submit-btn">Sign up</button>
            </div>
        </form>
    </section>

    <section class="signup-card signup-card--success" id="signup-step-success" aria-label="Pending approval" style="display:none;">
        <div class="signup-success">
            <div class="signup-success-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12.5 10 17 19 7.5"/></svg>
            </div>
            <h1>Registration received</h1>
            <p>Your account is pending admin approval. After approval, login details will be sent to your mobile or email.</p>
            <a class="signup-btn signup-btn-primary" href="<?php echo $home_page ?>Login.php">Go to sign in</a>
        </div>
    </section>

    <p class="signup-foot">
        &copy; <?php echo date("Y"); ?> <?php echo $company_name; ?> ·
        <a href="https://www.neosolution.lk/" target="_blank" rel="noopener">Neo Solution</a>
    </p>
</div>
