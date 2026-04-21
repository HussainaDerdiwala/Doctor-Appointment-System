<?php
session_start();
include("connection.php");

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

// Prepare default response
$response = ['status' => 0, 'message' => 'Invalid request'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = trim($_POST["fname"] ?? "");
    $lname = trim($_POST["lname"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $dob = trim($_POST["dob"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $tele = trim($_POST["tele"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $cpassword = trim($_POST["cpassword"] ?? "");
    $captcha_input = trim($_POST['signup_captcha'] ?? "");

    $pname = $fname . ' ' . $lname;

    // Validate CAPTCHA
    if (!isset($_SESSION['signup_captcha']) || strcasecmp($captcha_input, $_SESSION['signup_captcha']) !== 0) {
        $_SESSION['signup_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
        $response['message'] = 'Invalid CAPTCHA. Please try again.';
    }
    // Validate required fields
    elseif (empty($fname) || empty($lname) || empty($address) || empty($dob) || empty($email) || empty($password) || empty($cpassword)) {
        $response['message'] = 'All fields are required.';
    }
    // Check password match
    elseif ($password !== $cpassword) {
        $response['message'] = 'Passwords do not match.';
    } else {
        // Check if email already exists
        $checkEmail = $database->prepare("SELECT email FROM webuser WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            $response['message'] = 'Email is already registered.';
        } else {
            // Insert into webuser
            $usertype = 'p';
            $insertWebUser = $database->prepare("INSERT INTO webuser (email, usertype) VALUES (?, ?)");
            $insertWebUser->bind_param("ss", $email, $usertype);
            $insertWebUser->execute();

            // Insert into patient
            $insertPatient = $database->prepare("INSERT INTO patient (pemail, ppassword, pname, pdob, paddress, ptel) VALUES (?, ?, ?, ?, ?, ?)");
            $insertPatient->bind_param("ssssss", $email, $password, $pname, $dob, $address, $tele);
            $insertPatient->execute();

            // Auto-login
            $_SESSION["user"] = $email;
            $_SESSION["usertype"] = "p";

            unset($_SESSION['signup_captcha']); // clear captcha

            // ✅ Successful response
            $response['status'] = 1;
            $response['message'] = 'Sign-up successful!';
            $response['redirect'] = 'patient/index.php';
        }
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
