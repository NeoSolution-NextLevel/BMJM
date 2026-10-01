 <script>
     var currentYearEl = document.getElementById('current-year');
     if (currentYearEl) currentYearEl.textContent = new Date().getFullYear();

     function customizeError(
         title = 'Operation Failed',
         subtitle = 'An error occurred while processing your request',
         message = 'The operation could not be completed. Please try again.',
         errorCode = 'ERR-500',
         errorDetails = 'Internal server error. The request could not be processed.',
         retryText = 'Try Again',
         backText = 'Go Back',
         retryUrl = '#',
         backUrl = 'javascript:history.back()'
     ) {
         var titleEl = document.getElementById('error-title');
         var subtitleEl = document.getElementById('error-subtitle');
         var messageEl = document.getElementById('error-message');
         var codeEl = document.getElementById('error-code-value');
         var detailsEl = document.getElementById('error-details-content');
         var retryTextEl = document.getElementById('retry-text');
         var backTextEl = document.getElementById('back-text');

         if (titleEl) titleEl.textContent = title;
         if (subtitleEl) subtitleEl.textContent = subtitle;
         if (messageEl) messageEl.textContent = message;
         if (codeEl) codeEl.textContent = errorCode;
         if (detailsEl) detailsEl.textContent = errorDetails;
         if (retryTextEl) retryTextEl.textContent = retryText;
         if (backTextEl) backTextEl.textContent = backText;

         var retryBtn = document.getElementById('retry-btn');
         var backBtn = document.getElementById('back-btn');
         if (retryBtn) retryBtn.onclick = () => {
             if (retryUrl === '#') {
                 window.location.reload();
             } else {
                 window.location.href = retryUrl;
             }
         };

         if (backBtn) backBtn.onclick = () => {
             if (backUrl === 'javascript:history.back()') {
                 history.back();
             } else {
                 window.location.href = backUrl;
             }
         };

         typewriterEffect(message, 'error-message', 30);
     }

     function typewriterEffect(text, elementId, speed = 50) {
         const element = document.getElementById(elementId);
         if (!element) return;
         let i = 0;

         function typeWriter() {
             if (i < text.length) {
                 element.innerHTML += text.charAt(i);
                 i++;
                 setTimeout(typeWriter, speed);
             }
         }

         element.innerHTML = '';
         setTimeout(() => typeWriter(), 500);
     }

     function formatErrorTitle(errorType) {
         return String(errorType || 'Unknown Error')
             .replace(/[-_]+/g, ' ')
             .replace(/\s+/g, ' ')
             .trim()
             .replace(/\b\w/g, function(letter) {
                 return letter.toUpperCase();
             });
     }

     document.addEventListener('DOMContentLoaded', function() {
         const params = new URLSearchParams(window.location.search);
         const errorType = params.get("error");
         if (errorType === "Service-Error") {

             // Server Error
             customizeError(
                 'Server Error',
                 'Internal server problem',
                 'The server encountered an unexpected condition. Our team has been notified.',
                 'ERR-503',
                 'Database connection timeout. Could not establish connection to the primary database server.',
                 'Retry Connection',
                 'Return Home',
                 '#',
                 '<?php echo $home_page ?>'
             );

         } else if (errorType === "Password-Mismatched") {

             // Validation Error
             customizeError(
                 'Password Mismatch',
                 'Passwords do not match',
                 'The password and confirm password fields must be identical. Please re-enter both passwords and try again.',
                 'ERR-422',
                 'Password and confirm password values are different.',
                 'Fix Password',
                 'Go to Register',
                 '<?php echo $home_page ?>Registration.php',
                 '<?php echo $home_page ?>Registration.php'
             );


         } else if (errorType === "email-already-exist") {
             customizeError(
                 'Email Already Exists',
                 'Email already exists',
                 'The email address you entered is already associated with an existing account. Please use a different email address or try logging in.',
                 'ERR-409',
                 'Duplicate email detected in the system.',
                 'Use Different Email',
                 'Go to Login',
                 '<?php echo $home_page ?>Registration.php',
                 '<?php echo $home_page ?>Login.php'
             );


         } else if (errorType === "Username-Incorrect") {
             customizeError(
                 'Login Failed',
                 'Incorrect email address',
                 'The email address you entered does not match any account. Please check your email and try again.',
                 'ERR-401',
                 'No user account found with the provided email.',
                 'Retry Login',
                 'Go to Login',
                 '#',
                 '<?php echo $home_page ?>Login.php'
             );
         } else if (errorType === "Password-Incorrect") {
             customizeError(
                 'Login Failed',
                 'Incorrect password',
                 'The password you entered is incorrect. Please check your password and try again.',
                 'ERR-401',
                 'Password verification failed for the given account.',
                 'Retry Login',
                 'Go to Login',
                 '#',
                 '<?php echo $home_page ?>Login.php'
             );
         } else if (errorType === "Empty-Data-Registration") {
             customizeError(
                 'No Account Types Available',
                 'Nothing to display',
                 'No records were found for your request. Please try again later or contact the administrator if the problem persists.',
                 'ERR-204',
                 'The server returned an empty data set.',
                 'Go Back',
                 'Return Home',
                 'javascript:history.back()',
                 '<?php echo $home_page ?>'
             );
         } else if (errorType === "Temporary-Lock") {

             customizeError(
                 'Account Temporarily Locked',
                 'Too Many Failed Authentication Attempts',
                 'Your account has been temporarily locked due to multiple failed authentication attempts. Please contact the system administrator to unlock your account. Admin Email: <?php echo $company_obj->get_compnay_default_sending_email() ?> Admin Phone: <?php echo $company_obj->get_compnay_phone() ?>',
                 'ERR-ACCOUNT-LOCK-403',
                 'Account temporarily locked for security reasons.',
                 'Contact Admin',
                 'Back to Login',
                 'javascript:history.back()',
                 '<?php echo $home_page ?>Login.php'
             );



         } else if (errorType === "Authentication-Error") {
             customizeError(
                 'Google Authentication Failed',
                 'Verification code error',
                 'The authentication code you entered is invalid or has expired. Please check the code from your Google Authenticator app and try again.',
                 'ERR-GAUTH-401',
                 'Google Authenticator verification failed.',
                 'Retry Verification',
                 'Back to Login',
                 'javascript:history.back()',
                 '<?php echo $home_page ?>Login.php'
             );
         } else if (errorType === "Re-Login-Required") {

             customizeError(
                 'Session Expired',
                 'Re-login required',
                 'Your session has expired or you have been logged out for security reasons. Please log in again to continue.',
                 'ERR-401',
                 'User session is invalid or expired.',
                 'Login Again',
                 'Go to Login',
                 '#',
                 '<?php echo $home_page ?>Login.php'
             );

         } else if (errorType) {
             customizeError(
                 formatErrorTitle(errorType),
                 'Action Failed',
                 'Something went wrong while processing your request. Please try again.',
                 'ERR-RETRY',
                 'The requested operation could not be completed at this time.',
                 'Retry',
                 'Try Again',
                 '#',
                 'javascript:location.reload();'
             );


         } else {

             // Default / Unknown error
             customizeError(
                 'Server Error',
                 'Something went wrong',
                 'An unexpected error occurred.',
                 'ERR-000',
                 'No additional details available.',
                 'Go Back',
                 'Home',
                 'javascript:history.back()',
                 '<?php echo $home_page ?>Login.php'
             );
         }

     });
 </script>
