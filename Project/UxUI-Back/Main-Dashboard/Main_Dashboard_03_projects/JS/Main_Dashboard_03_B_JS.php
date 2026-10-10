<script type="text/javascript">
  /* ===================================================================
     Main_Dashboard_03_B_JS.php — Collection Project List logic (bmjm Admin)
     =================================================================== */

  var projectCollectionData = [];

  function projectCollectionEscape(value) {
      return String(value == null ? '' : value)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#039;');
  }

  function projectCollectionFiltersChanged() {
      projectCollectionRender();
  }

  function projectCollectionOpenDashboard(id) {
      if (!id) return;

      var basePath = window.location.pathname.indexOf('/UxUi/') !== -1
          ? window.location.pathname.substring(0, window.location.pathname.indexOf('/UxUi/'))
          : '';
      var dashboardUrl = window.location.origin + basePath + '/UxUi/Collection_dashboard.php?id=' + encodeURIComponent(id);
      window.location.href = dashboardUrl;
  }

  function fetchCollectionData() {
      $.ajax({
          url: "<?php echo $pth; ?>View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_JSON_VIEW.php",
          type: "GET",
          dataType: "json",
          success: function(data) {
              projectCollectionData = data;
              projectCollectionRender();
          },
          error: function(xhr, status, error) {
              console.error("Error fetching collection data:", error);
              projectCollectionShowError();
          }
      });
  }

  function projectCollectionRender() {
      var searchEl = document.getElementById('project-collection-search');
      if (!searchEl) return;
      
      var q = searchEl.value.trim().toLowerCase();
      var visibilityEl = document.getElementById('project-collection-visibility');
      var sortEl = document.getElementById('project-collection-sort');
      var visibility = visibilityEl ? visibilityEl.value : 'all';
      var sort = sortEl ? sortEl.value : 'name-asc';
      
      var rows = projectCollectionData.filter(function(c) {
          var isHidden = parseInt(c.is_hidden, 10) === 1;
          var matchesSearch = !q || String(c.name || '').toLowerCase().indexOf(q) !== -1;
          var matchesVisibility = visibility === 'all' ||
              (visibility === 'hidden' && isHidden) ||
              (visibility === 'public' && !isHidden);
          return matchesSearch && matchesVisibility;
      });

      rows.sort(function(a, b) {
          var aName = String(a.name || '').toLowerCase();
          var bName = String(b.name || '').toLowerCase();
          var aAmount = parseFloat(a.amount || 0);
          var bAmount = parseFloat(b.amount || 0);
          if (sort === 'name-desc') return bName.localeCompare(aName);
          if (sort === 'amount-desc') return bAmount - aAmount;
          if (sort === 'amount-asc') return aAmount - bAmount;
          return aName.localeCompare(bName);
      });

      var gridWrap = document.getElementById('project-collection-grid');
      var empty = document.getElementById('project-collection-empty');
      var results = document.getElementById('project-collection-results');

      if (!gridWrap) return;

      if (results) results.textContent = rows.length + (rows.length === 1 ? ' project' : ' projects');

      if (rows.length === 0) {
          gridWrap.innerHTML = '';
          if (empty) empty.style.display = 'block';
          return;
      }
      if (empty) empty.style.display = 'none';

      gridWrap.innerHTML = rows.map(function(c, index) {
          var animDelay = (index * 0.05).toFixed(2) + 's';
          var isHidden = parseInt(c.is_hidden, 10) === 1;
          
          var visibilityIcon = isHidden
              ? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>' 
              : '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>';
              
          var hiddenClass = isHidden ? 'hidden-state' : '';
          var tooltip = isHidden ? 'Hidden. Click to make public.' : 'Public. Click to hide.';
          
          var safeName = projectCollectionEscape(c.name || 'Untitled collection');
          var safeImage = projectCollectionEscape(c.image || '');
          var encodedPublicId = encodeURIComponent(c.public_id || '');
          var imgPayload = (c.image && c.image !== "") 
              ? '<img class="project-collection-card-img" src="../' + safeImage + '" alt="' + safeName + '" loading="lazy">'
              : '<div class="project-collection-card-fallback"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>';

          var amountVal = parseFloat(c.amount || 0);

          return '<div class="project-collection-card" style="animation-delay: ' + animDelay + ';">' +
                 '  <div class="project-collection-card-img-wrap">' +
                 '    ' + imgPayload +
                 '    <div class="project-collection-img-actions">' +
                 '      <button class="project-collection-img-btn project-collection-img-btn-toggle ' + hiddenClass + '" title="' + tooltip + '" aria-label="' + tooltip + '" onclick="projectCollectionToggleWeb(' + c.id + ')">' +
                 '        ' + visibilityIcon +
                 '      </button>' +
                 '      <button class="project-collection-img-btn" title="Copy public campaign link" aria-label="Copy public campaign link" onclick="projectCollectionCopyLink(decodeURIComponent(\'' + encodedPublicId + '\'))">' +
                 '        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>' +
                 '      </button>' +
                 '      <button class="project-collection-img-btn project-collection-img-btn-delete" title="Delete collection" aria-label="Delete collection" onclick="projectCollectionDelete(' + c.id + ')">' +
                 '        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>' +
                 '      </button>' +
                 '    </div>' +
                 '  </div>' +
                 '  <div class="project-collection-card-body">' +
                 '    <div class="project-collection-info">' +
                 '      <div class="project-collection-type-tag">Collection Initiative</div>' +
                 '      <div class="project-collection-name">' + safeName + '</div>' +
                 '    </div>' +
                 '    <div class="project-collection-metrics">' +
                 '      <div class="project-collection-amount">' + amountVal.toLocaleString('en-LK', {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</div>' +
                 '    </div>' +
                 '    <div class="project-collection-action-cell">' +
                 '      <button class="project-collection-view" onclick="Main_Dashboard_03_D_OPEN(' + c.id + ')">Edit</button>' +
                 '      <button class="project-collection-view project-collection-btn-accent" onclick="projectCollectionOpenDashboard(' + c.id + ')">' +
                 '        Dashboard' +
                 '        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>' +
                 '      </button>' +
                 '    </div>' +
                 '  </div>' +
                 '</div>';
      }).join('');
  }

  function projectCollectionShowError() {
      var alertEl = document.getElementById('project-collection-alert');
      if (alertEl) alertEl.classList.add('project-collection-alert-visible');
      var wrap = document.getElementById('project-collection-grid');
      if (wrap) wrap.style.display = 'none';
  }

  function projectCollectionToggleWeb(id) {
      $.ajax({
          url: "<?php echo $pth; ?>View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_TOGGLE_WEB.php",
          type: "POST",
          data: { id: id },
          success: function(res) {
              if ($.trim(res) === "1") {
                  fetchCollectionData();
              } else {
                  window.bmjmShowPopup({ type: 'error', title: 'Toggle Failed', message: 'Failed to toggle visibility: ' + res });
              }
          },
          error: function() {
              window.bmjmShowPopup({ type: 'error', title: 'Connection Error', message: 'Network error toggling state.' });
          }
      });
  }

  function projectCollectionDelete(id) {
      function executeDelete() {
          $.ajax({
              url: "<?php echo $pth; ?>View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_DELETE.php",
              type: "POST",
              data: { id: id },
              success: function(res) {
                  if ($.trim(res) === "1") {
                      fetchCollectionData();
                  } else {
                      window.bmjmShowPopup({ type: 'error', title: 'Delete Failed', message: 'Failed to delete record: ' + res });
                  }
              },
              error: function() {
                  window.bmjmShowPopup({ type: 'error', title: 'Connection Error', message: 'Network error dispatching deletion command.' });
              }
          });
      }

      if (typeof window.bmjmShowConfirm === 'function') {
          window.bmjmShowConfirm({
              type: 'error',
              title: 'Delete Collection?',
              message: 'Are you sure you want to completely erase this Collection and all its configuration?',
              confirmText: 'Yes, Delete'
          }, executeDelete);
      } else if (confirm("Are you sure you want to completely erase this Collection and all its configuration?")) {
          executeDelete();
      }
  }

  function projectCollectionCopyLink(publicId) {
      var basePath = window.location.pathname.substring(0, window.location.pathname.indexOf('/UxUI-Back/'));
      var url = window.location.origin + basePath + '/UxUi/Payment_IPG/Project_IPG_Pay_form.php?public_project_id=' + encodeURIComponent(publicId);
      
      if (navigator.clipboard) {
          navigator.clipboard.writeText(url).then(function() {
              window.bmjmShowPopup({ type: 'success', title: 'Link Copied', message: 'Public Checkout Link copied successfully!\n' + url });
          });
      } else {
          window.bmjmShowPopup({ type: 'info', title: 'Public Checkout Link', message: 'Please copy this URL manually:\n' + url });
      }
  }

  $(document).ready(function() {
      fetchCollectionData();
  });
</script>
