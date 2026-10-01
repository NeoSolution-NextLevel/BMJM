<style>
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<!-- Page Preloader -->
<div id="preloader" style="
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 2000;
    flex-direction: column;
    display: none; /* start hidden */
">
    <div style="
      border: 6px solid #f3f3f3;
      border-top: 6px solid #FFD700;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
      margin-bottom: 20px;
  "></div>
    <span style="color:#fff; font-family:'Inter', sans-serif; font-size:16px;">Loading, please wait...</span>
</div>

<script>
    const preloader = document.getElementById('preloader');

    // Show loader
    function pre_loader_show() {
        preloader.style.display = "flex";
        preloader.style.opacity = "1";
    }

    // Hide loader
    function pre_loader_hide() {
        preloader.style.opacity = "0";
        preloader.style.transition = "opacity 0.5s ease-out";
        setTimeout(() => {
            preloader.style.display = "none";
        }, 500); // matches transition
    }
</script>