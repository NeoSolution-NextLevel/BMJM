<script>
let globalProjectData = [];

document.addEventListener("DOMContentLoaded", function() {
    fetchProjectList();
});

function fetchProjectList() {
    $.ajax({
        url: "../../View-List/Projects/wwjm_projects_collection_list/wwjm_projects_collection_list_JSON_VIEW.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (Array.isArray(response)) {
                globalProjectData = response;
                paymentProjectRender();
            } else {
                showEmptyState("Failed to load projects.");
            }
        },
        error:function(e) {
            console.error("AJAX Error");
            showEmptyState("Communication error loading projects.");
        }
    });
}

function paymentProjectRender() {
    const listEl = document.getElementById("payment-project-list");
    const emptyEl = document.getElementById("payment-project-empty");
    const searchVal = document.getElementById("payment-project-search").value.toLowerCase();
    
    let html = "";
    let count = 0;
    
    for (let i = 0; i < globalProjectData.length; i++) {
        let p = globalProjectData[i];
        
        let pName = (p.name || "").toLowerCase();
        
        if (searchVal !== "" && pName.indexOf(searchVal) === -1) {
            continue;
        }
        
        let imgPath = p.image ? "../../" + p.image : "../../assets/images/sample_project.jpg";
        
        html += `
        <div class="payment-project-row">
            <div class="payment-project-row-left">
                <div class="payment-project-row-img" style="background-image:url('${imgPath}')"></div>
                <div class="payment-project-row-info">
                   <div class="payment-project-row-name">${p.name}</div>
                   <div class="payment-project-row-sub">Collection ID #${p.id}</div>
                </div>
            </div>
            <!-- Progresses through SPA flow seamlessly -->
            <button class="payment-project-row-select" onclick="selectPaymentProject(${p.id}, '${p.name.replace(/'/g, "\\'")}')">Select</button>
        </div>
        `;
        count++;
    }
    
    if (count === 0) {
        listEl.innerHTML = "";
        emptyEl.style.display = "block";
    } else {
        emptyEl.style.display = "none";
        listEl.innerHTML = html;
    }
}

function selectPaymentProject(id, name) {
    // Set standard payment type to trigger correct workflows
    var el = document.getElementById("DashBord_Payment_body_paying_type_default");
    if (!el) {
        el = document.createElement("input");
        el.type = "hidden";
        el.id = "DashBord_Payment_body_paying_type_default";
        document.body.appendChild(el);
    }
    el.value = "Projects";
    
    // Attribute the specific project globally for following components
    var pEl = document.getElementById("payment_selected_project_id");
    if (!pEl) {
        pEl = document.createElement("input");
        pEl.type = "hidden";
        pEl.id = "payment_selected_project_id";
        document.body.appendChild(pEl);
    }
    pEl.value = id;

    var pnEl = document.getElementById("payment_selected_project_name");
    if (!pnEl) {
        pnEl = document.createElement("input");
        pnEl.type = "hidden";
        pnEl.id = "payment_selected_project_name";
        document.body.appendChild(pnEl);
    }
    pnEl.value = name;

    if (typeof main_dashboard_02_C_OPEN === "function") {
        main_dashboard_02_C_OPEN();
    }
}

function showEmptyState(msg) {
    document.getElementById("payment-project-list").innerHTML = "";
    let emptyEl = document.getElementById("payment-project-empty");
    emptyEl.innerText = msg;
    emptyEl.style.display = "block";
}
</script>
