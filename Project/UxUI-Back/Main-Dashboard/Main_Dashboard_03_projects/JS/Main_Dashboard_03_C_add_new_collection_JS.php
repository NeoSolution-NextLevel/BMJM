<script>
  /* ===================================================================
     collection-new.js — Modern Monolithic Form Script (bmjm Admin)
     =================================================================== */

  function collectionNewToggleBudget(){
    document.getElementById('collection-new-budget-wrap')
      .classList.toggle('colln-toggle-reveal-active', document.getElementById('collection-new-fixbudget').checked);
  }

  function collectionNewToggleDate(){
    document.getElementById('collection-new-date-wrap')
      .classList.toggle('colln-toggle-reveal-active', document.getElementById('collection-new-has-enddate').checked);
  }
  
  function collectionNewToggleBank(){
    document.getElementById('collection-new-bank-wrap')
      .classList.toggle('colln-toggle-reveal-active', document.getElementById('collection-new-pay-bank').checked);
  }
  
  function collectionNewToggleTickets(){
    document.getElementById('collection-new-tickets-wrap')
      .classList.toggle('colln-toggle-reveal-active', document.getElementById('collection-new-has-tickets').checked);
  }

  function collectionNewPreview(input){
    if(!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e){
      const img = document.getElementById('collection-new-cover-img');
      img.src = e.target.result;
      img.style.display = 'block';
      const placeholders = img.parentNode.querySelectorAll('svg.collection-new-cover-mark, .collection-new-cover-text');
      placeholders.forEach(el => el.style.display = 'none');
      document.getElementById('collection-new-cover').classList.add('collection-new-cover-loaded');
    };
    reader.readAsDataURL(input.files[0]);
  }

  function collectionNewOpenModal() {
      const src = document.getElementById('collection-new-cover-img').src;
      if (!src) return;
      document.getElementById('collection-new-modal-img').src = src;
      document.getElementById('collection-new-image-modal').style.display = 'flex';
  }
  function collectionNewCloseModal() {
      document.getElementById('collection-new-image-modal').style.display = 'none';
  }

  // Pre-initialize toggles just in case
  collectionNewToggleBudget();
  collectionNewToggleDate();
  collectionNewToggleBank();
  collectionNewToggleTickets();
  
  // Ticketing Logic
  let collectionTickets = [];

  function collectionNewAddTicket(){
    const priceInput = document.getElementById('colln-ticket-price');
    const qtyInput = document.getElementById('colln-ticket-qty');
    const price = parseFloat(priceInput.value);
    const qtyRaw = qtyInput.value.trim();
    const qty = qtyRaw === '' ? null : parseInt(qtyRaw, 10);
    
    if(isNaN(price) || price <= 0){
        alert("Please enter a valid ticket denomination.");
        return;
    }
    if(qty !== null && (isNaN(qty) || qty <= 0)){
        alert("Quantity must be a valid number, or left entirely blank for unlimited capacity.");
        return;
    }
    
    collectionTickets.push({ price: price, quantity: qty });
    priceInput.value = ''; qtyInput.value = '';
    collectionNewRenderTickets();
  }
  
  function collectionNewRemoveTicket(index){
    collectionTickets.splice(index, 1);
    collectionNewRenderTickets();
  }
  
  function collectionNewRenderTickets(){
    const list = document.getElementById('colln-ticket-list');
    const dataInput = document.getElementById('collection-tickets-data');
    list.innerHTML = '';
    
    list.style.display = 'grid';
    list.style.gridTemplateColumns = 'repeat(auto-fill, minmax(200px, 1fr))';
    list.style.gap = '20px';
    list.style.marginTop = '24px';
    
    if(collectionTickets.length === 0){
        list.style.display = 'block';
        list.innerHTML = '<div style="font-size:13.5px; color:var(--colln-ink-400); font-weight: 500; font-style:italic; text-align:center; padding: 24px; background:var(--colln-cream-100); border-radius:12px;">No ticket tiers configured. Add one above.</div>';
    } else {
        collectionTickets.forEach((t, i) => {
            const el = document.createElement('div');
            el.style = "position:relative; background:var(--colln-white); border:2px solid var(--colln-border); border-radius:16px; padding:24px 20px; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center; box-shadow: 0 8px 24px rgba(11,46,36,0.04); transition:all 0.2s;";
            
            const qtyText = t.quantity === null ? 'Unlimited Tier' : t.quantity + ' Available';
            
            el.innerHTML = `
                <div style="font-size:11.5px; font-weight:800; color:var(--colln-ink-400); text-transform:uppercase; letter-spacing:0.06em; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/></svg>
                    ${qtyText}
                </div>
                <div style="font-size:26px; font-weight:800; color:var(--colln-green-950); letter-spacing:-0.02em;">Rs. ${t.price.toLocaleString('en-US')}</div>
                
                <button type="button" onclick="collectionNewRemoveTicket(${i})" title="Remove Tier" style="width:34px; height:34px; border-radius:50%; background:var(--colln-white); border:2px solid var(--colln-border); cursor:pointer; color:var(--colln-danger); display:flex; align-items:center; justify-content:center; transition:all 0.2s; position:absolute; top:-12px; right:-12px; box-shadow: 0 4px 12px rgba(176,69,58,0.15);" onmouseover="this.style.background='var(--colln-danger)'; this.style.color='var(--colln-white)'; this.style.borderColor='var(--colln-danger)';" onmouseout="this.style.background='var(--colln-white)'; this.style.color='var(--colln-danger)'; this.style.borderColor='var(--colln-border)';">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            `;
            list.appendChild(el);
        });
    }
    
    dataInput.value = JSON.stringify(collectionTickets);
  }
  
  collectionNewRenderTickets();

  document.getElementById('collection-new-form').addEventListener('submit', function(e){
    e.preventDefault();

    const fields = [
      { id:'collection-new-name',        wrap:'collection-new-field-name' },
      { id:'collection-new-description', wrap:'collection-new-field-description' }
    ];
    let valid = true;
    fields.forEach(function(f){
      const el = document.getElementById(f.id);
      const wrap = document.getElementById(f.wrap);
      const filled = el.value.trim().length > 0;
      wrap.classList.toggle('collection-new-invalid', !filled);
      if(!filled) valid = false;
    });
    if(!valid) return;

    let formData = new FormData(this);
    
    // Grab the inputs from the form dynamically
    const fileInput = document.getElementById('collection-new-file');
    const scanInput = document.getElementById('collection-new-scan');
    
    if (fileInput.files.length > 0) formData.append('cover_image', fileInput.files[0]);
    else if (scanInput.files.length > 0) formData.append('cover_image', scanInput.files[0]);

    // Send payload using AJAX
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
             const toast = document.getElementById('collection-new-toast');
             toast.style.display = 'flex';
             setTimeout(function(){ Main_Dashboard_03_B_OPEN(); }, 1000);
          } else {
             alert("Error submitting new collection: " + res);
          }
       },
       error: function() {
          alert("Fatal Network Error during submission. Please try again.");
       }
    });

  });
</script>
