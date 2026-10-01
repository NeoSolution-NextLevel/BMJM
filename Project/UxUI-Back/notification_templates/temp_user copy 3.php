<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>bmjm - Create Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Kreon:wght@400;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* ---------------- COMMON STYLES ---------------- */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)),
                  url('./assets/images/mosque.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      position: relative;
    }
    a{
        text-decoration: none;
    }

    /* ---------------- TOP NAVBAR ---------------- */
    .top-navbar {
      position: fixed;
      top: 0; left: 0; width: 100%;
      background: linear-gradient(135deg, #2c3e50, #8d9676);
      color: #fff; padding: 15px 30px;
      display: flex; align-items: center; justify-content: space-between;
      z-index: 1000; backdrop-filter: blur(5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .top-navbar-title { font-weight: bold; font-size: 18px; display: flex; align-items: center; gap: 10px; }
    .top-navbar-icons { display: flex; gap: 25px; font-size: 18px; }
    .top-navbar-icons i { cursor: pointer; transition: all 0.3s; position: relative; }
    .top-navbar-icons i:hover { color: #FFD700 !important; transform: translateY(-2px); }
    .notification-badge {
      position: absolute; top: -8px; right: -8px;
      background: #e74c3c; color: white; border-radius: 50%;
      width: 18px; height: 18px; font-size: 12px;
      display: flex; justify-content: center; align-items: center;
    }

    /* ---------------- CONTAINERS ---------------- */
    .bg-container {
      min-height: calc(100vh - 63px);
      display: flex; justify-content: center; align-items: center;
      padding: 30px 20px;
    }

    /* FORM CARD */
    .form-card {
      width: 600px; max-width: 100%;
      background: rgba(255,255,255,0.95);
      border-radius: 16px; overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.25);
      margin-top: 10vh;
      animation: fadeIn 0.5s ease-out;
    }
    .form-header {
      font-family: 'Kreon', serif;
      background: linear-gradient(135deg, #2c3e50, #8d9676);
      color: #fff; font-weight: bold;
      display: flex; justify-content: space-between; align-items: center;
      padding: 20px; font-size: 22px; position: relative;
    }
    .form-header::after {
      content:""; position: absolute; bottom: 0; left: 0;
      width:100%; height:4px;
      background: linear-gradient(90deg, #FFD700, #FFA500);
    }
    .close-icon {
      cursor: pointer; font-size: 20px; transition: all 0.3s;
      width: 36px; height: 36px; display: flex;
      align-items: center; justify-content: center; border-radius: 50%;
    }
    .close-icon:hover { background: rgba(255,255,255,0.2); transform: rotate(90deg); }

    /* FORM BODY */
    .form-body { padding: 30px; color: #333; }
    .input-group { margin-bottom: 20px; position: relative; }
    .form-body label { display:block; margin-bottom:8px; font-weight:600; color:#2c3e50; font-size:14px; }
    .form-body input {
      width:100%; padding:14px 14px 14px 45px; font-size:16px;
      border-radius:8px; border:2px solid #ddd;
    }
    .form-body input:focus { outline:none; border-color:#4a6572; box-shadow:0 0 0 3px rgba(255,215,0,0.2); }
    .input-icon { position:absolute; left:15px; top:40px; color:#7f8c8d; font-size:18px; }

    /* BUTTONS */
    .buttons-wrapper { display:flex; justify-content:space-between; gap:15px; flex-wrap:wrap; margin-top:30px; }
    .buttons-wrapper button {
      border:none; font-weight:600; cursor:pointer;
      font-family:'Montserrat',sans-serif; border-radius:8px;
      padding:16px; font-size:16px; transition:all 0.3s;
      display:flex; align-items:center; justify-content:center; gap:8px;
    }
    .cancel-btn { flex:1; background:#95a5a6; color:#fff; }
    .cancel-btn:hover { background:#7f8c8d; transform:translateY(-2px); }
    .setup-btn { flex:2; background:linear-gradient(135deg,#2c3e50,#8d9676); color:#fff; }
    .setup-btn:hover { background:linear-gradient(135deg,#8d9676,#2c3e50); transform:translateY(-2px); }

    /* PASSWORD REQS */
    .password-requirements {
      background:#f8f9fa; border-radius:8px; padding:15px; margin-top:20px;
      font-size:14px; border-left:4px solid #4a6572;
    }
    .password-requirements p { margin-bottom:8px; font-weight:600; color:#2c3e50; }
    .password-requirements ul { padding-left:20px; color:#7f8c8d; }
    .password-requirements li { margin-bottom:5px; }

    /* SUCCESS CARD (hidden by default) */
    .success-card {
      display: none;
      width: 500px; max-width: 90%;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 16px; overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.25);
      animation: fadeIn 0.5s ease-out;
      text-align: center;
      margin-top: 10vh;
    }
    .success-header {
      font-family: 'Kreon', serif;
      background: linear-gradient(135deg, #2c3e50, #8d9676);
      color: #fff; font-weight: bold;
      padding: 20px; font-size: 22px; position: relative;
    }
    .success-header::after {
      content:""; position:absolute; bottom:0; left:0; width:100%; height:4px;
      background: linear-gradient(90deg, #FFD700, #FFA500);
    }
    .success-body { padding:40px 30px; color:#2c3e50; }
    .success-body h2 { font-family:'Kreon',serif; font-size:22px; margin-bottom:15px; color:#2c3e50; }
    .success-body p { font-size:16px; color:#7f8c8d; margin-bottom:30px; }
    .close-btn {
      display:inline-flex; align-items:center; gap:10px;
      padding:12px 20px; font-size:16px; font-weight:600;
      font-family:'Montserrat',sans-serif;
      background:linear-gradient(135deg,#2c3e50,#8d9676);
      color:#fff; border-radius:8px; cursor:pointer;
      transition:all 0.3s;
    }
    .close-btn:hover { background:linear-gradient(135deg,#8d9676,#2c3e50); transform:translateY(-2px); }

    @keyframes fadeIn { from {opacity:0; transform:translateY(10px);} to {opacity:1; transform:translateY(0);} }
    
    /* ACCOUNT EXISTS CARD */
.account-exists-card {
  display: none; /* hidden by default */
  width: 500px;
  max-width: 90%;
  background: rgba(255, 255, 255, 0.95);
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 15px 30px rgba(0,0,0,0.25);
  animation: fadeIn 0.5s ease-out;
  text-align: center;
  margin-top: 10vh;
}

  </style>
</head>
<body>
  <!-- Navbar -->
  <div class="top-navbar">
    <div class="top-navbar-title">Welcome To Dashboard</div>
    <div class="top-navbar-icons">
      <i class="fa fa-bell"><span class="notification-badge">3</span></i>
      <i class="fa fa-envelope"><span class="notification-badge">1</span></i>
      <i class="fa fa-sign-out-alt"></i>
    </div>
  </div>

  <!-- Container -->
  <div class="bg-container">
    <!-- Create Account Card -->
    <div class="form-card" id="createAccountCard">
      <div class="form-header">
        <span><i class="fas fa-user-plus"></i> Create User Account</span>
        <span class="close-icon"><i class="fas fa-times"></i></span>
      </div>
      <div class="form-body">
        <div class="input-group">
          <label for="username">Username</label>
          <i class="fas fa-user input-icon"></i>
          <input type="text" id="username" value="ansif@neosolution.l">
        </div>
        <div class="input-group">
          <label for="name">Full Name</label>
          <i class="fas fa-signature input-icon"></i>
          <input type="text" id="name" value="Jhon doe">
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <i class="fas fa-lock input-icon"></i>
          <input type="password" id="password" placeholder="Enter your password">
          <div class="password-strength"><div class="password-strength-bar" id="password-strength-bar"></div></div>
        </div>
        <div class="input-group">
          <label for="repassword">Confirm Password</label>
          <i class="fas fa-lock input-icon"></i>
          <input type="password" id="repassword" placeholder="Re-type your password">
        </div>
        <div class="password-requirements">
          <p>Password must include:</p>
          <ul>
            <li>At least 8 characters</li>
            <li>One uppercase letter</li>
            <li>One number</li>
            <li>One special character</li>
          </ul>
        </div>
        <div class="buttons-wrapper">
          <button class="cancel-btn"><i class="fas fa-times"></i> Cancel</button>
          <button class="setup-btn"><i class="fas fa-user-plus"></i> Set Up My New Account</button>
        </div>
      </div>
    </div>

    <!-- Success Card (hidden initially) -->
    <div class="success-card" id="successCard">
      <div class="success-header"><i class="fas fa-user-check"></i> Account Created</div>
      <div class="success-body">
        <h2><i class="fas fa-check-circle"></i> Account Created!</h2>
        <p>Your account has been successfully created. Welcome aboard!</p>
        <a href="#" class="close-btn" onclick="closeCard()"><i class="fas fa-times"></i> Close</a>
      </div>
    </div>
    
    
    <!-- Account Exists Card (hidden initially) -->
<div class="account-exists-card" id="accountExistsCard" style="display: none;">
  <div class="success-header"><i class="fas fa-exclamation-triangle"></i> Account Already Exists</div>
  <div class="success-body">
    <h2><i class="fas fa-exclamation-circle"></i> Account Already Exists!</h2>
    <p>You already have an account with this email.</p>
    <a href="#" class="close-btn" onclick="closeAccountExistsCard()"><i class="fas fa-arrow-left"></i> Go Back</a>
  </div>
</div>
  </div>
  
  
  
  <!--testing purpose only-->
  <button onclick="showAccountExists()" style="position:fixed; top:100px; right:20px; z-index:1000;">Test Account Exists</button>

  
  
  



  <script>
    const submitBtn = document.querySelector('.setup-btn');
    const closeIcon = document.querySelector('.close-icon');
    const cancelBtn = document.querySelector('.cancel-btn');
    const passwordInput = document.getElementById('password');
    const passwordStrengthBar = document.getElementById('password-strength-bar');

    // Password strength checker
    passwordInput.addEventListener('input', function() {
      const password = passwordInput.value;
      let strength = 0;
      if (password.length >= 8) strength += 25;
      if (/[A-Z]/.test(password)) strength += 25;
      if (/[0-9]/.test(password)) strength += 25;
      if (/[^A-Za-z0-9]/.test(password)) strength += 25;
      passwordStrengthBar.style.width = strength + '%';
      passwordStrengthBar.style.background = strength < 50 ? '#e74c3c' : (strength < 100 ? '#f39c12' : '#2ecc71');
    });

    // Submit
    submitBtn.addEventListener('click', function() {
      const inputs = document.querySelectorAll('.form-body input');
      let allFilled = true;
      inputs.forEach(input => {
        if (input.value.trim() === '') {
          allFilled = false;
          input.style.borderColor = '#e74c3c';
        } else {
          input.style.borderColor = '#ddd';
        }
      });
      const password = document.getElementById('password').value;
      const repassword = document.getElementById('repassword').value;
      if (password !== repassword) {
        alert('Passwords do not match!');
        allFilled = false;
      }
      if (!allFilled) {
        alert('Please fill out all fields correctly before submitting.');
      } else {
        // Hide form card, show success card
        document.getElementById('createAccountCard').style.display = 'none';
        document.getElementById('successCard').style.display = 'block';
      }
    });

    // Cancel & close
    function confirmCancel() {
      if (confirm('Are you sure you want to cancel account creation?')) {
        window.location.href = '#';
      }
    }
    closeIcon.addEventListener('click', confirmCancel);
    cancelBtn.addEventListener('click', confirmCancel);

    function closeCard() {
      window.location.href = "#";
    }
    
    
    
    // Function to close Account Exists card
function closeAccountExistsCard() {
  document.getElementById('accountExistsCard').style.display = 'none';
  document.getElementById('createAccountCard').style.display = 'block';
}

// Example: show the account exists card instead of success card
function showAccountExists() {
  document.getElementById('createAccountCard').style.display = 'none';
  document.getElementById('successCard').style.display = 'none';
  document.getElementById('accountExistsCard').style.display = 'block';
}

  </script>
</body>
</html>
