<script type="text/javascript">
    function user_dashboard_storage_key() {
        return 'bmjm_user_current_page:' + window.location.pathname + window.location.search;
    }

    function user_dashboard_remember_page(pageId) {
        try { window.sessionStorage.setItem(user_dashboard_storage_key(), pageId); } catch (error) {}
    }

    function user_dashboard_restore_page() {
        var pageId = '';
        try { pageId = window.sessionStorage.getItem(user_dashboard_storage_key()) || ''; } catch (error) {}
        var pages = {
            'user_dashboard_01_A': user_dashboard_01_A_OPEN,
            'user_dashboard_02_A': user_dashboard_02_A_OPEN,
            'user_dashboard_02_B': user_dashboard_02_B_OPEN,
            'user_dashboard_02_C': user_dashboard_02_C_OPEN,
            'user_dashboard_02_D': user_dashboard_02_D_OPEN,
            'user_dashboard_02_E': user_dashboard_02_E_OPEN,
            'user_dashboard_03_A': user_dashboard_03_A_OPEN
        };
        (pageId && pages[pageId] ? pages[pageId] : user_dashboard_01_A_OPEN)();
    }

    function setSidebarActive(pageName) {
        document.querySelectorAll('.bmjm-sidebar-nav-item').forEach(function(item){
            item.classList.toggle('bmjm-sidebar-active', item.getAttribute('data-page') === pageName);
        });
    }

    function user_dashboard_close_all() {
        document.getElementById("user_dashboard_01_A").style.display = "none";
        document.getElementById("user_dashboard_02_A").style.display = "none";
        document.getElementById("user_dashboard_02_B").style.display = "none";
        document.getElementById("user_dashboard_02_C").style.display = "none";
        document.getElementById("user_dashboard_02_D").style.display = "none";
        document.getElementById("user_dashboard_02_E").style.display = "none";
     
        document.getElementById("user_dashboard_03_A").style.display = "none";
        
       
        
        
       
    }

    function user_dashboard_01_A_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_01_A").style.display = "";
        user_dashboard_remember_page("user_dashboard_01_A");
        setSidebarActive('dashboard');
       
    }

    function user_dashboard_02_A_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_02_A").style.display = "";
        user_dashboard_remember_page("user_dashboard_02_A");
        setSidebarActive('payment');
    }

    function user_dashboard_02_B_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_02_B").style.display = "";
        user_dashboard_remember_page("user_dashboard_02_B");
        setSidebarActive('payment');
    }

    function user_dashboard_02_C_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_02_C").style.display = "";
        user_dashboard_remember_page("user_dashboard_02_C");
        setSidebarActive('payment');
    }

    function user_dashboard_02_D_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_02_D").style.display = "";
        user_dashboard_remember_page("user_dashboard_02_D");
        setSidebarActive('payment');
    }

    function user_dashboard_02_E_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_02_E").style.display = "";
        user_dashboard_remember_page("user_dashboard_02_E");
        setSidebarActive('payment');
    }

    function user_dashboard_03_A_OPEN() { 
        user_dashboard_close_all();
        document.getElementById("user_dashboard_03_A").style.display = "";
        user_dashboard_remember_page("user_dashboard_03_A");
        setSidebarActive('settings');
    }

   
    

    
</script>
