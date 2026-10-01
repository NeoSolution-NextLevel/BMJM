<script type="text/javascript">
    /**
     * Main Dashboard Overview (Main-Dashboard_00)
     * Real-time Database Data Sync via AJAX
     */

    function dash00EscapeHtml(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function animateValue(obj, start, end, duration) {
        if (!obj) return;
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    
    function animateCurrency(obj, start, end, duration) {
        if (!obj) return;
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            let val = Math.floor(progress * (end - start) + start);
            obj.innerHTML = val.toLocaleString('en-US');
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    function main_refresh_dashboard_data() {
      const memObj = document.getElementById('dash00-total-members-val');
      const revObj = document.querySelector('#dash00-total-collected-val .calc-val');
      const listObj = document.getElementById('dash00-recent-payments-list');
      const pendingObj = document.getElementById('dash00-pending-approvals-val');
      const databaseStatusObj = document.getElementById('dash00-database-status');
      const apiStatusObj = document.getElementById('dash00-api-status');
      const lastSyncObj = document.getElementById('dash00-last-sync');
      
      if(memObj) memObj.innerText = '...';
      if(revObj) revObj.innerText = '...';
      if(pendingObj) pendingObj.innerText = '...';
      if(databaseStatusObj) databaseStatusObj.innerText = 'Checking';
      if(apiStatusObj) apiStatusObj.innerText = 'Syncing';
      if(listObj) listObj.innerHTML = '<div style="padding:20px; text-align:center; color:var(--dash00-ink-400); font-weight:600;">Loading live records...</div>';

      var pthPrefix = "<?php echo isset($pth) ? $pth : '../'; ?>";

      // 1. Fetch full dashboard aggregates from the database.
      $.ajax({
        url: pthPrefix + "View-List/Main/main_dashboard_summary.php",
        type: "POST",
        dataType: "json",
        success: function(res) {
          var data = typeof res === 'string' ? JSON.parse(res) : res;
          if (!data || data.status !== 'success' || !data.summary) {
            if(memObj) memObj.innerText = '--';
            if(revObj) revObj.innerText = '--';
            if(pendingObj) pendingObj.innerText = '--';
            if(databaseStatusObj) databaseStatusObj.innerText = 'Unavailable';
            if(apiStatusObj) apiStatusObj.innerText = 'Offline';
            if(lastSyncObj) lastSyncObj.innerText = 'Sync failed';
            return;
          }

          var summary = data.summary;
          animateValue(memObj, 0, parseInt(summary.active_members || 0, 10), 700);
          animateCurrency(revObj, 0, Math.round(parseFloat(summary.collected_amount || 0)), 900);
          animateValue(pendingObj, 0, parseInt(summary.pending_approvals || 0, 10), 700);
          if(databaseStatusObj) databaseStatusObj.innerText = summary.database_status || 'Connected';
          if(apiStatusObj) apiStatusObj.innerText = 'Online';
          if(lastSyncObj) lastSyncObj.innerText = summary.server_time || new Date().toLocaleString();
        },
        error: function(xhr) {
          console.error('Failed to load dashboard summary:', xhr && xhr.responseText ? xhr.responseText : xhr);
          if(memObj) memObj.innerText = '--';
          if(revObj) revObj.innerText = '--';
          if(pendingObj) pendingObj.innerText = '--';
          if(databaseStatusObj) databaseStatusObj.innerText = 'Unavailable';
          if(apiStatusObj) apiStatusObj.innerText = 'Offline';
          if(lastSyncObj) lastSyncObj.innerText = 'Sync failed';
        }
      });

      // 2. Fetch only the five most recent collections for the activity list.
      $.ajax({
        url: pthPrefix + "View-List/Payment/payment_list.php",
        type: "POST",
        data: { st_count: 0, per_page: 5 },
        success: function(res) {
          try {
            var rows = typeof res === "string" ? JSON.parse(res) : res;
            if (!Array.isArray(rows) || rows.length === 0) {
              if (listObj) listObj.innerHTML = '<div style="padding:20px; text-align:center; color:var(--dash00-ink-400); font-weight:600;">No collections recorded yet.</div>';
              return;
            }

            // Render top 5 recent collections dynamically
            var topRows = rows.slice(0, 5);
            var html = topRows.map(function(p) {
              var rawName = p.person_name || p.name_M || (p.membership_no ? 'Member #' + p.membership_no : 'TRX-' + p.id);
              var splits = rawName.trim().split(' ');
              var initials = splits.length > 1 ? (splits[0][0] + splits[1][0]) : rawName.substring(0, 2);
              initials = initials.toUpperCase();

              var rawDate = p.payment_date || p.sdt || '';
              var dateDisplay = rawDate ? rawDate.split(' ')[0] : 'Recent';

              var payType = "Subscription";
              if (p.pay_resion_subcption == "1") payType = "Subscription";
              else if (p.pay_resion_donation == "1") payType = "Donation";
              else if (p.pay_resion_zakath == "1") payType = "Zakath";
              else if (p.pay_resion_projects == "1") payType = "Projects";

              var amountVal = parseFloat(p.val_01 || p.amount || 0);
              var formattedAmt = amountVal.toLocaleString('en-LK', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

              return '<div class="dash00-list-item">' +
                     '  <div class="dash00-item-left">' +
                     '    <div class="dash00-avatar">' + initials + '</div>' +
                     '    <div class="dash00-item-info">' +
                     '      <strong>' + dash00EscapeHtml(rawName) + '</strong>' +
                     '      <span>' + dash00EscapeHtml(dateDisplay) + '</span>' +
                     '    </div>' +
                     '  </div>' +
                     '  <div class="dash00-item-right">' +
                     '    <span class="dash00-val-amount">Rs ' + formattedAmt + '</span>' +
                     '    <span class="dash00-val-type">' + payType + '</span>' +
                     '  </div>' +
                     '</div>';
            }).join('');

            if (listObj) listObj.innerHTML = html;

          } catch(e) {
            console.error("Error parsing collections array:", e);
            if (listObj) listObj.innerHTML = '<div style="padding:20px; text-align:center; color:var(--dash00-ink-400);">Error loading records</div>';
          }
        },
        error: function(xhr, status, error) {
          console.error("Failed to load collections:", error);
          if (listObj) listObj.innerHTML = '<div style="padding:20px; text-align:center; color:var(--dash00-ink-400);">Failed to load collections</div>';
        }
      });
    }

    // Auto load on document ready
    if (typeof $ !== 'undefined') {
      $(document).ready(function() {
        main_refresh_dashboard_data();
      });
    } else {
      document.addEventListener('DOMContentLoaded', function() {
        main_refresh_dashboard_data();
      });
    }
</script>
