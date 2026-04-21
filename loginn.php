<?php
session_start();
$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

include("connection.php");

// Always generate CAPTCHAs if not set
if (!isset($_SESSION['login_captcha'])) {
    $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
}
if (!isset($_SESSION['signup_captcha'])) {
    $_SESSION['signup_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
}

// Regenerate CAPTCHA via GET
if (isset($_GET['refresh_captcha'])) {
    $type = $_GET['refresh_captcha'];
    if ($type === "login") {
        $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        echo $_SESSION['login_captcha']; exit();
    } elseif ($type === "signup") {
        $_SESSION['signup_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        echo $_SESSION['signup_captcha']; exit();
    }
}

// Handle login AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['useremail']) && !isset($_POST['signup_captcha'])) {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];
    $captcha_input = trim($_POST['login_captcha']);

    // Validate CAPTCHA
    if (!isset($_SESSION['login_captcha']) || strcasecmp($captcha_input, $_SESSION['login_captcha']) !== 0) {
        $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        echo json_encode(['status'=>0, 'message'=>'Invalid CAPTCHA. Please try again.']);
        exit();
    }

    // Validate email/password
    $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
    if ($result->num_rows == 1) {
        $utype = $result->fetch_assoc()['usertype'];
        if ($utype == 'p') {
            $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'p';
                echo json_encode(['status'=>1, 'redirect'=>'patient/index.php']);
                exit();
            } else {
                echo json_encode(['status'=>0, 'message'=>'Invalid email or password.']);
                $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
                exit();
            }
        } elseif ($utype == 'a') {
            $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';
                echo json_encode(['status'=>1, 'redirect'=>'admin/index.php']);
                exit();
            } else {
                echo json_encode(['status'=>0, 'message'=>'Invalid email or password.']);
                $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
                exit();
            }
        } elseif ($utype == 'd') {
            $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'd';
                echo json_encode(['status'=>1, 'redirect'=>'doctor/index.php']);
                exit();
            } else {
                echo json_encode(['status'=>0, 'message'=>'Invalid email or password.']);
                $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
                exit();
            }
        }
    } else {
        echo json_encode(['status'=>0, 'message'=>'No account found with this email.']);
        $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"), 0, 6);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Double Slider Sign in/up Form</title>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css'>
<style>
/* --- All your previous CSS remains unchanged --- */
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
* { box-sizing: border-box; }
body {
    background: #f4faff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
    height: 115vh;     /* same as your original */
    margin: 0;         /* remove negative margin */
    overflow: hidden;  /* prevent page scroll */
}

h1 { font-weight: bold; margin-bottom: 3%; }
h2 { text-align: center; }
p { font-size: 14px; font-weight: 100; line-height: 20px; letter-spacing: 0.5px; margin: 20px 0 30px; }
span { font-size: 12px; }
a { color: #333; font-size: 14px; text-decoration: none; margin: 15px 0; }
button { border-radius: 20px; border: 1px solid #0275d8; background-color: #0275d8; color: #FFFFFF; font-size: 12px; font-weight: bold; padding: 12px 45px; letter-spacing: 1px; text-transform: uppercase; transition: transform 80ms ease-in; cursor: pointer; margin-top: 3%; }
button:active { transform: scale(0.95); }
button:focus { outline: none; }
button.ghost { background-color: transparent; border-color: #FFFFFF; }
form {
    background-color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 50px;
    height: 100%;
    text-align: center;
    overflow: hidden;   /* remove internal scroll */
}

input { background-color: #f4faff; border: 1px solid #0275d8; padding: 12px 15px; margin: 8px 0; width: 100%; border-radius: 8px; }
.captcha-box { display: flex; justify-content: space-between; align-items: center; width: 100%; margin-top: 10px; }
.captcha-code {
    font-size: 22px;       /* half of height, very readable */
    font-weight: 900;      /* boldest text */
    background-color: white;
    border: 1px solid #0275d8;
    padding: 0 1px;        /* small horizontal padding */
    letter-spacing: 7px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.captcha-code img {
    display: block;
    max-width: 100%;
    height: 100%;
    border-radius: 6px;
    border: none;
    box-shadow: none;
}

.container {
    background: white;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    position: relative;
    overflow: hidden;   /* prevent scrolling */
    width: 58%;
    max-width: 100%;
    min-height: 480px;
    height: 70%;    
    margin-bottom: 90px;  /* same as your original percentage */
}

.logo-container { position: absolute; top: 25px; left: 25px; z-index: 200; width: 80px; height: auto; transition: all 0.6s ease; }
.container.right-panel-active .logo-container { left: auto; right: 25px; }
.form-container { position: absolute; top: 0; height: 100%; transition: all 0.6s ease-in-out; }
.sign-in-container { left: 0; width: 50%; z-index: 2; padding: 20px; }
.container.right-panel-active .sign-in-container { transform: translateX(100%); }
.sign-up-container { left: 0; width: 50%; opacity: 0; z-index: 1; }
.container.right-panel-active .sign-up-container { transform: translateX(100%); opacity: 1; z-index: 5; animation: show 0.6s; }
@keyframes show { 0%, 49.99% { opacity: 0; z-index: 1; } 50%, 100% { opacity: 1; z-index: 5; } }
.overlay-container { position: absolute; top: 0; left: 50%; width: 50%; height: 100%; overflow: hidden; transition: transform 0.6s ease-in-out; z-index: 100; }
.container.right-panel-active .overlay-container { transform: translateX(-100%); }
.overlay { background: linear-gradient(to right, #0275d8, #569ff3ff); color: #FFFFFF; position: relative; left: -100%; height: 100%; width: 200%; transform: translateX(0); transition: transform 0.6s ease-in-out; }
.container.right-panel-active .overlay { transform: translateX(50%); }
.overlay-panel { position: absolute; display: flex; align-items: center; justify-content: center; flex-direction: column; padding: 0 40px; text-align: center; top: 0; height: 100%; width: 50%; transform: translateX(0); transition: transform 0.6s ease-in-out; }
.overlay-left { transform: translateX(-20%); }
.container.right-panel-active .overlay-left { transform: translateX(0); }
.overlay-right { right: 0; transform: translateX(0); }
.container.right-panel-active .overlay-right { transform: translateX(20%); }
.sign-up-container h1 { margin-top: 40px; }
@media screen and (max-width: 768px) { .sign-up-container h1 { margin-top: 40px; } }
#step-2 h1 { margin-top: 8px; }
</style>
</head>
<body>
<div class="container" id="container">
    <div class="logo-container">
        <img src="img/Curacare_resize.png" alt="Curacare Logo" id="logo">
    </div>

    <!-- Sign Up Panel -->
    <div class="form-container sign-up-container">
        <form id="signup-form" method="POST" onsubmit="return validatePasswords(); autocomplete="off"">
            <div id="step-1">
                <h1>Create Account</h1>
                <input type="text" name="fname" placeholder="First Name" required />
                <input type="text" name="lname" placeholder="Last Name" required />
                <input type="text" name="address" placeholder="Address" required />
                <input type="date" name="dob" placeholder="Date of Birth" required />
                <input type="email" name="email" placeholder="Email" required autocomplete="off"/>
                <div class="button-container">
                    <button type="reset">Reset</button>
                    <button type="button" id="next-step">Next</button>
                </div>
            </div>

            <div id="step-2" style="display: none;">
                <div style="width:100%; text-align:left; margin-bottom:15px;">
                    <a href="#" id="back-step" style="text-decoration:none; font-size:14px; color:#0275d8; font-weight:bold; display:inline-flex; align-items:center;">
                        <span style="font-size:18px; margin-right:6px;">←</span> Back
                    </a>
                </div>
                <h1>Create Account</h1>
                <input type="tel" name="tele" class="input-text" placeholder="ex: +91 0000000000" pattern="[+][9][1][0-9]{10}" />
                <input type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                <input type="password" name="cpassword" placeholder="Confirm Password" required autocomplete="new-password"  />
                <p id="password-error" style="color: red; font-size: 13px; display: none;">Passwords do not match!</p>

                <div class="captcha-box">
                    <div class="captcha-code" id="signup-captcha">
                        <img id="signup-captcha-img" src="captcha.php?type=signup&rand=<?php echo time(); ?>" alt="CAPTCHA">
                    </div>
                    <a href="#" onclick="refreshCaptcha(event, 'signup')">↻ Refresh</a>
                </div>
                <input type="text" name="signup_captcha" placeholder="Enter CAPTCHA" required />
                <div id="signup-error" style="color:red; margin-top:10px;"></div>

                <div class="button-container">
                    <button type="reset">Reset</button>
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Sign In Panel -->
    <div class="form-container sign-in-container">
        <form id="login-form" method="POST" autocomplete="off">
            <h1>Sign in</h1>
            <input type="email" name="useremail" placeholder="Email" required autocomplete="off"/>
            <input type="password" name="userpassword" placeholder="Password" required autocomplete="new-password" />
            <div class="captcha-box">
                <div class="captcha-code" id="login-captcha">
                    <img id="login-captcha-img" src="captcha.php?type=login&rand=<?php echo time(); ?>" alt="CAPTCHA">
                </div>
                <a href="#" onclick="refreshCaptcha(event, 'login')">↻ Refresh</a>
            </div>
            <input type="text" name="login_captcha" placeholder="Enter CAPTCHA" required />
            <div id="login-error" style="color:red; margin-top:10px;"></div>
            <button type="submit">Sign In</button>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>                
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script>
const container = document.getElementById('container');
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const signupForm = document.getElementById('signup-form');
const loginForm = document.getElementById('login-form');
const passwordError = document.getElementById('password-error');
const signupError = document.getElementById('signup-error');
const loginError = document.getElementById('login-error');

// Show Sign Up panel if register=true in URL
if (window.location.search.includes("register=true")) {
    container.classList.add("right-panel-active");
}

// Reset both forms if logged out
if (window.location.search.includes("loggedout=true")) {
    resetSignupForm();
    resetLoginForm();
    container.classList.remove("right-panel-active");
}

// --- Helper Functions ---
function resetSignupForm() {
    signupForm.reset();
    passwordError.style.display = 'none';
    signupError.innerHTML = '';
    document.getElementById('step-1').style.display = 'block';
    document.getElementById('step-2').style.display = 'none';
    refreshCaptcha(null, 'signup');
}

function resetLoginForm() {
    loginForm.reset();
    loginError.innerHTML = '';
    refreshCaptcha(null, 'login');
}

function validatePasswords() {
    const password = signupForm.querySelector('input[name="password"]').value.trim();
    const cpassword = signupForm.querySelector('input[name="cpassword"]').value.trim();
    if (password !== cpassword) {
        passwordError.style.display = 'block';
        return false;
    } else {
        passwordError.style.display = 'none';
        return true;
    }
}

function refreshCaptcha(e, type) {
    if(e) e.preventDefault();
    const img = document.getElementById(type+'-captcha-img');
    img.src = 'captcha.php?type='+type+'&rand=' + Date.now();
}

// --- Panel Switching ---
signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
    resetSignupForm();
    resetLoginForm();
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
    resetSignupForm();
    resetLoginForm();
});

// Step navigation (Sign Up form)
document.getElementById('next-step').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('step-1').style.display = 'none';
    document.getElementById('step-2').style.display = 'block';
});
document.getElementById('back-step').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('step-2').style.display = 'none';
    document.getElementById('step-1').style.display = 'block';
});

// --- AJAX Sign Up ---
signupForm.addEventListener('submit', function(e){
    e.preventDefault();
    if (!validatePasswords()) return;

    const formData = new FormData(signupForm);
    fetch('submit.php', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.status === 1){
            resetSignupForm();
            resetLoginForm();
            container.classList.remove("right-panel-active");
            window.location.href = data.redirect;
        } else {
            signupError.innerHTML = data.message;
            refreshCaptcha(null, 'signup');
        }
    })
    .catch(err => console.error(err));
});

// --- AJAX Login ---
loginForm.addEventListener('submit', function(e){
    e.preventDefault();

    const formData = new FormData(loginForm);
    fetch('login_submit.php', { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        if(data.status === 1){
            resetSignupForm();
            resetLoginForm();
            container.classList.remove("right-panel-active");
            window.location.href = data.redirect;
        } else {
            loginError.innerHTML = data.message;
            refreshCaptcha(null, 'login');
        }
    })
    .catch(err => console.error(err));
});
</script>
</body>
</html>
