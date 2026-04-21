<?php
session_start();

// reset session user vars
$_SESSION["user"] = isset($_SESSION["user"]) ? $_SESSION["user"] : "";
$_SESSION["usertype"] = isset($_SESSION["usertype"]) ? $_SESSION["usertype"] : "";

// timezone and date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

// database connection
include("connection.php");

// default error
$error = '<label for="promter" class="form-label"></label>';

// generate signup captcha if not already
if (!isset($_SESSION['signup_captcha'])) {
    $_SESSION['signup_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
}

// Helper: safe fallback for personal-data session
$fname = $lname = $address = $dob = "";
if (isset($_SESSION['personal']) && is_array($_SESSION['personal'])) {
    $fname = $_SESSION['personal']['fname'] ?? "";
    $lname = $_SESSION['personal']['lname'] ?? "";
    $address = $_SESSION['personal']['address'] ?? "";
    $dob = $_SESSION['personal']['dob'] ?? "";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // take POST values
    $email = trim($_POST['newemail'] ?? "");
    $tele = trim($_POST['tele'] ?? "");
    $newpassword = $_POST['newpassword'] ?? "";
    $cpassword = $_POST['cpassword'] ?? "";
    $captcha_input = trim($_POST['captcha'] ?? "");

    // ✅ Match login.php style CAPTCHA validation
    if ($captcha_input !== ($_SESSION['signup_captcha'] ?? "")) {
        $error = '<label class="form-label" style="color:red;text-align:center;">Invalid CAPTCHA.</label>';
        // regenerate new captcha for next attempt
        $_SESSION['signup_captcha'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 6);
    } elseif (empty($email) || empty($newpassword) || empty($cpassword)) {
        $error = '<label class="form-label" style="color:red;text-align:center;">Please fill all required fields.</label>';
    } elseif ($newpassword !== $cpassword) {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password</label>';
    } else {
        // Check if email already exists
        $sqlmain = "SELECT * FROM webuser WHERE email = ?";
        if ($stmt = $database->prepare($sqlmain)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $res->num_rows == 1) {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
                $stmt->close();
            } else {
                $stmt->close();

                $pname = trim($fname . " " . $lname);
                $insertPatient = "INSERT INTO patient (pemail, pname, ppassword, paddress, pdob, ptel) VALUES (?, ?, ?, ?, ?, ?)";
                $insertWebuser = "INSERT INTO webuser (email, usertype) VALUES (?, 'p')";

                $db_ok = true;
                if ($ps = $database->prepare($insertPatient)) {
                    $ps->bind_param("ssssss", $email, $pname, $newpassword, $address, $dob, $tele);
                    if (!$ps->execute()) $db_ok = false;
                    $ps->close();
                } else {
                    $db_ok = false;
                }

                if ($db_ok) {
                    if ($ws = $database->prepare($insertWebuser)) {
                        $ws->bind_param("s", $email);
                        if (!$ws->execute()) $db_ok = false;
                        $ws->close();
                    } else {
                        $db_ok = false;
                    }
                }

                if ($db_ok) {
                    $_SESSION["user"] = $email;
                    $_SESSION["usertype"] = "p";
                    $_SESSION["username"] = $fname;
                    unset($_SESSION['signup_captcha']);
                    header('Location: patient/index.php');
                    exit();
                } else {
                    $error = '<label class="form-label" style="color:red;text-align:center;">Database error while creating account. Try again.</label>';
                }
            }
        } else {
            $error = '<label class="form-label" style="color:red;text-align:center;">Database error. Try again later.</label>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">   
    <title>Create Account</title>
    <style>
        .container {
            animation: transitionIn-X 0.5s;
        }
        .captcha-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-top: 10px;
        }
        .captcha-code {
            background: #eaeaea;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 20px;
            letter-spacing: 3px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">It's Okey, Now Create User Account.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="newemail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </td>               
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tele" class="form-label">Mobile Number: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="tel" name="tele" class="input-text"  placeholder="ex: +91 0000000000" pattern="[+][9][1][0-9]{10}" >
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="newpassword" class="form-label">Create New Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="cpassword" class="form-label">Confirm Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required>
                </td>
            </tr>

            <!-- ✅ CAPTCHA same style as login -->
            <tr>
                <td colspan="2">
                    <div class="captcha-box">
                        <div class="captcha-code" id="signup-captcha"><?php echo $_SESSION['signup_captcha']; ?></div>
                        <a href="#" onclick="refreshCaptcha(event, 'signup')">↻ Refresh</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="text" name="captcha" class="input-text" placeholder="Enter CAPTCHA" required>
                </td>
            </tr>

            <tr> 
                <td colspan="2">
                    <?php echo $error ?>
                </td>
            </tr> 
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="loginn.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>
                </form>
            </tr>
        </table>
    </div>
    </center>

<script>
// ✅ Refresh Captcha like login.php
function refreshCaptcha(e, type) {
    e.preventDefault();
    fetch(`loginn.php?refresh_captcha=${type}`)
        .then(response => response.text())
        .then(data => {
            if (type === "signup") {
                document.getElementById("signup-captcha").textContent = data;
            }
        });
}
</script>
</body>
</html>
