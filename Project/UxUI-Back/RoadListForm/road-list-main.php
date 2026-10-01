<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php include_once './imports/need/session_setup.php'; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Kreon:wght@400;700&family=Open+Sans:wght@400;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .background {
        font-family: 'Open Sans', sans-serif;
        background: linear-gradient(135deg, rgba(141, 150, 118, 0.1) 0%, rgba(213, 188, 117, 0.05) 100%);
        min-height: 100vh;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    /* Subtle Islamic geometric pattern */
    .background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 20% 80%, rgba(141, 150, 118, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(141, 150, 118, 0.03) 0%, transparent 50%);
        background-size: 60px 60px;
        z-index: 0;
    }

    .container {
        font-family: 'Open Sans', sans-serif;
        max-width: 600px;
        width: 90%;
        margin: 10vh auto;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        background: white;
        position: relative;
        z-index: 1;
    }

    .header {
        background: linear-gradient(135deg, #8d9676 0%, #7a8365 100%);
        color: white;
        padding: 24px 20px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .header h2 {
        margin: 0;
        font-size: 1.8em;
        font-family: 'Kreon', serif;
        font-weight: 600;
        text-align: center;
        width: 100%;
        letter-spacing: 0.5px;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
        font-size: 1em;
        cursor: pointer;
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.2s ease;
        padding: 8px 16px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 1;
        text-decoration: none;
        font-weight: 500;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .search-container {
        padding: 20px;
        background-color: #f8f9fa;
        display: flex;
        gap: 10px;
        position: relative;
        border-bottom: 1px solid #e9ecef;
    }

    .search-box {
        padding: 12px 45px 12px 16px;
        width: 100%;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        font-size: 0.95em;
        transition: all 0.2s ease;
        background-color: white;
        font-family: 'Open Sans', sans-serif;
    }

    .search-box:focus {
        outline: none;
        border-color: #8d9676;
        box-shadow: 0 0 0 3px rgba(141, 150, 118, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 35px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1em;
        pointer-events: none;
    }

    .road-list {
        margin: 0;
        padding: 0;
        list-style: none;
        max-height: 500px;
        overflow-y: auto;
    }

    .road-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border-bottom: 1px solid #f8f9fa;
        background-color: white;
        transition: background-color 0.2s ease;
    }

    .road-item:hover {
        background-color: #f8f9fa;
    }

    .road-item:last-child {
        border-bottom: none;
    }

    .road-name {
        font-family: 'Kreon', serif;
        font-size: 1.1em;
        color: #2c3e50;
        font-weight: 500;
    }

    .select-btn {
        font-family: 'Open Sans', sans-serif;
        padding: 8px 20px;
        background-color: #8d9676;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
        font-size: 0.9em;
    }

    .select-btn:hover {
        background-color: #7a8365;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    /* Professional scrollbar */
    .road-list::-webkit-scrollbar {
        width: 6px;
    }

    .road-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .road-list::-webkit-scrollbar-thumb {
        background: #8d9676;
        border-radius: 3px;
    }

    .road-list::-webkit-scrollbar-thumb:hover {
        background: #7a8365;
    }

    /* Empty state styling */
    .empty-state {
        padding: 40px 20px;
        text-align: center;
        color: #6c757d;
        font-style: italic;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .container {
            width: 95%;
        }
    }

    @media (max-width: 768px) {
        .container {
            width: 100%;
            margin: 5vh auto;
        }

        .header h2 {
            font-size: 1.5em;
        }

        .search-container {
            padding: 16px;
        }

        .road-item {
            padding: 14px 16px;
        }
    }

    @media (max-width: 480px) {
        .background {
            padding: 10px;
        }

        .container {
            width: 100%;
            margin: 0;
            border-radius: 8px;
        }

        .header {
            padding: 20px 16px;
        }

        .header h2 {
            font-size: 1.3em;
        }

        .back-btn {
            left: 16px;
            padding: 6px 12px;
            font-size: 0.9em;
        }

        .search-container {
            padding: 12px 16px;
        }

        .search-box {
            padding: 10px 40px 10px 12px;
        }

        .search-icon {
            right: 30px;
        }

        .road-name {
            font-size: 1em;
        }

        .select-btn {
            padding: 6px 16px;
            font-size: 0.85em;
        }
    }
</style>

<div class="background">
    <input type="hidden" id="road_list_main_member_type">
    <div class="container">
        <div class="header">
            <a href="<?php echo $pth; ?>index<?php echo $online_offline_extention; ?>" class="back-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2>Select Your Street</h2>
        </div>
        <div class="search-container">
            <input type="text" class="search-box" placeholder="Search streets...">
            <i class="fas fa-search search-icon"></i>
        </div>
        <ul class="road-list" id="front_member_road_data_bodydata_body_1">
            <!-- Dynamic content will be inserted here -->
            <!--            <li class="road-item">
                <span class="road-name">Main Street</span>
                <a href="< ?php echo $pth; ?>member-form< ?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Oak Avenue</span>
                <a href="< ?php echo $pth; ?>member-form< ?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Maple Road</span>
                <a href="< ?php echo $pth; ?>member-form< ?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Pine Street</span>
                <a href="< ?php echo $pth; ?>member-form< ?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Cedar Lane</span>
                <a href="< ?php echo $pth; ?>member-form< ?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>
            <li class="road-item">
                <span class="road-name">Elm Street</span>
                <a href="< ?php echo $pth; ?>member-form< ?php echo $online_offline_extention; ?>" class="select-btn">Select</a>
            </li>-->
        </ul>
    </div>
</div>

<script>
    // Simple search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchBox = document.querySelector('.search-box');
        const roadItems = document.querySelectorAll('.road-item');

        searchBox.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            roadItems.forEach(item => {
                const roadName = item.querySelector('.road-name').textContent.toLowerCase();
                if (roadName.includes(searchTerm)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });


        // Get ?type= parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const memberType = urlParams.get('type'); // example: "old" or "new"

        // Set that value into the input field
        document.getElementById("road_list_main_member_type").value = memberType ? memberType : "";
    });
</script>