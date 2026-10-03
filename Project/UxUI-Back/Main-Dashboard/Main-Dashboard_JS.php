<script type="text/javascript">
    function setSidebarActive(pageName) {
        document.querySelectorAll('.wwjm-sidebar-nav-item').forEach(function(item){
            item.classList.toggle('wwjm-sidebar-active', item.getAttribute('data-page') === pageName);
        });
    }

    var mainDashboardPanelIds = [
        "Main_dashboard_00",
        "Main_dashboard_01_A",
        "Main_dashboard_01_B",
        "Main_dashboard_01_E",
        "Main_dashboard_01_F",
        "Main_dashboard_01_G",
        "Main_dashboard_02_A",
        "Main_dashboard_02_B",
        "Main_dashboard_02_C2",
        "Main_dashboard_02_C",
        "Main_dashboard_02_C3",
        "Main_dashboard_02_D",
        "Main_dashboard_02_E",
        "Main_dashboard_02_F",
        "Main_dashboard_02_G",
        "Main_dashboard_02_H",
        "Main_dashboard_02_I",
        "Main_Dashboard_03_A",
        "Main_Dashboard_03_B",
        "Main_Dashboard_03_C",
        "Main_Dashboard_03_D",
        "Main_Dashboard_04_A",
        "Main_Dashboard_04_B",
        "Main_Dashboard_04_C",
        "Main_Dashboard_04_D",
        "Main_Dashboard_04_E",
        "Main_Dashboard_05_01",
        "Main_Dashboard_05_03_A",
        "Main_Dashboard_05_03_B",
        "Main_Dashboard_05_04_A",
        "Main_Dashboard_05_04_B",
        "Main_Dashboard_06_A",
        "Main_Dashboard_07_A"
    ];

    function main_dashboard_storage_key() {
        return 'wwjm_main_current_page:' + window.location.pathname;
    }

    function main_dashboard_remember_page(pageId, recordId) {
        try {
            window.sessionStorage.setItem(main_dashboard_storage_key(), JSON.stringify({ pageId: pageId, recordId: recordId === undefined ? null : recordId }));
        } catch (error) {}
    }

    function main_dashboard_restore_page() {
        var state = null;
        try { state = JSON.parse(window.sessionStorage.getItem(main_dashboard_storage_key()) || 'null'); } catch (error) {}
        if (!state || !state.pageId || !document.getElementById(state.pageId)) {
            main_dashboard_00_OPEN();
            return;
        }

        var pages = {
            'Main_dashboard_00': main_dashboard_00_OPEN,
            'Main_dashboard_01_A': main_dashboard_01_A_OPEN,
            'Main_dashboard_01_B': main_dashboard_01_B_OPEN,
            'Main_dashboard_01_E': main_dashboard_01_E_OPEN,
            'Main_dashboard_01_F': main_dashboard_01_F_OPEN,
            'Main_dashboard_01_G': main_dashboard_01_G_OPEN,
            'Main_dashboard_02_A': function() { main_dashboard_02_A_OPEN(state.recordId || 1); },
            'Main_dashboard_02_B': main_dashboard_02_B_OPEN,
            'Main_dashboard_02_C2': main_dashboard_02_C2_OPEN,
            'Main_dashboard_02_C': main_dashboard_02_C_OPEN,
            'Main_dashboard_02_C3': main_dashboard_02_C3_OPEN,
            'Main_dashboard_02_D': main_dashboard_02_D_OPEN,
            'Main_dashboard_02_E': main_dashboard_02_E_OPEN,
            'Main_dashboard_02_F': main_dashboard_02_F_OPEN,
            'Main_dashboard_02_G': main_dashboard_02_G_OPEN,
            'Main_dashboard_02_H': main_dashboard_02_H_OPEN,
            'Main_dashboard_02_I': main_dashboard_02_I_OPEN,
            'Main_Dashboard_03_A': Main_Dashboard_03_A_OPEN,
            'Main_Dashboard_03_B': Main_Dashboard_03_B_OPEN,
            'Main_Dashboard_03_C': Main_Dashboard_03_C_OPEN,
            'Main_Dashboard_03_D': function() { Main_Dashboard_03_D_OPEN(state.recordId); },
            'Main_Dashboard_04_A': Main_Dashboard_04_A_OPEN,
            'Main_Dashboard_04_B': function() { Main_Dashboard_04_B_OPEN(state.recordId || 0); },
            'Main_Dashboard_04_C': Main_Dashboard_04_C_OPEN,
            'Main_Dashboard_04_D': function() { Main_Dashboard_04_D_OPEN(state.recordId || 0); },
            'Main_Dashboard_04_E': function() { Main_Dashboard_04_E_OPEN('expense', state.recordId || 0); },
            'Main_Dashboard_05_01': main_dashboard_05_01_OPEN,
            'Main_Dashboard_05_03_A': main_dashboard_05_03_A_OPEN,
            'Main_Dashboard_05_03_B': main_dashboard_05_03_B_OPEN,
            'Main_Dashboard_05_04_A': main_dashboard_05_04_A_OPEN,
            'Main_Dashboard_05_04_B': function() { main_dashboard_05_04_B_OPEN(state.recordId || 0); },
            'Main_Dashboard_06_A': Main_Dashboard_06_A_OPEN,
            'Main_Dashboard_07_A': Main_Dashboard_07_A_OPEN
        };
        (pages[state.pageId] || main_dashboard_00_OPEN)();
    }

    function mainDashboardSetDisplay(id, displayValue) {
        var panel = document.getElementById(id);
        if (panel) {
            panel.style.display = displayValue;
            if (displayValue === "") {
                main_dashboard_remember_page(id);
            }
        }
        return panel;
    }

    function mainDashboardSetHeader(panelId, title, subtitle) {
        var panel = document.getElementById(panelId);
        if (!panel) return;

        var heading = panel.querySelector('[class*="topbar-heading"]');
        if (!heading) return;

        var titleEl = heading.querySelector('h1');
        var subtitleEl = heading.querySelector('p');

        if (titleEl) titleEl.textContent = title;
        if (subtitleEl) subtitleEl.textContent = subtitle || 'Dashboard Control System';

        document.title = title + ' · BMJM Admin';
    }

    function main_dashboard_close_all() {
        mainDashboardPanelIds.forEach(function(id) {
            mainDashboardSetDisplay(id, "none");
        });
    }

    function main_dashboard_00_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_00", "");
        mainDashboardSetHeader("Main_dashboard_00", "Dashboard Overview", "Financial & Member Intelligence System");
        setSidebarActive('dashboard');
        if (typeof main_refresh_dashboard_data === "function") main_refresh_dashboard_data();
    }

    function main_dashboard_01_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_01_A", "");
        mainDashboardSetHeader("Main_dashboard_01_A", "Member List", "Member Directory");
        setSidebarActive('member-list');
        fetchMemberDashboardData();
    }

    function main_dashboard_01_B_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_01_B", "");
        mainDashboardSetHeader("Main_dashboard_01_B", "Create Member", "Registration Options");
        setSidebarActive('accounts');
    }

    function main_dashboard_01_E_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_01_E", "");
        mainDashboardSetHeader("Main_dashboard_01_E", "Add Road", "Locality Settings");
        setSidebarActive('member-list');
    }

    function main_dashboard_01_F_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_01_F", "");
        mainDashboardSetHeader("Main_dashboard_01_F", "Member Street List", "Locality Settings");
        setSidebarActive('member-list');
    } 

    function main_dashboard_01_G_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_01_G", "");
        mainDashboardSetHeader("Main_dashboard_01_G", "Process New Member", "Manual Entry");
        setSidebarActive('member-list');
    }

    function main_dashboard_02_A_OPEN(page = 1) {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_A", "");
        main_dashboard_remember_page("Main_dashboard_02_A", page);
        mainDashboardSetHeader("Main_dashboard_02_A", "Payment", "Payment Control System");
        setSidebarActive('payment');
        paymentRender(page);
    }

    function main_dashboard_02_B_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_B", "");
        mainDashboardSetHeader("Main_dashboard_02_B", "Create Payment", "Select Payment Category");
        setSidebarActive('payment');
    }

    function main_dashboard_02_C2_OPEN() {
        main_dashboard_close_all();
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_C2", "");
        mainDashboardSetHeader("Main_dashboard_02_C2", "Project Payments", "Select Project Collection");
        setSidebarActive('payment');
    }

    function main_dashboard_02_C_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_C", "");
        mainDashboardSetHeader("Main_dashboard_02_C", "Member Payment", "Select Member");
        setSidebarActive('payment');
        if (typeof paymentSubscriptionRender === 'function') {
            paymentSubscriptionRender(true);
        }
    }

    function main_dashboard_02_C3_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_C3", "");
        mainDashboardSetHeader("Main_dashboard_02_C3", "Ticket Payment", "Select Ticket Tier");
        setSidebarActive('payment');
        if (typeof init_c3_tickets_render === 'function') {
            init_c3_tickets_render();
        }
    }   

    function main_dashboard_02_D_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_D", "");
        mainDashboardSetHeader("Main_dashboard_02_D", "Choose Payment Type", "Cash, Bank Deposit, or Card");
        setSidebarActive('payment');

        // Dynamically obliterate the IPG Card option visually if it's Zakath
        var paymentTypeEl = document.getElementById("DashBord_Payment_body_paying_type_default");
        var ipgBtn = document.getElementById("payment-type-option-ipg");
        if (ipgBtn && paymentTypeEl) {
            if (paymentTypeEl.value === "Zakath" || paymentTypeEl.value === "zakath") {
                ipgBtn.style.display = "none";
            } else {
                ipgBtn.style.display = "flex";
            }
        }
    }

    function main_dashboard_02_E_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_E", "");
        mainDashboardSetHeader("Main_dashboard_02_E", "Cash Payment", "Payment Processing");
        setSidebarActive('payment');
    }

    function main_dashboard_02_F_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_F", "");
        mainDashboardSetHeader("Main_dashboard_02_F", "Select Bank", "Bank Deposit Account");
        setSidebarActive('payment');
    }

    function main_dashboard_02_G_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_G", "");
        mainDashboardSetHeader("Main_dashboard_02_G", "Submit Bank Deposit", "Upload Payment Details");
        setSidebarActive('payment');

        // Dynamically reveal the Guest Form manually if the Cashier bypassed the Member Registry globally
        var guestSection = document.getElementById("bank-deposit-guest-section");
        var memberListIdEl = document.getElementById("DashBord_Payment_body_member_list_id");
        var memberId = memberListIdEl ? memberListIdEl.value : null;

        if (guestSection) {
            if (!memberId || memberId == "0") {
                guestSection.style.display = "block";
            } else {
                guestSection.style.display = "none";
            }
        }
    }

    function main_dashboard_02_H_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_H", "");
        mainDashboardSetHeader("Main_dashboard_02_H", "Payment Slip View", "Payment Receipt");
        setSidebarActive('payment');
    }

    function main_dashboard_02_I_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_dashboard_02_I", "");
        mainDashboardSetHeader("Main_dashboard_02_I", "Send IPG Link", "Card Payment Link");
        setSidebarActive('payment');
    }
    
    function Main_Dashboard_03_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_03_A", "");
        mainDashboardSetHeader("Main_Dashboard_03_A", "Projects", "Project Collection Management");
        setSidebarActive('project');
    }

    function Main_Dashboard_03_B_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_03_B", "");
        mainDashboardSetHeader("Main_Dashboard_03_B", "Collection List", "Project Collections");
        setSidebarActive('project');
        fetchCollectionData();
    }

    function Main_Dashboard_03_C_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_03_C", "");
        mainDashboardSetHeader("Main_Dashboard_03_C", "New Collection", "Create Project Collection");
        setSidebarActive('project');
    }

    function Main_Dashboard_03_D_OPEN(collection_id = null) {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_03_D", "");
        main_dashboard_remember_page("Main_Dashboard_03_D", collection_id);
        mainDashboardSetHeader("Main_Dashboard_03_D", "Manage Collection", "Collection Details");
        setSidebarActive('project');
        if (typeof window.load_manage_collection === 'function' && collection_id !== null) {
            window.load_manage_collection(collection_id);
        }
    }

    function Main_Dashboard_04_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_04_A", "");
        mainDashboardSetHeader("Main_Dashboard_04_A", "Income & Expense", "Income Overview");
        setSidebarActive('accounts');
    }

    function Main_Dashboard_04_B_OPEN(type_id = 0) {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_04_B", "");
        main_dashboard_remember_page("Main_Dashboard_04_B", type_id);
        mainDashboardSetHeader("Main_Dashboard_04_B", "Income Details", "Inside Group Income Display");
        setSidebarActive('accounts');
        if (typeof window.load_transactions_for_category === 'function' && type_id !== 0) {
            window.load_transactions_for_category(type_id);
        }
    }

    function Main_Dashboard_04_C_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_04_C", "");
        mainDashboardSetHeader("Main_Dashboard_04_C", "Income & Expense", "Expense Overview");
        setSidebarActive('accounts');
        if (typeof window.Main_Dashboard_04_C_RELOAD === 'function') {
            window.Main_Dashboard_04_C_RELOAD();
        }
    }

    function Main_Dashboard_04_D_OPEN(type_id = 0) {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_04_D", "");
        main_dashboard_remember_page("Main_Dashboard_04_D", type_id);
        mainDashboardSetHeader("Main_Dashboard_04_D", "Expense Details", "Inside Group Expense Display");
        setSidebarActive('accounts');
        if (typeof window.load_expense_transactions_for_category === 'function' && type_id !== 0) {
            window.load_expense_transactions_for_category(type_id);
        }
    }

    function Main_Dashboard_04_E_OPEN(arg1 = 0, arg2 = 0) {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_04_E", "");
        var catId = (typeof arg1 === 'number') ? arg1 : (parseInt(arg2, 10) || parseInt(arg1, 10) || 0);
        main_dashboard_remember_page("Main_Dashboard_04_E", catId);
        mainDashboardSetHeader("Main_Dashboard_04_E", "Add Expense", "Record Expense / Bill / Salary Payment");
        setSidebarActive('accounts');
        if (typeof window.prepareAddTransaction === 'function') {
            window.prepareAddTransaction(catId);
        }
    }

    function main_dashboard_05_01_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_05_01", "");
        mainDashboardSetHeader("Main_Dashboard_05_01", "Settings", "Platform Configuration");
        setSidebarActive('settings');
    }

    function main_dashboard_05_03_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_05_03_A", "");
        mainDashboardSetHeader("Main_Dashboard_05_03_A", "Bank Accounts", "Settings");
        setSidebarActive('settings');
    }

    function main_dashboard_05_03_B_OPEN(bank_account_id = 0) {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_05_03_B", "");
        var is_edit = parseInt(bank_account_id, 10) > 0;
        mainDashboardSetHeader("Main_Dashboard_05_03_B", is_edit ? "Edit Bank Account" : "Add Bank Account", "Settings");
        setSidebarActive('settings');
        if (is_edit && typeof window.settingsBankAccountLoadEdit === 'function') {
            window.settingsBankAccountLoadEdit(parseInt(bank_account_id, 10));
        } else if (typeof window.settingsBankAccountPrepareNew === 'function') {
            window.settingsBankAccountPrepareNew();
        }
    }

    function main_dashboard_05_04_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_05_04_A", "");
        mainDashboardSetHeader("Main_Dashboard_05_04_A", "Income / Expense Types", "Settings");
        setSidebarActive('settings');
        if (typeof window.fetchTypesFromDB === 'function') {
            window.fetchTypesFromDB();
        }
    }

    function main_dashboard_05_04_B_OPEN(type_id = 0, name = '', category = 'expense') {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_05_04_B", "");
        var is_edit = parseInt(type_id, 10) > 0;
        main_dashboard_remember_page("Main_Dashboard_05_04_B", type_id);
        mainDashboardSetHeader("Main_Dashboard_05_04_B", is_edit ? "Edit Category / Type" : "Add Category / Type", "Settings");
        setSidebarActive('settings');
        if (is_edit && typeof window.settingsIncomeExpenseTypeLoadEdit === 'function') {
            window.settingsIncomeExpenseTypeLoadEdit(parseInt(type_id, 10), name, category);
        } else if (typeof window.settingsIncomeExpenseTypePrepareNew === 'function') {
            window.settingsIncomeExpenseTypePrepareNew();
        }
    }

    function Main_Dashboard_06_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_06_A", "");
        mainDashboardSetHeader("Main_Dashboard_06_A", "Notifications", "Member App Notification Center");
        setSidebarActive('notifications');
        if (typeof adminNotificationsLoad === 'function') {
            adminNotificationsLoad();
        }
    }

    function Main_Dashboard_07_A_OPEN() {
        main_dashboard_close_all();
        mainDashboardSetDisplay("Main_Dashboard_07_A", "");
        mainDashboardSetHeader("Main_Dashboard_07_A", "Financial Report", "Income & Expense Analysis");
        setSidebarActive('financial-report');
    }

    


    
</script>
