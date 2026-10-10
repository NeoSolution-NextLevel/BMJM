<script>
  /* ===================================================================
     manage-collection.js — Single Fetch Binding (bmjm Admin)
     =================================================================== */

  window.load_manage_collection = function(collectionId) {
      
      const payload = new FormData();
      payload.append("id", collectionId);
      
      document.querySelector('#Main_Dashboard_03_D #collection-edit-id').value = collectionId;
      
      fetch('../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_JSON.php', {
          method: 'POST',
          body: payload
      })
      .then(r => r.json())
      .then(data => {
          if (data.error === 0) {
              
              document.getElementById('manage-collection-title').innerHTML = `
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> 
                Manage: ${data.project_name}`;
              
              const titleEl = document.querySelector('#Main_Dashboard_03_D input[name="name"]');
              const disEl = document.querySelector('#Main_Dashboard_03_D textarea[name="description"]');
              
              if(titleEl) titleEl.value = data.project_name;
              if(disEl) disEl.value = data.dis;
              
              // Active cover map
              if(data.project_img_pth && data.project_img_pth !== "") {
                  const img = document.querySelector('#Main_Dashboard_03_D #collection-new-cover-img');
                  if(img) {
                      img.src = `../../../${data.project_img_pth}`;
                      img.style.display = 'block';
                      const placeholders = img.parentNode.querySelectorAll('svg.collection-new-cover-mark, .collection-new-cover-text');
                      placeholders.forEach(el => el.style.display = 'none');
                      document.querySelector('#Main_Dashboard_03_D #collection-new-cover').classList.add('collection-new-cover-loaded');
                  }
              }

              // Set Boolean Checks
              const fixbudEl = document.querySelector('#Main_Dashboard_03_D #collection-new-fixbudget');
              if(fixbudEl) {
                  fixbudEl.checked = (data.is_fix_budget == 1);
                  collectionManageToggleBudget();
              }
              const amtEl = document.querySelector('#Main_Dashboard_03_D input[name="budget"]');
              if(amtEl) amtEl.value = data.fix_amount;
              
              const datechkEl = document.querySelector('#Main_Dashboard_03_D #collection-new-has-enddate');
              if(datechkEl) {
                  datechkEl.checked = (data.is_end_date == 1);
                  collectionManageToggleDate();
              }
              
              if(data.fix_end_date && data.fix_end_date !== "") {
                  const dateStr = data.fix_end_date.split(' ');
                  const dtEl = document.querySelector('#Main_Dashboard_03_D input[name="end_date"]');
                  const tmEl = document.querySelector('#Main_Dashboard_03_D input[name="end_time"]');
                  if(dtEl && dateStr[0]) dtEl.value = dateStr[0];
                  if(tmEl && dateStr[1]) tmEl.value = dateStr[1];
              }
              
              const bankchkEl = document.querySelector('#Main_Dashboard_03_D #collection-new-pay-bank');
              if (bankchkEl) {
                  bankchkEl.checked = (data.assign_bank_account == 1);
                  collectionManageToggleBank();
                  const sl = document.querySelector('#Main_Dashboard_03_D select[name="bank_account"]');
                  if (sl && data.bank_account_id) { sl.value = data.bank_account_id; }
                  else if (sl) { sl.value = ""; }
              }
              
              const ticketckEl = document.querySelector('#Main_Dashboard_03_D #collection-new-has-tickets');
              if(ticketckEl){
                  ticketckEl.checked = (data.have_tickets == 1);
                  collectionManageToggleTickets();
                  collectionManageTickets = data.tickets && Array.isArray(data.tickets) ? data.tickets : [];
                  collectionManageRenderTickets();
              }

          } else {
              window.bmjmShowPopup({ type: 'error', title: 'Load Error', message: 'Error fetching collection details from the API.' });
          }
      }).catch(e => {
          console.error("Fetch Exception:", e);
      });
  };

  /* ----- Form Control Toggles for EDIT (Scoped explicitly) ----- */
  function collectionManageToggleBudget(){
    const wrap = document.querySelector('#Main_Dashboard_03_D #collection-new-budget-wrap');
    const chk = document.querySelector('#Main_Dashboard_03_D #collection-new-fixbudget');
    if(wrap && chk) wrap.classList.toggle('colln-toggle-reveal-active', chk.checked);
  }

  function collectionManageToggleDate(){
    const wrap = document.querySelector('#Main_Dashboard_03_D #collection-new-date-wrap');
    const chk = document.querySelector('#Main_Dashboard_03_D #collection-new-has-enddate');
    if(wrap && chk) wrap.classList.toggle('colln-toggle-reveal-active', chk.checked);
  }
  
  function collectionManageToggleBank(){
    const wrap = document.querySelector('#Main_Dashboard_03_D #collection-new-bank-wrap');
    const chk = document.querySelector('#Main_Dashboard_03_D #collection-new-pay-bank');
    if(wrap && chk) wrap.classList.toggle('colln-toggle-reveal-active', chk.checked);
  }
  
  function collectionManageToggleTickets(){
    const wrap = document.querySelector('#Main_Dashboard_03_D #collection-new-tickets-wrap');
    const chk = document.querySelector('#Main_Dashboard_03_D #collection-new-has-tickets');
    if(wrap && chk) wrap.classList.toggle('colln-toggle-reveal-active', chk.checked);
  }

  /* Overlaid Previews for 03_D */
  function collectionManagePreview(input){
    if(!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e){
      const img = document.querySelector('#Main_Dashboard_03_D #collection-new-cover-img');
      img.src = e.target.result;
      img.style.display = 'block';
      const placeholders = img.parentNode.querySelectorAll('svg.collection-new-cover-mark, .collection-new-cover-text');
      placeholders.forEach(el => el.style.display = 'none');
      document.querySelector('#Main_Dashboard_03_D #collection-new-cover').classList.add('collection-new-cover-loaded');
    };
    reader.readAsDataURL(input.files[0]);
  }
  
  // Hijack the onchange attributes natively assigned from the HTML copy
  document.querySelector('#Main_Dashboard_03_D #collection-new-file').onchange = function() { collectionManagePreview(this); };
  document.querySelector('#Main_Dashboard_03_D #collection-new-scan').onchange = function() { collectionManagePreview(this); };

  function collectionManageOpenModal() {
      const src = document.querySelector('#Main_Dashboard_03_D #collection-new-cover-img').src;
      if (!src) return;
      document.querySelector('#Main_Dashboard_03_D #collection-new-modal-img').src = src;
      document.querySelector('#Main_Dashboard_03_D #collection-new-image-modal').style.display = 'flex';
  }
  function collectionManageCloseModal() {
      document.querySelector('#Main_Dashboard_03_D #collection-new-image-modal').style.display = 'none';
  }

  document.querySelector('#Main_Dashboard_03_D .collection-new-view-btn').onclick = collectionManageOpenModal;
  document.querySelector('#Main_Dashboard_03_D #collection-new-image-modal').onclick = collectionManageCloseModal;

  // Initialize
  collectionManageToggleBudget();
  collectionManageToggleDate();
  collectionManageToggleBank();
  collectionManageToggleTickets();
  
  // Ensure toggles map to Manage routines instead of C routines
  document.querySelector('#Main_Dashboard_03_D #collection-new-fixbudget').onchange = collectionManageToggleBudget;
  document.querySelector('#Main_Dashboard_03_D #collection-new-has-enddate').onchange = collectionManageToggleDate;
  document.querySelector('#Main_Dashboard_03_D #collection-new-pay-bank').onchange = collectionManageToggleBank;
  document.querySelector('#Main_Dashboard_03_D #collection-new-has-tickets').onchange = collectionManageToggleTickets;

  
  /* Ticket Core */
  let collectionManageTickets = [];

  window.collectionManageAddTicket = function(){
    const priceInput = document.querySelector('#Main_Dashboard_03_D #colln-ticket-price');
    const qtyInput = document.querySelector('#Main_Dashboard_03_D #colln-ticket-qty');
    const price = parseFloat(priceInput.value);
    const qtyRaw = qtyInput.value.trim();
    const qty = qtyRaw === '' ? null : parseInt(qtyRaw, 10);
    
    if(isNaN(price) || price <= 0){ window.bmjmShowPopup({ type: 'warning', title: 'Invalid Ticket Price', message: 'Please enter a valid ticket denomination.' }); return; }
    if(qty !== null && (isNaN(qty) || qty <= 0)){ window.bmjmShowPopup({ type: 'warning', title: 'Invalid Quantity', message: 'Quantity must be a valid number, or left entirely blank for unlimited capacity.' }); return; }
    
    collectionManageTickets.push({ price: price, quantity: qty });
    priceInput.value = ''; qtyInput.value = '';
    collectionManageRenderTickets();
  }
  
  window.collectionManageRemoveTicket = function(index){
    collectionManageTickets.splice(index, 1);
    collectionManageRenderTickets();
  }
  
  function collectionManageRenderTickets(){
    const list = document.querySelector('#Main_Dashboard_03_D #colln-ticket-list');
    const dataInput = document.querySelector('#Main_Dashboard_03_D #collection-tickets-data');
    list.innerHTML = '';
    
    list.style.display = 'grid';
    list.style.gridTemplateColumns = 'repeat(auto-fill, minmax(280px, 1fr))';
    list.style.gap = '20px';
    list.style.marginTop = '24px';
    
    if(collectionManageTickets.length === 0){
        list.style.display = 'block';
        list.innerHTML = '<div style="font-size:13.5px; color:var(--colln-ink-400); font-weight: 500; font-style:italic; text-align:center; padding: 24px; background:var(--colln-cream-100); border-radius:12px;">No ticket tiers configured.</div>';
    } else {
        collectionManageTickets.forEach((t, i) => {
            const el = document.createElement('div');
            el.style = "position:relative; background:var(--colln-white); border:2px solid var(--colln-border); border-radius:16px; padding:24px 20px; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; box-shadow: 0 8px 24px rgba(11,46,36,0.04); transition:all 0.2s;";
            const qtyText = t.quantity === null ? 'Unlimited Tier' : t.quantity + ' Available';
            el.innerHTML = `
                <div style="font-size:11.5px; font-weight:800; color:var(--colln-ink-400); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/></svg>
                    ${qtyText}
                </div>
                <div style="font-size:26px; font-weight:800; color:var(--colln-green-950); letter-spacing:-0.02em;">Rs. ${t.price.toLocaleString('en-US')}</div>
                <button type="button" onclick="collectionManageRemoveTicket(${i})" title="Remove Tier" style="width:34px; height:34px; border-radius:50%; background:var(--colln-white); border:2px solid var(--colln-border); cursor:pointer; color:var(--colln-danger); display:flex; align-items:center; justify-content:center; position:absolute; top:-12px; right:-12px; box-shadow: 0 4px 12px rgba(176,69,58,0.15);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            `;
            list.appendChild(el);
        });
    }
    dataInput.value = JSON.stringify(collectionManageTickets);
  }
  
  collectionManageRenderTickets();

  // Route 'Add Ticket' click internally
  document.querySelector('#Main_Dashboard_03_D button[onclick="collectionNewAddTicket()"]').onclick = collectionManageAddTicket;

  /* Submission Setup */
  document.getElementById('collection-edit-form').addEventListener('submit', function(e){
    e.preventDefault();

    const nameEl = document.querySelector('#Main_Dashboard_03_D #collection-new-name');
    const wrapName = document.querySelector('#Main_Dashboard_03_D #collection-new-field-name');
    const hasName = nameEl.value.trim().length > 0;
    wrapName.classList.toggle('collection-new-invalid', !hasName);

    const descEl = document.querySelector('#Main_Dashboard_03_D #collection-new-description');
    const wrapDesc = document.querySelector('#Main_Dashboard_03_D #collection-new-field-description');
    const hasDesc = descEl.value.trim().length > 0;
    wrapDesc.classList.toggle('collection-new-invalid', !hasDesc);
    
    if(!hasName || !hasDesc) return;

    let formData = new FormData(this);
    
    // Explicitly grab cover image scoped under D
    const fileInput = document.querySelector('#Main_Dashboard_03_D #collection-new-file');
    const scanInput = document.querySelector('#Main_Dashboard_03_D #collection-new-scan');
    if (fileInput && fileInput.files.length > 0) formData.append('cover_image', fileInput.files[0]);
    else if (scanInput && scanInput.files.length > 0) formData.append('cover_image', scanInput.files[0]);

    $.ajax({
       url: "<?php echo $pth; ?>View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_ADD_UPDATE_VIEW.php",
       type: "POST",
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       processData: false,
       success: function (res) {
          if(res.trim() === "1") {
             const toast = document.querySelector('#Main_Dashboard_03_D .collection-new-toast');
             if(toast) { 
                 toast.style.display = 'flex';
                 toast.innerHTML = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg> Selected Campaign Realigned Successfully.`;
             }
             setTimeout(function(){ 
                 if(typeof Main_Dashboard_03_B_OPEN === 'function'){
                     fetchCollectionData(); // Force refresh grid
                     Main_Dashboard_03_B_OPEN(); 
                 }
             }, 1000);
          } else {
             window.bmjmShowPopup({ type: 'error', title: 'Update Error', message: 'Error maintaining collection edits: ' + res });
          }
       },
       error: function() {
          window.bmjmShowPopup({ type: 'error', title: 'Connection Error', message: 'Fatal Network Error resolving adjustments.' });
       }
    });
  });
</script>
