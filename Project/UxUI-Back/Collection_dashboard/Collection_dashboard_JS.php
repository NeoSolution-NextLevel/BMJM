<script type="text/javascript">
    function Collection_dashboard_storage_key() {
        return 'bmjm_collection_current_page:' + window.location.pathname + window.location.search;
    }

    function Collection_dashboard_remember_page(pageId, recordId) {
        try {
            window.sessionStorage.setItem(Collection_dashboard_storage_key(), JSON.stringify({ pageId: pageId, recordId: recordId || null }));
        } catch (error) {}
    }

    function Collection_dashboard_restore_page() {
        var state = null;
        try { state = JSON.parse(window.sessionStorage.getItem(Collection_dashboard_storage_key()) || 'null'); } catch (error) {}
        if (!state || !state.pageId) {
            Collection_Dashboard_01_A_OPEN();
            return;
        }
        var pages = {
            'Collection_Dashboard_01_A': Collection_Dashboard_01_A_OPEN,
            'Collection_Dashboard_02_A': Collection_Dashboard_02_A_OPEN,
            'Collection_Dashboard_02_B': function() { Collection_Dashboard_02_B_OPEN(state.recordId); },
            'Collection_Dashboard_02_C': Collection_Dashboard_02_C_OPEN,
            'Collection_Dashboard_03_A': Collection_Dashboard_03_A_OPEN,
            'Collection_Dashboard_03_B': Collection_Dashboard_03_B_OPEN,
            'Collection_Dashboard_03_C': function() { Collection_Dashboard_03_C_OPEN(state.recordId); }
        };
        (pages[state.pageId] || Collection_Dashboard_01_A_OPEN)();
    }

    function setSidebarActive(pageName) {
        document.querySelectorAll('.bmjm-sidebar-nav-item').forEach(function(item){
            item.classList.toggle('bmjm-sidebar-active', item.getAttribute('data-page') === pageName);
        });
    }

    function Collection_dashboard_close_all() {
        document.getElementById("Collection_Dashboard_01_A").style.display = "none";
        document.getElementById("Collection_Dashboard_02_A").style.display = "none";
        document.getElementById("Collection_Dashboard_03_A").style.display = "none";
        
        let el_03b = document.getElementById("Collection_Dashboard_03_B");
        if(el_03b) el_03b.style.display = "none";
        
        let el_03c = document.getElementById("Collection_Dashboard_03_C");
        if(el_03c) el_03c.style.display = "none";
        
        let el_02b = document.getElementById("Collection_Dashboard_02_B");
        if(el_02b) el_02b.style.display = "none";

        let el_02c = document.getElementById("Collection_Dashboard_02_C");
        if(el_02c) el_02c.style.display = "none";
       
    }

    function Collection_Dashboard_01_A_OPEN() { 
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_01_A").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_01_A");
        setSidebarActive('dashboard');
        
    }

    function Collection_Dashboard_02_A_OPEN() {
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_02_A").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_02_A");
        setSidebarActive('payment');
    }

    function Collection_Dashboard_02_B_OPEN(slipId) {
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_02_B").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_02_B", slipId);
        setSidebarActive('payment');
        if (typeof loadSinglePaymentDetails === 'function') {
            loadSinglePaymentDetails(slipId);
        }
    }

    function Collection_Dashboard_02_C_OPEN() {
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_02_C").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_02_C");
        setSidebarActive('payment');
        if (typeof loadCollectionPaymentCreateContext === 'function') {
            loadCollectionPaymentCreateContext();
        }
    }

    function Collection_Dashboard_03_A_OPEN() {
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_03_A").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_03_A");
        setSidebarActive('profile');
    }

    function Collection_Dashboard_03_B_OPEN() {
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_03_B").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_03_B");
        setSidebarActive('profile');
    }

    function Collection_Dashboard_03_C_OPEN(expenseId) {
        Collection_dashboard_close_all();
        document.getElementById("Collection_Dashboard_03_C").style.display = "";
        Collection_dashboard_remember_page("Collection_Dashboard_03_C", expenseId);
        setSidebarActive('profile');
        if (typeof loadSingleExpenseDetails === 'function') {
            loadSingleExpenseDetails(expenseId);
        }
    }

   
  

    

    
</script>
