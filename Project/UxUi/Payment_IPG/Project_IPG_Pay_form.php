<?php
$raw_id = isset($_GET['id']) ? trim($_GET['id']) : '';
$raw_public_id = isset($_GET['public_project_id']) ? trim($_GET['public_project_id']) : '';
$pre_amount = isset($_GET['pre_amount']) ? floatval($_GET['pre_amount']) : 0;

include_once '../../imports/security/key_list.php';
include_once '../../imports/security/encrypt_decrypt.php';
include_once '../../imports/need/DB.php';
include_once '../../Controller/IPG_Send_By_URL/IPG_Send_By_URL_Sec_id_SINGLE_DATA.php';
include_once '../../Controller/projects/wwjm_projects_collection_list/wwjm_projects_collection_list_SINGLE_DATA.php';

$Advance_Security_Key_List_obj = new Advance_Security_Key_List();
$Advance_Security_obj = new Advance_Security();

$is_valid_link = false;
$is_public_flow = false;

// Variables for display
$amount = 0;
$name = "";
$phone = "";

$project_title = "Unknown Project";
$project_desc = "";
$project_img = "";
$is_fix_budget = 0;
$fix_amount = 0;
$collected_amount = 0;
$have_tickets = 0;
$available_tickets = [];

$actual_project_id = null;

if (!empty($raw_public_id)) {
    // PUBLIC ORGANIC SHARE LINK FLOW
    $is_public_flow = true;
    $decrypted_sec_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $raw_public_id);
    
    if (!empty($decrypted_sec_id)) {
        $actual_project_id = $decrypted_sec_id;
        $is_valid_link = true; 
    }
} else if (!empty($raw_id)) {
    // CLERK GENERATED PRIVATE OVERRIDE
    $decrypted_sec_id = $Advance_Security_obj->get_data_decrypt($Advance_Security_Key_List_obj->get_IPG_sec_id(), $raw_id);
    $ipg_data = new IPG_Send_By_URL_Sec_id_SINGLE_DATA($decrypted_sec_id);
    $is_valid_link = $ipg_data->get_state();

    if ($is_valid_link) {
        if ($ipg_data->get_ast() == '0') {
           $is_valid_link = false; // Link deactivated
        } else {
            $amount = $ipg_data->get_transation_amount();
            
            // Retrieve the cached Project Linkage
            $cache_file = '../../View-List/Payment_gateway/OnePay/project_ipg_cache.json';
            $cache = file_exists($cache_file) ? json_decode(file_get_contents($cache_file), true) : [];
            $actual_project_id = isset($cache[(string)$ipg_data->get_id()]) ? $cache[(string)$ipg_data->get_id()]['id'] : null;
            
            if ($actual_project_id) {
                // Morph any strictly generated Clerk links cleanly into Public Organic flows!
                $is_public_flow = true;
            } else {
                // Only bind strict members for Non-Project IPG items!
                $name = $ipg_data->get_cus_name();
                $phone = $ipg_data->get_cus_phone_no();
            }
        }
    }
}

if ($is_public_flow && $pre_amount > 0 && $amount == 0) {
    $amount = $pre_amount;
}

// Fetch Generic Project Settings regardless of flow
if ($actual_project_id) {
    $col = new wwjm_projects_collection_list_SINGLE_DATA($actual_project_id);
    if ($col->get_state()) {
        $project_title = $col->get_project_name();
        $project_desc = $col->get_dis();
        $project_img = $col->get_image_pth();
        $is_fix_budget = $col->get_is_fix_budget();
        $fix_amount = $col->get_fix_amount();
        $collected_amount = $col->get_collected_amount() ? floatval($col->get_collected_amount()) : 0;
        
        // Ensure method exists natively, fallback to 0 safely just in case db mapper is out of sync in specific models
        $have_tickets = method_exists($col, 'get_have_tickets') ? $col->get_have_tickets() : 0;
    }
}

// Fetch organic active tickets array directly mapped to the Public checkout natively!
if ($is_public_flow && $have_tickets == 1) {
    include_once '../../imports/need/DB.php';
    $db = new DataBase();
    $q = "SELECT id, price, total_capacity, total_sold, (total_capacity - total_sold) as quantity FROM collection_ticket_tiers WHERE wwjm_projects_collection_list_id = '" . $actual_project_id . "' AND ast = 1 AND show_on_web = 1 ORDER BY price ASC";
    $r = $db->get_result($q);
    if ($r) {
        while ($row = $r->fetch_assoc()) {
            // Count already purchased tickets seamlessly via DB ensuring stock constraints!
            if (intval($row['quantity']) > 0) {
                $available_tickets[] = [
                    'id' => $row['id'],
                    'amount' => floatval($row['price']),
                    'total_qty' => intval($row['quantity']),
                    'total_capacity' => intval($row['total_capacity']),
                    'total_sold' => intval($row['total_sold'])
                ];
            }
        }
    }
}

$formatted_amount = number_format((float)$amount, 2, '.', ',');
$remaining_budget = max(0, $fix_amount - $collected_amount);

$percentage = 0;
if ($is_fix_budget == 1 && $fix_amount > 0) {
    $percentage = min(100, round(($collected_amount / $fix_amount) * 100));
}

// Default fallback image if none provided natively!
if (empty($project_img)) {
    $project_img = "assets/images/placeholder_project.jpg";
}

include_once __DIR__ . '/../../imports/Company_Info/Company_Info_Variable_List.php';
$Company_Info = new Company_Info_Variable_List();
$dynamic_company_name = $Company_Info->get_compnay_short_name();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="theme-color" content="#061712">
  <title><?php echo htmlspecialchars($project_title); ?> | bmjm Collection</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Reenie+Beanie&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg-dark: #061712;
      --bg-surface: #0b241c;
      --card-bg: #103328;
      --gold-primary: #f59e0b;
      --gold-light: #fef3c7;
      --gold-gradient: linear-gradient(135deg, #fbbf24 0%, #d97706 50%, #92400e 100%);
      --emerald-accent: #10b981;
      --emerald-glow: rgba(16, 185, 129, 0.25);
      --text-light: #f3f4f6;
      --text-muted: #9ca3af;
      --ticket-cream: #faf5eb;
      --ticket-border: #d4af37;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: radial-gradient(circle at 15% 15%, #0f3d2e 0%, var(--bg-dark) 65%);
      color: var(--text-light);
      min-height: 100vh;
      overflow-x: hidden;
      line-height: 1.6;
    }

    .bg-pattern {
      position: fixed; inset: 0;
      background-image: 
        radial-gradient(rgba(245, 158, 11, 0.08) 1.5px, transparent 1.5px),
        radial-gradient(rgba(16, 185, 129, 0.05) 1.5px, transparent 1.5px);
      background-size: 32px 32px;
      background-position: 0 0, 16px 16px;
      pointer-events: none; z-index: 0;
    }

    header {
      position: relative; z-index: 10; display: flex; justify-content: space-between; align-items: center;
      gap: 0.75rem;
      padding: 0.85rem 1.5rem;
      padding-top: max(0.85rem, env(safe-area-inset-top));
      padding-left: max(1rem, env(safe-area-inset-left));
      padding-right: max(1rem, env(safe-area-inset-right));
      background: rgba(6, 23, 18, 0.92);
      backdrop-filter: blur(14px); border-bottom: 1px solid rgba(245, 158, 11, 0.25);
    }

    .brand-group { display: flex; align-items: center; gap: 0.7rem; min-width: 0; }
    .brand-emblem {
      width: 40px; height: 40px; flex: 0 0 40px; background: var(--gold-gradient); border-radius: 50%;
      display: flex; align-items: center; justify-content: center; color: #061712;
      font-weight: 900; font-family: 'Cinzel', serif; box-shadow: 0 0 16px rgba(245, 158, 11, 0.4);
    }

    .brand-text { min-width: 0; }
    .brand-text h1 { font-family: 'Cinzel', serif; font-size: clamp(0.82rem, 1.6vw, 1.2rem); letter-spacing: 0.06em; line-height: 1.2; background: var(--gold-gradient); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    .brand-text span { display: block; font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-muted); line-height: 1.3; }

    .main-site-btn {
      display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem;
      border-radius: 9999px; background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.4);
      color: var(--gold-light); text-decoration: none; font-weight: 600; font-size: 0.82rem;
      white-space: nowrap; flex-shrink: 0; transition: all 0.3s ease; cursor: pointer;
    }

    .main-site-btn:hover { background: var(--gold-gradient); color: #061712; box-shadow: 0 0 18px rgba(245, 158, 11, 0.45); transform: translateY(-1px); }
    .btn-label-long { display: inline; }
    .btn-label-short { display: none; }

    .container {
      position: relative; z-index: 1; max-width: 1180px; margin: 1.5rem auto 0;
      padding: 0 1.5rem 2.5rem;
      padding-left: max(1rem, env(safe-area-inset-left));
      padding-right: max(1rem, env(safe-area-inset-right));
      padding-bottom: max(2rem, env(safe-area-inset-bottom));
      display: grid;
      grid-template-columns: minmax(0, 1fr) 400px;
      grid-template-areas: "hero side" "story side";
      gap: 1.5rem 1.75rem;
      align-items: start;
    }

    .hero-block { grid-area: hero; }
    .story-block { grid-area: story; }
    .sidebar { grid-area: side; display: flex; flex-direction: column; gap: 1.25rem; position: sticky; top: 1rem; }

    .hero-block,
    .story-block {
      background: rgba(11, 36, 28, 0.85); border: 1px solid rgba(245, 158, 11, 0.2);
      border-radius: 20px; overflow: hidden; box-shadow: 0 12px 35px rgba(0, 0, 0, 0.35);
    }
    .hero-media-wrapper { position: relative; width: 100%; height: 340px; overflow: hidden; }
    .hero-media-wrapper img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
    .hero-media-wrapper:hover img { transform: scale(1.04); }
    .hero-gradient-overlay { position: absolute; inset: 0; background: linear-gradient(0deg, rgba(11, 36, 28, 0.96) 0%, rgba(11, 36, 28, 0.15) 55%); }
    .category-tag { position: absolute; top: 1rem; left: 1rem; background: var(--gold-gradient); color: #061712; font-weight: 800; font-size: 0.68rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 0.35rem 0.85rem; border-radius: 9999px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); z-index: 2; }
    .hero-caption { position: absolute; left: 0; right: 0; bottom: 0; z-index: 2; padding: 1.25rem 1.5rem 1.35rem; }
    .hero-caption .blog-title { font-family: 'Cinzel', serif; font-size: clamp(1.35rem, 2.4vw, 2.1rem); line-height: 1.2; color: #ffffff; margin: 0 0 0.5rem; }
    .hero-caption .author-bar { display: flex; align-items: center; gap: 0.65rem 1rem; margin: 0; padding: 0; border: none; font-size: 0.82rem; color: var(--text-muted); flex-wrap: wrap; }
    .hero-caption .author-bar span strong { color: var(--gold-light); }

    .blog-body { padding: 1.35rem 1.5rem 1.5rem; }
    .article-text { color: #d1d5db; font-size: 1rem; line-height: 1.75; display: flex; flex-direction: column; gap: 1rem; font-family: 'Plus Jakarta Sans', sans-serif; }

    .progress-glass { background: rgba(11, 36, 28, 0.95); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 20px; padding: 1.75rem; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25); }
    .progress-header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 0.5rem; }
    .progress-header h3 { font-family: 'Cinzel', serif; font-size: 1.15rem; color: var(--gold-light); }
    .progress-bar-rail { position: relative; height: 14px; background: rgba(255, 255, 255, 0.08); border-radius: 9999px; overflow: hidden; margin: 0.85rem 0 1.25rem 0; border: 1px solid rgba(255, 255, 255, 0.05); }
    .progress-bar-fill { height: 100%; background: linear-gradient(90deg, #10b981, #f59e0b); border-radius: 9999px; box-shadow: 0 0 12px var(--emerald-accent); transition: width 1s ease;}
    .stats-matrix { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
    .stat-card { background: rgba(6, 23, 18, 0.6); border: 1px solid rgba(245, 158, 11, 0.15); border-radius: 12px; padding: 0.85rem 1rem; }
    .stat-title { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-muted); }
    .stat-amt { font-size: 1.15rem; font-weight: 800; margin-top: 0.2rem; }
    .stat-amt.collected { color: #34d399; }
    .stat-amt.remaining { color: #fbbf24; }

    .tickets-deck-label { font-family: 'Cinzel', serif; font-size: 1rem; color: var(--gold-light); margin-bottom: 0.75rem; display: flex; justify-content: space-between; align-items: center; gap: 8px; flex-wrap: wrap; }
    .deck-subnote { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 0.75rem; color: var(--text-muted); }
    .ticket-list { display: flex; flex-direction: column; gap: 1rem; }
    .ticket-item { position: relative; cursor: pointer; display: block; }
    .ticket-item input[type="checkbox"] { position: absolute; opacity: 0; }
    
    .realistic-ticket { position: relative; background-color: var(--ticket-cream); background-image: radial-gradient(#dcd1ba 0.75px, transparent 0.75px); background-size: 8px 8px; border-radius: 12px; display: flex; height: 105px; box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35); transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1); border: 1px solid #c8b99d; overflow: hidden; }
    .ticket-item:hover .realistic-ticket { transform: translateY(-3px) scale(1.01); box-shadow: 0 8px 24px rgba(245, 158, 11, 0.2); }
    @keyframes goldenPulse {
        0% { box-shadow: 0 0 15px rgba(245, 158, 11, 0.6), 0 0 30px rgba(245, 158, 11, 0.4), inset 0 0 10px rgba(245, 158, 11, 0.3); }
        50% { box-shadow: 0 0 25px rgba(255, 215, 0, 0.8), 0 0 50px rgba(255, 165, 0, 0.6), inset 0 0 20px rgba(245, 158, 11, 0.5); }
        100% { box-shadow: 0 0 15px rgba(245, 158, 11, 0.6), 0 0 30px rgba(245, 158, 11, 0.4), inset 0 0 10px rgba(245, 158, 11, 0.3); }
    }
    .selected-golden-smoke { animation: goldenPulse 2s infinite ease-in-out; border: 2px solid var(--gold-primary) !important; z-index: 40 !important; }
    
    .ticket-stub { width: 85px; border-right: 2px dashed #a89f91; padding: 0.85rem 0.5rem; display: flex; flex-direction: column; justify-content: space-between; align-items: center; position: relative; background: rgba(212, 175, 55, 0.08); }
    .realistic-ticket::before, .realistic-ticket::after { content: ''; position: absolute; left: 80px; width: 14px; height: 14px; background-color: var(--bg-dark); border-radius: 50%; z-index: 2; }
    .realistic-ticket::before { top: -7px; } .realistic-ticket::after { bottom: -7px; }
    .stub-num { font-size: 0.7rem; font-weight: 800; color: #991b1b; letter-spacing: 0.05em; }
    .stub-check-indicator { width: 22px; height: 22px; border-radius: 6px; border: 2px solid #a89f91; display: flex; align-items: center; justify-content: center; background: white; transition: all 0.2s ease; }
    .ticket-item input[type="checkbox"]:checked + .realistic-ticket .stub-check-indicator { background: #059669; border-color: #059669; }
    .stub-check-indicator svg { width: 14px; height: 14px; stroke: white; stroke-width: 3; display: none; }
    .ticket-item input[type="checkbox"]:checked + .realistic-ticket .stub-check-indicator svg { display: block; }
    
    .ticket-main { flex: 1; padding: 0.75rem 1.15rem; display: flex; flex-direction: column; justify-content: space-between; color: #1f2937; }
    .ticket-top-row { display: flex; justify-content: space-between; align-items: flex-start; }
    .mosque-ticket-name { font-family: 'Cinzel', serif; font-size: 0.95rem; font-weight: 800; color: #0d3826; text-transform:uppercase;}
    .ticket-tier-name { font-size: 0.75rem; color: #6b7280; font-weight: 600; text-transform:uppercase;}
    .ticket-price-badge { font-size: 1.15rem; font-weight: 900; color: #0d3826; background: rgba(212, 175, 55, 0.2); padding: 0.2rem 0.6rem; border-radius: 6px; border: 1px solid rgba(212, 175, 55, 0.4); }
    .ticket-signature-row { display: flex; justify-content: space-between; align-items: flex-end; border-top: 1px solid rgba(0, 0, 0, 0.08); padding-top: 0.35rem; }
    .ticket-sign { font-family: 'Reenie Beanie', cursive; font-size: 1.4rem; color: #047857; line-height: 0.8; }
    .ticket-seal { font-size: 0.65rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em; color: #9ca3af; }

    .checkout-card { background: rgba(11, 36, 28, 0.95); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 20px; padding: 1.5rem; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25); }
    .selection-summary { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
    .total-amount { font-size: 1.75rem; font-weight: 900; background: var(--gold-gradient); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    
    .btn-pay-now { width: 100%; background: var(--gold-gradient); color: #061712; border: none; padding: 1.1rem; border-radius: 12px; font-size: 1.05rem; font-weight: 800; letter-spacing: 0.05em; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.6rem; box-shadow: 0 4px 20px rgba(245, 158, 11, 0.35); transition: all 0.3s ease; }
    .btn-pay-now:hover { transform: translateY(-2px); box-shadow: 0 6px 25px rgba(245, 158, 11, 0.5); }

    .organic-input { width:100%; border:1px solid rgba(245, 158, 11, 0.3); padding:12px 14px; border-radius:8px; font-family:inherit; font-size:16px; background:rgba(0,0,0,0.3); color:white; margin-bottom:12px; transition:all 0.2s; }
    .organic-input:focus { outline:none; border-color:var(--emerald-accent); box-shadow:0 0 10px var(--emerald-glow); }
    .organic-input::placeholder { color: #9ca3af; }

    .amount-input {
      font-size: 1.5rem !important;
      font-weight: 800;
      font-family: 'Cinzel', serif;
      color: var(--gold-primary);
    }
    .checkout-radios { display: flex; gap: 12px 16px; margin-bottom: 16px; flex-wrap: wrap; }
    .gateway-row { display: flex; gap: 12px; flex-wrap: wrap; }
    .gateway-row label { flex: 1; min-width: 140px; }

    @media (max-width: 900px) {
      .container {
        grid-template-columns: 1fr;
        grid-template-areas: "hero" "side" "story";
        margin-top: 0.85rem;
        padding: 0 12px 1.5rem;
        padding-bottom: max(1.5rem, env(safe-area-inset-bottom));
        gap: 0.9rem;
      }
      .sidebar { position: static; }
      .hero-media-wrapper { height: 210px; }
      .hero-caption { padding: 0.9rem 1rem 1rem; }
      .hero-caption .blog-title { font-size: 1.35rem; }
      .blog-body { padding: 1rem 1.1rem 1.2rem; }
      .article-text { font-size: 0.95rem; }
      .checkout-card { padding: 1.15rem; border-radius: 16px; }
      .hero-block, .story-block { border-radius: 16px; }
      .btn-pay-now { padding: 1rem; min-height: 48px; font-size: 0.98rem; }
      .selection-summary { flex-direction: column; align-items: flex-start; gap: 10px; }
      .total-amount { font-size: 1.45rem; }
      .realistic-ticket { height: auto; min-height: 96px; }
      .ticket-stub { width: 68px; padding: 0.7rem 0.35rem; }
      .realistic-ticket::before, .realistic-ticket::after { left: 63px; }
      .ticket-main { padding: 0.65rem 0.8rem; min-width: 0; }
      .mosque-ticket-name { font-size: 0.78rem; }
      .ticket-price-badge { font-size: 0.95rem; padding: 0.15rem 0.45rem; }
      .ticket-signature-row { flex-wrap: wrap; gap: 8px; }
      .btn-label-long { display: none; }
      .btn-label-short { display: inline; }
      .brand-emblem { width: 36px; height: 36px; flex-basis: 36px; font-size: 0.85rem; }
      header {
        padding: 0.65rem 0.85rem;
        padding-top: max(0.65rem, env(safe-area-inset-top));
        padding-left: max(0.85rem, env(safe-area-inset-left));
        padding-right: max(0.85rem, env(safe-area-inset-right));
        gap: 0.55rem;
      }
      .main-site-btn { padding: 0.4rem 0.75rem; }
      .hero-media-wrapper:hover img { transform: none; }
      .ticket-item:hover .realistic-ticket { transform: none; }
    }

    @media (max-width: 480px) {
      .hero-media-wrapper { height: 176px; }
      .category-tag { top: 0.7rem; left: 0.7rem; font-size: 0.62rem; padding: 0.28rem 0.7rem; }
      .hero-caption .author-bar { font-size: 0.75rem; gap: 0.4rem 0.7rem; }
      .amount-input { font-size: 1.35rem !important; }
    }
  </style>
</head>
<body>

  <div class="bg-pattern"></div>

  <header>
    <div class="brand-group">
      <div class="brand-emblem">W</div>
      <div class="brand-text">
        <h1><?php echo htmlspecialchars($dynamic_company_name); ?></h1>
        <span>Official Community Welfare Portal</span>
      </div>
    </div>
    <!-- Allow them to bounce back via dynamic web alias -->
    <a href="<?php echo htmlspecialchars($Company_Info->get_compnay_full_web()); ?>" class="main-site-btn">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
      <span class="btn-label-long">Return Back</span>
      <span class="btn-label-short">Back</span>
    </a>
  </header>

  <main class="container">
    
    <article class="hero-block">
      <div class="hero-media-wrapper">
        <span class="category-tag"><?php echo ($have_tickets == 1) ? 'Featured Collection' : 'Active Appeal'; ?></span>
        <img src="../../../<?php echo htmlspecialchars($project_img); ?>" alt="<?php echo htmlspecialchars($project_title); ?>">
        <div class="hero-gradient-overlay"></div>
        <div class="hero-caption">
          <h2 class="blog-title"><?php echo htmlspecialchars($project_title); ?></h2>
          <div class="author-bar">
            <?php if($is_public_flow): ?>
                <span>Organized by <strong>bmjm Committee</strong></span>
                <span>•</span>
                <span>Secure Payment Interface</span>
            <?php else: ?>
                <span>Billing specifically requested for <strong><?php echo !empty($name) ? htmlspecialchars($name) : 'Guest'; ?></strong></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </article>

    <?php if (trim((string)$project_desc) !== ''): ?>
    <section class="story-block">
      <div class="blog-body">
        <div class="article-text">
          <?php echo nl2br(htmlspecialchars($project_desc)); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <aside class="sidebar">
      


      <?php if($is_public_flow && $have_tickets == 1 && !empty($available_tickets)): ?>
      <div>
        <div class="tickets-deck-label">
          <span>Select Available Blocks</span>
          <span class="deck-subnote">Select multiple</span>
        </div>

        <div class="ticket-list">
          <?php 
          $iteration = 0;
          foreach ($available_tickets as $tick) {
              $ticket_id = $tick['id'];
              $ticket_amt = $tick['amount'];
              $qty_left = $tick['total_qty'];
              $stub_num = str_pad($ticket_id, 6, "0", STR_PAD_LEFT);
              $iteration++;
          ?>
          <div class="ticket-item" id="ticket-item-<?php echo $ticket_id; ?>" style="display:flex; justify-content:stretch; position:relative; z-index:1; margin-bottom:12px;">
            <div class="realistic-ticket" id="real-ticket-<?php echo $ticket_id; ?>" style="width:100%; position:relative; z-index:20; background-color:var(--ticket-cream);">
              <div class="ticket-stub">
                <span class="stub-num">#<?php echo $stub_num; ?></span>
                <div class="stub-check-indicator" style="border-radius:50%; background:var(--bg-dark); width:14px; height:14px; border:none;"></div>
                <span style="font-size: 0.55rem; color: #6b7280; text-transform: uppercase;">bmjm REF</span>
              </div>
              <div class="ticket-main">
                <div class="ticket-top-row">
                  <div>
                    <div class="mosque-ticket-name"><?php echo htmlspecialchars($dynamic_company_name); ?></div>
                    <div class="ticket-tier-name">Tier Package // <?php echo $qty_left; ?> Avail</div>
                  </div>
                  <div class="ticket-price-badge">Rs. <?php echo number_format($ticket_amt, 0, '.', ','); ?></div>
                </div>
                
                <div class="ticket-signature-row" style="margin-top:10px; align-items:center;">
                  <div class="ticket-seal">Click to Add:</div>
                  <div class="ticket-qty-control">
                      <button type="button" onclick="flyAndAddTicket(this.closest('.ticket-item'), <?php echo $ticket_id; ?>, <?php echo $ticket_amt; ?>)" style="background:var(--gold-gradient); border:none; border-radius:8px; display:flex; align-items:center; gap:6px; padding:6px 12px; color:#061712; font-weight:800; font-family:'Plus Jakarta Sans', sans-serif; font-size:12px; cursor:pointer; box-shadow:0 4px 10px rgba(245,158,11,0.3); transition:transform 0.1s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                          <span>ADD TICKET</span>
                      </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- Stack Container -->
            <div class="ticket-stack-container" id="stack-container-<?php echo $ticket_id; ?>" style="position:absolute; inset:0; z-index:0; pointer-events:none;"></div>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="checkout-card">
        
        <?php if($is_public_flow): ?>
            <div style="margin-bottom:12px; color:var(--text-light); font-size: 0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em;">Checkout Details</div>
            
            <div class="checkout-radios">
                <label style="color:#d1d5db; font-size: 0.85rem; display:flex; align-items:center; gap:6px; cursor:pointer;">
                    <input type="radio" name="public_is_member" value="1" onchange="toggleMemberFields()"> Official Member
                </label>
                <label style="color:#d1d5db; font-size: 0.85rem; display:flex; align-items:center; gap:6px; cursor:pointer;">
                    <input type="radio" name="public_is_member" value="0" checked onchange="toggleMemberFields()"> Guest Checkout
                </label>
            </div>
            
            <div id="public-member-details" style="display:none; margin-bottom: 20px;">
                <input type="text" id="public_member_no" class="organic-input" placeholder="Member Number (e.g. MH/24/001)">
            </div>
            
            <div id="public-guest-details" style="margin-bottom: 20px;">
                <input type="text" id="public_user_name" class="organic-input" placeholder="Full Name *">
                <input type="text" id="public_user_phone" class="organic-input" placeholder="Phone Number *" style="margin-bottom:0;">
            </div>
        <?php endif; ?>

        <?php if($is_public_flow && $have_tickets == 1): ?>
        <div class="selection-summary">
          <div>
            <div style="font-size: 0.8rem; color: var(--text-muted); display:flex; gap:10px; align-items:center;">
                <span>Selected Packages: <strong id="ticket-count" style="color: white; font-size:1.05rem;">0</strong></span>
                <button type="button" onclick="resetCart()" style="background:transparent; border:1px solid rgba(245,158,11,0.4); color:var(--gold-primary); font-size:10px; padding:3px 8px; border-radius:6px; cursor:pointer; text-transform:uppercase; font-weight:800; letter-spacing:0.05em; transition:all 0.2s;" onmouseover="this.style.background='rgba(245,158,11,0.15)'" onmouseout="this.style.background='transparent'">Reset Cart</button>
            </div>
            <div style="font-size: 0.75rem; color: #9ca3af; margin-top:2px;">All donations are tax-deductible</div>
          </div>
          <div class="total-amount" id="total-price-display" style="transition:all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);">Rs. 0</div>
          <input type="hidden" id="customer-pay-amount" value="0">
        </div>
        <?php else: ?>
        <div style="margin-bottom: 20px;">
            <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom:6px;">Contribute Custom Amount (LKR)</div>
            <input type="number" id="customer-pay-amount" class="organic-input amount-input" value="<?php echo number_format((float)$amount, 2, '.', ''); ?>" step="0.01" min="1">
        </div>
        <?php endif; ?>

        <div id="organic-payload-errors" style="display:none; color:#fb7185; font-size:0.85rem; margin-bottom:12px; font-weight:600;"></div>

        <!-- Payment Gateway Selector -->
        <?php 
        $is_onpay_on = $Company_Info->get_is_onpay_active(); 
        $is_payhere_on = $Company_Info->get_is_payhere_active();
        
        if ($is_onpay_on == 1 && $is_payhere_on == 1): 
        ?>
            <div style="margin-bottom:20px;">
                <div style="color:var(--text-light); font-size: 0.85rem; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin-bottom:12px;">Select Payment Gateway</div>
                <div class="gateway-row">
                    <label style="flex:1; background:rgba(0,0,0,0.3); border:1px solid rgba(245,158,11,0.3); padding:12px; border-radius:8px; cursor:pointer; display:flex; align-items:center; gap:8px; transition:all 0.2s;" onmouseover="this.style.borderColor='var(--emerald-accent)'" onmouseout="this.style.borderColor='rgba(245,158,11,0.3)'">
                        <input type="radio" name="payment_gateway" value="onepay" checked>
                        <span style="font-weight:600; font-size:14px;">OnePay</span>
                    </label>
                    <label style="flex:1; background:rgba(0,0,0,0.3); border:1px solid rgba(245,158,11,0.3); padding:12px; border-radius:8px; cursor:pointer; display:flex; align-items:center; gap:8px; transition:all 0.2s;" onmouseover="this.style.borderColor='var(--emerald-accent)'" onmouseout="this.style.borderColor='rgba(245,158,11,0.3)'">
                        <input type="radio" name="payment_gateway" value="payhere">
                        <span style="font-weight:600; font-size:14px;">PayHere</span>
                    </label>
                </div>
            </div>
        <?php elseif ($is_onpay_on == 1): ?>
            <input type="hidden" name="payment_gateway" value="onepay">
        <?php elseif ($is_payhere_on == 1): ?>
            <input type="hidden" name="payment_gateway" value="payhere">
        <?php endif; ?>

        <!-- System Routing Variables -->
        <?php if ($is_public_flow): ?>
            <form id="pay-form-forwarder" method="POST" action="../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php">
                <input type="hidden" name="ipg_send_by_url_sec_id" id="forward-ipg-sec-id" value="">
                <input type="hidden" name="customer-pay-amount" id="forward-customer-pay-amount" value="">
            </form>
        <?php else: ?>
            <form id="pay-form" method="POST" action="../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php">
                <input type="hidden" name="ipg_send_by_url_sec_id" value="<?php echo htmlspecialchars($raw_id); ?>">
                <input type="hidden" name="customer-pay-amount" id="form-customer-pay-amount" value="">
            </form>
        <?php endif; ?>

        <button class="btn-pay-now" onclick="processPayment()">
          <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
          <span>Complete Secure Donation</span>
        </button>
      </div>

    </aside>

  </main>

  <script>
    var isFixBudget = <?php echo $is_fix_budget; ?>;
    var maxGap = <?php echo $remaining_budget; ?>;
    var isPublicFlow = <?php echo $is_public_flow ? '1' : '0'; ?>;
    var hasTickets = <?php echo $have_tickets; ?>;
    var publicProjectId = "<?php echo addslashes($actual_project_id); ?>";
    var publicProjectName = "<?php echo addslashes($project_title); ?>";

    var selectedTickets = {};

    window.alert = function showCustomAlert(msg) {
        var existing = document.getElementById('bmjm-custom-toast');
        if(existing) existing.remove();
        
        var toast = document.createElement('div');
        toast.id = 'bmjm-custom-toast';
        toast.style.cssText = 'position:fixed; top:24px; right:24px; background:rgba(6,23,18,0.95); backdrop-filter:blur(10px); border-left:4px solid var(--gold-primary); border-radius:8px; padding:16px 20px; box-shadow:0 10px 40px rgba(0,0,0,0.6); display:flex; align-items:flex-start; gap:12px; z-index:10000; transform:translateX(120%); transition:transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease; opacity:0; max-width:350px;';
        
        var icon = document.createElement('div');
        icon.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--gold-primary)" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
        
        var text = document.createElement('p');
        text.style.cssText = 'color:var(--text-light); font-size:0.9rem; margin:0; line-height:1.4; font-weight:500; font-family:"Plus Jakarta Sans", sans-serif;';
        text.innerText = msg;
        
        toast.appendChild(icon);
        toast.appendChild(text);
        document.body.appendChild(toast);
        
        requestAnimationFrame(() => {
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';
        });

        setTimeout(() => {
            if(document.body.contains(toast)) {
                toast.style.transform = 'translateX(120%)';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 400);
            }
        }, 5000);
    };

    function toggleMemberFields() {
        var isMem = document.querySelector('input[name="public_is_member"]:checked').value;
        if(isMem === '1') {
            document.getElementById('public-member-details').style.display = 'block';
            document.getElementById('public-guest-details').style.display = 'none';
        } else {
            document.getElementById('public-member-details').style.display = 'none';
            document.getElementById('public-guest-details').style.display = 'block';
        }
    }

    function resetCart() {
        selectedTickets = {};
        recalculateTotal();
    }

    function flyAndAddTicket(sourceElement, tid, price) {
        var rect = sourceElement.getBoundingClientRect();
        
        var clone = document.createElement('div');
        clone.innerHTML = '<svg width="22" height="22" viewBox="0 0 24 24" fill="var(--gold-light)" stroke="#061712" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="7" fill="none"></circle><path d="M12 9v6" stroke-linecap="round"></path></svg>';
        clone.style.position = 'fixed';
        clone.style.left = (rect.left + rect.width / 2 - 16) + 'px';
        clone.style.top = (rect.top + rect.height / 2 - 16) + 'px';
        clone.style.zIndex = '9999';
        clone.style.background = 'var(--gold-gradient)';
        clone.style.borderRadius = '50%';
        clone.style.padding = '5px';
        clone.style.boxShadow = '0 0 15px var(--gold-primary)';
        clone.style.pointerEvents = 'none';
        document.body.appendChild(clone);
        
        var target = document.getElementById('total-price-display');
        var targetRect = target.getBoundingClientRect();
        var destX = targetRect.left + targetRect.width / 2 - 16;
        var destY = targetRect.top + targetRect.height / 2 - 16;
        
        var animation = clone.animate([
            { transform: 'translate(0, 0) scale(1) rotate(0deg) opacity(1)' },
            { transform: `translate(${(destX - rect.left)*0.3}px, ${(destY - rect.top)*0.3 - 50}px) scale(0.9) rotate(-15deg)`, offset: 0.3 },
            { transform: `translate(${(destX - rect.left)*0.7}px, ${(destY - rect.top)*0.7 + 30}px) scale(0.6) rotate(20deg)`, offset: 0.7 },
            { transform: `translate(${destX - rect.left}px, ${destY - rect.top}px) scale(0.2) rotate(360deg) opacity(0)` }
        ], { duration: 800, easing: 'cubic-bezier(0.25, 1, 0.5, 1)', fill: 'forwards' });
        
        animation.onfinish = function() {
            clone.remove();
            selectedTickets[tid] = { qty: (selectedTickets[tid] ? selectedTickets[tid].qty + 1 : 1), amt: parseFloat(price) };
            recalculateTotal();
            
            target.animate([
                { transform: 'scale(1)', color: 'var(--gold-primary)' },
                { transform: 'scale(1.15)', color: '#10b981' },
                { transform: 'scale(1)' }
            ], { duration: 350 });
        };
    }

    function renderTicketStacks() {
        document.querySelectorAll('.realistic-ticket').forEach(t => t.classList.remove('selected-golden-smoke'));
        document.querySelectorAll('.ticket-stack-container').forEach(c => c.innerHTML = '');
        for (let tid in selectedTickets) {
            let container = document.getElementById('stack-container-' + tid);
            let original = document.getElementById('real-ticket-' + tid);
            if (original) original.classList.add('selected-golden-smoke');
            if (container && original) {
                let qty = selectedTickets[tid].qty;
                for (let i = 1; i < Math.min(qty, 15); i++) {
                    let clone = original.cloneNode(true);
                    clone.removeAttribute('id');
                    clone.style.position = 'absolute';
                    clone.style.top = '0';
                    clone.style.left = '0';
                    clone.style.zIndex = 10 - i;
                    let offsetX = i * 12;
                    let offsetY = i * -3;
                    let rotation = i * 1.5;
                    clone.style.transform = `translate(${offsetX}px, ${offsetY}px) rotate(${rotation}deg)`;
                    clone.style.opacity = Math.max(0.6, 1 - (i * 0.1));
                    clone.style.pointerEvents = 'none';
                    container.appendChild(clone);
                }
            }
        }
    }

    function recalculateTotal() {
      let total = 0;
      let count = 0;
      for(var tid in selectedTickets) {
          total += selectedTickets[tid].qty * selectedTickets[tid].amt;
          count += selectedTickets[tid].qty;
      }
      document.getElementById('ticket-count').innerText = count;
      document.getElementById('total-price-display').innerText = 'Rs. ' + total.toLocaleString();
      document.getElementById('customer-pay-amount').value = total.toFixed(2);
      renderTicketStacks();
    }

    function processPayment() {
        var errDisplay = document.getElementById('organic-payload-errors');
        if(errDisplay) { errDisplay.style.display = 'none'; errDisplay.innerText = ''; }
        
        var finalAmount = parseFloat(document.getElementById("customer-pay-amount").value);
        if (isNaN(finalAmount) || finalAmount <= 0) {
            if(isPublicFlow && hasTickets === 1) {
                alert("Please click and select at least one ticket package to contribute.");
            } else {
                alert("Please enter a valid donation amount.");
            }
            return;
        }
        
        if (isFixBudget === 1 && finalAmount > maxGap) {
            alert("Your entered amount (LKR " + finalAmount + ") exceeds the Project's remaining capacity (LKR " + maxGap + ").");
            return;
        }
        
        var btn = document.querySelector('.btn-pay-now');
        btn.innerHTML = 'Authorizing...';
        btn.style.opacity = '0.8';
        btn.style.pointerEvents = 'none';
        
        if(isPublicFlow) {
            var isMem = document.querySelector('input[name="public_is_member"]:checked').value;
            var payload = new FormData();
            payload.append('project_id', publicProjectId);
            payload.append('project_name', publicProjectName);
            payload.append('amount', finalAmount);
            payload.append('is_member', isMem);
            
            if(isMem === '1') {
                var memNo = document.getElementById('public_member_no').value.trim();
                if(!memNo) { btn.innerHTML = 'Complete Secure Donation'; btn.style.pointerEvents = 'auto'; btn.style.opacity = '1'; alert('Please enter your Membership Number.'); return; }
                payload.append('member_no', memNo);
                payload.append('name', "Member (" + memNo + ")");
            } else {
                var cName = document.getElementById('public_user_name').value.trim();
                var cPhone = document.getElementById('public_user_phone').value.trim();
                if(!cName || !cPhone) { btn.innerHTML = 'Complete Secure Donation'; btn.style.pointerEvents = 'auto'; btn.style.opacity = '1'; alert('Please fill in your Full Name and Phone.'); return; }
                payload.append('name', cName);
                payload.append('phone', cPhone);
            }
            
            if(hasTickets === 1) {
                payload.append('tickets', JSON.stringify(selectedTickets));
            }
            
            var gwElement = document.querySelector('input[name="payment_gateway"]:checked') || document.querySelector('input[name="payment_gateway"][type="hidden"]');
            var gw = gwElement ? gwElement.value : 'onepay';
            
            fetch('Project_IPG_Public_Processor.php', { method: 'POST', body: payload })
            .then(r => r.json())
            .then(res => {
                if(res.error === "0") {
                    document.getElementById('forward-ipg-sec-id').value = res.sec_id;
                    document.getElementById('forward-customer-pay-amount').value = finalAmount;
                    
                    var f = document.getElementById('pay-form-forwarder');
                    if (gw === 'payhere') f.action = "../../View-List/Payment_gateway/PayHere/payment_gatways_process_payhere.php";
                    else f.action = "../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php";
                    
                    f.submit();
                } else {
                    btn.innerHTML = 'Complete Secure Donation'; btn.style.pointerEvents = 'auto'; btn.style.opacity = '1';
                    if(errDisplay){ errDisplay.innerText = res.message; errDisplay.style.display = 'block'; }
                    else alert(res.message);
                }
            }).catch(e => {
                btn.innerHTML = 'Complete Secure Donation'; btn.style.pointerEvents = 'auto'; btn.style.opacity = '1';
                alert('Network error communicating with endpoints.');
            });
            
        } else {
            // CLERK GENERATED LINK
            var gwElement = document.querySelector('input[name="payment_gateway"]:checked') || document.querySelector('input[name="payment_gateway"][type="hidden"]');
            var gw = gwElement ? gwElement.value : 'onepay';
            var f = document.getElementById("pay-form");
            document.getElementById("form-customer-pay-amount").value = finalAmount;
            
            if (gw === 'payhere') f.action = "../../View-List/Payment_gateway/PayHere/payment_gatways_process_payhere.php";
            else f.action = "../../View-List/Payment_gateway/OnePay/payment_gatways_process_one_pay.php";
            
            f.submit();
        }
    }
  </script>
</body>
</html>
