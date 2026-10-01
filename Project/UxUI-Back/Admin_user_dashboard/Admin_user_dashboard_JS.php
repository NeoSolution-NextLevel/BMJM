<script type="text/javascript">
    function Admin_user_dashboard_storage_key() {
        return 'bmjm_admin_current_page:' + window.location.pathname + window.location.search;
    }

    function Admin_user_dashboard_remember_page(pageId) {
        try {
            window.sessionStorage.setItem(Admin_user_dashboard_storage_key(), pageId);
        } catch (error) {
            // The dashboard still works when browser storage is unavailable.
        }
    }

    function Admin_user_dashboard_restore_page() {
        var pageId = '';
        try {
            pageId = window.sessionStorage.getItem(Admin_user_dashboard_storage_key()) || '';
        } catch (error) {
            pageId = '';
        }

        var openFunctions = {
            'Admin_user_dashboard_01': Admin_user_dashboard_01_OPEN,
            'Admin_user_dashboard_01_B': function() { Admin_user_dashboard_01_B_OPEN(); },
            'Admin_user_dashboard_02_A': Admin_user_dashboard_02_A_OPEN,
            'Admin_user_dashboard_02_B': Admin_user_dashboard_02_B_OPEN,
            'Admin_user_dashboard_02_C': Admin_user_dashboard_02_C_OPEN,
            'Admin_user_dashboard_02_D': Admin_user_dashboard_02_D_OPEN,
            'Admin_user_dashboard_02_E': Admin_user_dashboard_02_E_OPEN,
            'Admin_user_dashboard_02_F': Admin_user_dashboard_02_F_OPEN,
            'Admin_user_dashboard_02_G': Admin_user_dashboard_02_G_OPEN,
            'Admin_user_dashboard_02_H': Admin_user_dashboard_02_H_OPEN,
            'Admin_user_dashboard_02_I': Admin_user_dashboard_02_I_OPEN,
            'Admin_user_dashboard_03_A': Admin_user_dashboard_03_A_OPEN,
            'Admin_user_dashboard_03_B': Admin_user_dashboard_03_B_OPEN,
            'Admin_user_dashboard_03_C': Admin_user_dashboard_03_C_OPEN
        };

        if (pageId && document.getElementById(pageId) && openFunctions[pageId]) {
            openFunctions[pageId]();
            return;
        }

        Admin_user_dashboard_01_OPEN();
    }

    function setSidebarActive(pageName) {
        document.querySelectorAll('.bmjm-sidebar-nav-item').forEach(function(item){
            item.classList.toggle('bmjm-sidebar-active', item.getAttribute('data-page') === pageName);
        });
    }

    function Admin_user_dashboard_close_all() {
        document.getElementById("Admin_user_dashboard_01").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_A").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_B").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_C").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_D").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_E").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_F").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_G").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_H").style.display = "none";
        document.getElementById("Admin_user_dashboard_02_I").style.display = "none";

        document.getElementById("Admin_user_dashboard_01_B").style.display = "none";
        document.getElementById("Admin_user_dashboard_03_A").style.display = "none";
        document.getElementById("Admin_user_dashboard_03_B").style.display = "none";
        document.getElementById("Admin_user_dashboard_03_C").style.display = "none";
        
        
       
    }

    function Admin_user_dashboard_01_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_01").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_01");
        setSidebarActive('dashboard');
        if (typeof Member_body_01_01_A_01_Memeber_Details_Display === 'function') {
            Member_body_01_01_A_01_Memeber_Details_Display();
        }
    }

    function Admin_user_dashboard_01_B_OPEN(paymentData) {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_01_B").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_01_B");
        setSidebarActive('dashboard');
        if (typeof populatePaymentSlipView === 'function') {
            populatePaymentSlipView(paymentData);
        }
    }

    function Admin_user_dashboard_02_A_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_A").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_A");
        setSidebarActive('payment');
        if (typeof paymentListFetch === 'function') {
            paymentListFetch();
        }
    }

    function Admin_user_dashboard_02_B_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_B").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_B");
        setSidebarActive('payment');
    }

    function Admin_user_dashboard_02_C_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_C").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_C");
        setSidebarActive('payment');
    }

    function Admin_user_dashboard_02_D_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_D").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_D");
        setSidebarActive('payment');
    }

    function Admin_user_dashboard_02_E_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_E").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_E");
        setSidebarActive('payment');
        if (typeof loadCashPaymentDataAdmin === "function") {
            loadCashPaymentDataAdmin();
        }
    }

    function Admin_user_dashboard_02_F_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_F").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_F");
        setSidebarActive('payment');
        if (typeof fetchBankList === 'function') {
            fetchBankList();
        }
    }

    function Admin_user_dashboard_02_G_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_G").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_G");
        setSidebarActive('payment');
    }

    
    function Admin_user_dashboard_02_H_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_H").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_H");
        setSidebarActive('payment');
    }

    

    function Admin_user_dashboard_02_I_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_02_I").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_02_I");
        setSidebarActive('payment');
    }

    function Admin_user_dashboard_03_A_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_03_A").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_03_A");
        setSidebarActive('profile');
        if (typeof fetchMemberProfileData === 'function') {
            fetchMemberProfileData();
        }
    }

    function Admin_user_dashboard_03_B_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_03_B").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_03_B");
        setSidebarActive('profile');
        if (typeof populateProfileEditForm === 'function') {
            populateProfileEditForm();
        }
    }

    function Admin_user_dashboard_03_C_OPEN() {
        Admin_user_dashboard_close_all();
        document.getElementById("Admin_user_dashboard_03_C").style.display = "";
        Admin_user_dashboard_remember_page("Admin_user_dashboard_03_C");
        setSidebarActive('profile');
        if (typeof populateBlockProfileData === 'function') {
            populateBlockProfileData();
        }
    }

  

    

    
</script>
