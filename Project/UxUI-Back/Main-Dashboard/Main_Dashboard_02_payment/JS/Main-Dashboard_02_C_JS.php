<script type="text/javascript">
// ============================================================================
// bmjm Admin — Member Selection & Traffic Routing Controller
// ============================================================================

// Global Pagination State
let paymentSubscription_totalCount = 0;
let paymentSubscription_currentPage = 1;

/**
 * Main Initialization for the Member View
 * Called when the component is mounted or when a user clicks 'Search'.
 */
function paymentSubscriptionRender(resetPage = true) {

    // SPA DYNAMIC TOGGLE: Securely hide/show the Skip button based on real-time DOM states natively!
    var paymentTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");
    var skipBtn = document.getElementById("global-skip-member-btn");
    
    if (skipBtn && paymentTypeEl) {
        if (paymentTypeEl.value === "Subscription" || paymentTypeEl.value === "subcription") {
            skipBtn.style.display = "none";
        } else {
            skipBtn.style.display = "inline-flex";
        }
    }

    if (resetPage) {
        paymentSubscription_currentPage = 1;
        fetchPaymentSubscriptionData(true); // Hits the database to calculate total pages natively.
    } else {
        fetchPaymentSubscriptionData(false); // Bypasses total page calculation and queries data only.
    }
}

/**
 * Controller: Data Fetching and Pagination Building
 * Hooks onto the PHP list controllers dynamically filtering users by queries.
 */
function fetchPaymentSubscriptionData(isFirstLoad = false) {
    var search_txt = document.getElementById("payment-subscription-search").value;
    var search_by = document.getElementById("payment-subscription-type").value;
    var per_page = parseInt(document.getElementById("payment-subscription-perpage").value, 10);
    
    // Step 1: If it's the first execution, find out EXACTLY how many matching users exist in the DB.
    if (isFirstLoad) {
        var sending_value = "count=0"; 
        sending_value += "&search_txt=" + encodeURIComponent(search_txt) + "&search_by=" + encodeURIComponent(search_by);
        
        $.ajax({
            url: "<?php echo $pth; ?>View-List/Member/view_member_list.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function(data) {
                try {
                    // Evaluates the physical JSON output dynamically.
                    var json = eval(data);
                    if (json.length > 0) {
                        paymentSubscription_totalCount = parseInt(json[0].count);
                    } else {
                        paymentSubscription_totalCount = 0;
                    }
                } catch(e) {
                    paymentSubscription_totalCount = 0;
                }
                
                // Immediately renders the number button matrix based on total calculation.
                renderPaymentSubscriptionPagination();
                // Chains to step 2: Rendering the physical rows for the current page block.
                loadPaymentSubscriptionPageData();
            }
        });
    } else {
        // Skips building the matrix if we're just shifting between existing pages seamlessly.
        loadPaymentSubscriptionPageData();
    }
}

/**
 * Controller: Render Pagination Control Buttons 
 * Uses a sliding window algorithm to ensure a maximum of 5 buttons are shown natively (Prev, Next, and surrounding).
 */
function renderPaymentSubscriptionPagination() {
    var container = document.getElementById("payment-subscription-pagination");
    if(!container) return;
    $(container).empty(); // Clear old buttons efficiently
    
    var per_page = parseInt(document.getElementById("payment-subscription-perpage").value, 10);
    
    // Auto-hide the entire block if they fit on a single screen perfectly natively.
    if(paymentSubscription_totalCount <= per_page) return; 
    
    var no_of_pages = Math.ceil(paymentSubscription_totalCount / per_page);
    
    // Helper function to build uniform buttons physically
    var createBtn = function(label, targetPage, isActive, isDisabled) {
        var btn = document.createElement("button");
        btn.setAttribute("class", "payment-subscription-skip"); 
        
        btn.style.height = "36px";
        btn.style.padding = "0 12px";
        btn.style.minWidth = "36px";
        
        if (isActive) {
            btn.style.background = "var(--payment-subscription-green-700)";
            btn.style.color = "var(--payment-subscription-white)";
            btn.style.border = "1px solid var(--payment-subscription-green-700)";
        } else {
            btn.style.background = "var(--payment-subscription-white)";
            btn.style.color = "var(--payment-subscription-ink-900)";
            btn.style.border = "1px solid var(--payment-subscription-border)";
        }
        
        btn.innerText = label;
        
        if (isDisabled) {
            btn.style.opacity = "0.5";
            btn.style.cursor = "not-allowed";
        } else {
            btn.onclick = function() {
                paymentSubscription_currentPage = targetPage;
                renderPaymentSubscriptionPagination(); 
                loadPaymentSubscriptionPageData();
            };
        }
        container.appendChild(btn);
    };

    // Calculate Sliding Window Boundaries (Max 5 buttons visually)
    var maxWindow = 5;
    var startPage = Math.max(1, paymentSubscription_currentPage - Math.floor(maxWindow / 2));
    var endPage = Math.min(no_of_pages, startPage + maxWindow - 1);

    // Adjust left barrier mathematically if window hits end caps
    if (endPage - startPage + 1 < maxWindow) {
        startPage = Math.max(1, endPage - maxWindow + 1);
    }

    // 1. Prev Button
    createBtn("Prev", paymentSubscription_currentPage - 1, false, (paymentSubscription_currentPage === 1));

    // 2. Loop Page Slider
    for (var i = startPage; i <= endPage; i++) {
        createBtn(i, i, (i === paymentSubscription_currentPage), false);
    }

    // 3. Next Button
    createBtn("Next", paymentSubscription_currentPage + 1, false, (paymentSubscription_currentPage === no_of_pages));
}

/**
 * Controller: Fetching User List Rows
 * Calls the unified `view_member_list.php` and passes back exact member profiles natively.
 */
function loadPaymentSubscriptionPageData() {
    var search_txt = document.getElementById("payment-subscription-search").value;
    var search_by = document.getElementById("payment-subscription-type").value;
    var per_page = parseInt(document.getElementById("payment-subscription-perpage").value, 10);
    
    var start_count = (paymentSubscription_currentPage - 1) * per_page;
    var sending_value = "st_count=" + start_count + "&per_page=" + per_page + "&page_data=0";
    sending_value += "&search_txt=" + encodeURIComponent(search_txt) + "&search_by=" + encodeURIComponent(search_by);
    
    $.ajax({
        url: "<?php echo $pth; ?>View-List/Member/view_member_list.php",
        type: 'POST',
        data: sending_value,
        cache: false,
        success: function(data) {
            var json = eval(data);
            var list = document.getElementById("payment-subscription-list");
            var empty = document.getElementById("payment-subscription-empty");
            
            if (json.length == 0) {
                // Failsafe: Erases grid heavily if no records are matched physically.
                list.innerHTML = "";
                empty.style.display = "block";
            } else {
                empty.style.display = "none";
                $(list).empty();
                
                // Iterates arrays stamping rows physically onto the grid.
                for (var i = 0; i < json.length; i++) {
                    list.appendChild(createPaymentSubscriptionRow(json[i]));
                }
            }
        }
    });
}

/**
 * Builder: DOM Row Instantiation
 * Creates the functional HTML for each member mapped exactly to their database properties.
 */
function createPaymentSubscriptionRow(json) {
    var div = document.createElement("div");
    div.className = "payment-subscription-row";
    
    var infoDiv = document.createElement("div");
    infoDiv.className = "payment-subscription-row-info";
    
    // --- Member Name Label ---
    var nameSpan = document.createElement("span");
    nameSpan.className = "payment-subscription-row-name";
    nameSpan.innerText = json.name_M;
    
    // --- Member ID / Road Label ---
    var idSpan = document.createElement("span");
    idSpan.className = "payment-subscription-row-road";
    idSpan.innerText = json.membership_no;
    
    infoDiv.appendChild(nameSpan);
    infoDiv.appendChild(idSpan);
    
    // --- Core Action Button ---
    var btn = document.createElement("button");
    btn.className = "payment-subscription-row-select";
    btn.innerText = "Select";
    
    // ========================================================================
    // LOGIC: What happens when the Cashier selects a specific member row?
    // ========================================================================
    btn.onclick = function() {
        
        /**
         * Helper Function: Securely dynamically creates hidden inputs to store state.
         * Ensures the backend APIs have instant read capabilities over specific targets seamlessly.
         */
        var setVal = function(id, val) {
            var el = document.getElementById(id);
            if (!el) {
                el = document.createElement("input");
                el.type = "hidden";
                el.id = id;
                document.body.appendChild(el);
            }
            el.value = val || '';
        };

        // 1. Physically memorize all aspects of the clicked member onto the global window invisibly
        setVal("DashBord_Payment_body_member_list_id", json.id);
        setVal("DashBord_Payment_body_member_list_phone_number", json.phone_mobile);
        setVal("DashBord_Payment_body_member_list_email", json.email);
        setVal("DashBord_Payment_body_member_list_address", json.residence_address_M);
        setVal("DashBord_Payment_body_member_list_name", json.name_M);
        setVal("DashBord_Payment_body_member_list_membership_no", json.membership_no);
        setVal("DashBord_Payment_body_member_list_amount", json.due_to_pay); // Binds the core balance due!

        // 2. Visually update the Cash Payment Form UI labels dynamically based on state
        var cashMemberNo = document.getElementById("cash-payment-member-no");
        if (cashMemberNo) cashMemberNo.innerText = json.membership_no || '';
        
        var cashMemberName = document.getElementById("cash-payment-member-name");
        if (cashMemberName) cashMemberName.innerText = json.name_M || '';
        
        var cashDueAmount = document.getElementById("cash-payment-due-amount");
        if (cashDueAmount) cashDueAmount.innerText = json.due_to_pay || '';

        // 3. Complex Routing Check (Is there a Project waiting?)
        var selectedProjectId = document.getElementById("payment_selected_project_id") ? document.getElementById("payment_selected_project_id").value : null;

        if (selectedProjectId) {
            // A project was previously selected! Probe it dynamically to determine execution flows correctly.
            $.ajax({
                url: "<?php echo $pth; ?>View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_JSON.php",
                type: "POST",
                dataType: "json",
                data: { id: selectedProjectId },
                success: function(resp) {
                    if (resp && resp.error === 0) {
                         // --- 1. TEMPORAL VALIDATION ---
                         if (resp.is_end_date == "1" && resp.fix_end_date) {
                             var today = new Date(); 
                             today.setHours(0,0,0,0);
                             var endDate = new Date(resp.fix_end_date); 
                             endDate.setHours(0,0,0,0);
                             if (today > endDate) {
                                 window.bmjmShowPopup({ type: 'warning', title: 'Collection Expired', message: 'This project collection expired on ' + resp.fix_end_date + '. Further payments cannot be processed.' });
                                 return;
                             }
                         }
                         
                         // --- 2. FIXED BUDGET VALIDATION ---
                         var setVal = function(id, val) {
                             var el = document.getElementById(id);
                             if (!el) { el = document.createElement("input"); el.type = "hidden"; el.id = id; document.body.appendChild(el); }
                             el.value = val || '';
                         };
                         
                         if (resp.is_fix_budget == "1") {
                             var fixedAmount = parseFloat(resp.fix_amount) || 0;
                             var collected = parseFloat(resp.collected_amount) || 0;
                             if (collected >= fixedAmount) {
                                 window.bmjmShowPopup({ type: 'info', title: 'Budget Target Reached', message: 'This project has reached its maximum budget target (LKR ' + fixedAmount.toLocaleString() + '). No further donations are required. Thank you!' });
                                 return;
                             }
                             var delta = fixedAmount - collected;
                             setVal("Project_Override_Show_Due", "1");
                             setVal("DashBord_Payment_body_due_to_pay", delta.toFixed(2));
                         } else {
                             setVal("Project_Override_Show_Due", "0");
                         }
                         
                         // --- 3. ROUTE EXECUTION ---
                         if (resp.have_tickets == 1) {
                              if (typeof main_dashboard_02_C3_OPEN === "function") {
                                  main_dashboard_02_C3_OPEN(); // Route to Tickets
                              }
                         } else {
                              if (typeof main_dashboard_02_D_OPEN === "function") {
                                  main_dashboard_02_D_OPEN(); // Route to Normal Gateways
                              }
                         }
                    } else {
                         // Branch B: Generic failsafe fallback
                         if (typeof main_dashboard_02_D_OPEN === "function") main_dashboard_02_D_OPEN();
                    }
                },
                error: function() {
                     if (typeof main_dashboard_02_D_OPEN === "function") main_dashboard_02_D_OPEN();
                }
            });
        } else {
            // Branch C: Standard paths like pure Subscriptions that don't involve Projects entirely.
            if (typeof main_dashboard_02_D_OPEN === "function") {
                main_dashboard_02_D_OPEN(); // Route strictly up the cart flow natively safely.
            }
        }
    };
    
    div.appendChild(infoDiv);
    div.appendChild(btn);
    return div;
}

/**
 * Custom State Execution: Anonymous Guest Selection Bypass
 * Cleanly overrides the hidden memory stores replacing them with empty flags forcefully so the checkout system natively instantiates the Anonymous UI modes!
 */
function skipMemberSelection() {
    // SECURITY PATCH: Forcefully Block Anonymous Subscriptions!
    var paymentTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");
    if (paymentTypeEl && (paymentTypeEl.value === "Subscription" || paymentTypeEl.value === "subcription")) {
        window.bmjmShowPopup({ type: 'warning', title: 'Member Profile Required', message: 'Subscriptions strictly compel an active Member Profile! You cannot checkout anonymously for Subscriptions.' });
        return;
    }

    var setVal = function(id, val) {
        var el = document.getElementById(id);
        if (!el) {
            el = document.createElement("input");
            el.type = "hidden";
            el.id = id;
            document.body.appendChild(el);
        }
        el.value = val || '';
    };

    // Cleanly wipe the required state safely ensuring subsequent UI flows trigger empty!
    setVal("DashBord_Payment_body_member_list_id", 0);
    setVal("DashBord_Payment_body_member_list_phone_number", "");
    setVal("DashBord_Payment_body_member_list_email", "");
    setVal("DashBord_Payment_body_member_list_address", "");
    setVal("DashBord_Payment_body_member_list_name", "");
    setVal("DashBord_Payment_body_member_list_membership_no", "");
    setVal("DashBord_Payment_body_member_list_amount", "0.00");

    // Visually update the generic fallback texts just in case dynamically binding defaults
    var cashMemberNo = document.getElementById("cash-payment-member-no");
    if (cashMemberNo) cashMemberNo.innerText = 'Guest Account';
    
    var cashMemberName = document.getElementById("cash-payment-member-name");
    if (cashMemberName) cashMemberName.innerText = 'Anonymous';

    // Route cleanly exactly matching the standard Member Click handler!
    var selectedProjectId = document.getElementById("payment_selected_project_id") ? document.getElementById("payment_selected_project_id").value : null;

    if (selectedProjectId) {
        $.ajax({
            url: "../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_JSON.php",
            type: "POST",
            dataType: "json",
            data: { id: selectedProjectId },
            success: function(resp) {
                if (resp && resp.error === 0) {
                     // --- 1. TEMPORAL VALIDATION ---
                     if (resp.is_end_date == "1" && resp.fix_end_date) {
                         var today = new Date(); 
                         today.setHours(0,0,0,0);
                         var endDate = new Date(resp.fix_end_date); 
                         endDate.setHours(0,0,0,0);
                         if (today > endDate) {
                             window.bmjmShowPopup({ type: 'warning', title: 'Collection Expired', message: 'This project collection expired on ' + resp.fix_end_date + '. Further payments cannot be processed.' });
                             return;
                         }
                     }
                     
                     // --- 2. FIXED BUDGET VALIDATION ---
                     var setVal = function(id, val) {
                         var el = document.getElementById(id);
                         if (!el) { el = document.createElement("input"); el.type = "hidden"; el.id = id; document.body.appendChild(el); }
                         el.value = val || '';
                     };
                     
                     if (resp.is_fix_budget == "1") {
                         var fixedAmount = parseFloat(resp.fix_amount) || 0;
                         var collected = parseFloat(resp.collected_amount) || 0;
                         if (collected >= fixedAmount) {
                             window.bmjmShowPopup({ type: 'info', title: 'Budget Target Reached', message: 'This project has reached its maximum budget target (LKR ' + fixedAmount.toLocaleString() + '). No further donations are required. Thank you!' });
                             return;
                         }
                         var delta = fixedAmount - collected;
                         setVal("Project_Override_Show_Due", "1");
                         setVal("DashBord_Payment_body_due_to_pay", delta.toFixed(2));
                     } else {
                         setVal("Project_Override_Show_Due", "0");
                     }
                     
                     // --- 3. ROUTE EXECUTION ---
                     if (resp.have_tickets == 1) {
                          if (typeof main_dashboard_02_C3_OPEN === "function") {
                              main_dashboard_02_C3_OPEN();
                          }
                     } else {
                          if (typeof main_dashboard_02_D_OPEN === "function") {
                              main_dashboard_02_D_OPEN();
                          }
                     }
                } else {
                     if (typeof main_dashboard_02_D_OPEN === "function") main_dashboard_02_D_OPEN();
                }
            },
            error: function() {
                 if (typeof main_dashboard_02_D_OPEN === "function") main_dashboard_02_D_OPEN();
            }
        });
    } else {
        if (typeof main_dashboard_02_D_OPEN === "function") {
            main_dashboard_02_D_OPEN();
        }
    }
}

/**
 * Application Lifecycle Event
 * Probes the document waiting for parse completion so execution handles safely continuously.
 */
document.addEventListener("DOMContentLoaded", function() {
    // 100ms buffering offsets jQuery initializations heavily assuring stability accurately preventing faults.
    setTimeout(function() {
        paymentSubscriptionRender();
    }, 100);
});
</script>