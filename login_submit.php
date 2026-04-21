<?php
session_start();
include("connection.php");

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo json_encode(['status'=>0,'message'=>'Invalid request.']);
    exit();
}

$email = trim($_POST['useremail'] ?? '');
$password = trim($_POST['userpassword'] ?? '');
$captcha_input = trim($_POST['login_captcha'] ?? '');

// CAPTCHA check
if (!isset($_SESSION['login_captcha']) || strcasecmp($captcha_input, $_SESSION['login_captcha']) !== 0) {
    // regenerate a new captcha for next attempt
    $_SESSION['login_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghijklmnopqrstuvwxyz"),0,6);
    echo json_encode(['status'=>0,'message'=>'Invalid CAPTCHA.']);
    exit();
}

// ✅ Clear captcha on correct entry so it won't block future login
unset($_SESSION['login_captcha']);

// Check email exists
$result = $database->query("SELECT * FROM webuser WHERE email='$email'");
if ($result->num_rows == 0) {
    echo json_encode(['status'=>0,'message'=>'No account found with this email.']);
    exit();
}

$utype = $result->fetch_assoc()['usertype'];

if ($utype == 'p') {
    $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
    if ($checker->num_rows == 1) {
        $_SESSION['user'] = $email;
        $_SESSION['usertype'] = 'p';
        echo json_encode(['status'=>1,'redirect'=>'patient/index.php']);
    } else {
        echo json_encode(['status'=>0,'message'=>'Invalid email or password.']);
    }
} elseif ($utype == 'a') {
    $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
    if ($checker->num_rows == 1) {
        $_SESSION['user'] = $email;
        $_SESSION['usertype'] = 'a';
        echo json_encode(['status'=>1,'redirect'=>'admin/index.php']);
    } else {
        echo json_encode(['status'=>0,'message'=>'Invalid email or password.']);
    }
} elseif ($utype == 'd') {
    $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
    if ($checker->num_rows == 1) {
        $_SESSION['user'] = $email;
        $_SESSION['usertype'] = 'd';
        echo json_encode(['status'=>1,'redirect'=>'doctor/index.php']);
    } else {
        echo json_encode(['status'=>0,'message'=>'Invalid email or password.']);
    }
} else {
    echo json_encode(['status'=>0,'message'=>'Invalid user type.']);
}
exit();
?>
