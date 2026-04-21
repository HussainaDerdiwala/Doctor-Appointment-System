<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Curacare Chatbot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/patient.css">
    <link rel="stylesheet" href="../css/chatbot.css">
    <style>
        .dash-body {
            background-image: url("../img/background.png");
        }
    </style>

       <?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../loginn.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../loginn.php");
    }
    $page = 'chatbot'; 

    //import database
    include("../connection.php");
    $sqlmain= "select * from patient where pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pname"];
 
    $sqlmain= "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where  patient.pid=$userid ";

    if($_POST){
        if(!empty($_POST["sheduledate"])){
            $sheduledate=$_POST["sheduledate"];
            $sqlmain.=" and schedule.scheduledate='$sheduledate' ";
        };
    }

    $sqlmain.="order by appointment.appodate  asc";
    $result= $database->query($sqlmain);
    ?>
</head>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const icon = document.getElementById("chatbotIcon");
    const menuBtn = document.getElementById("chatbotMenuBtn");

    if (!icon || !menuBtn) return;

    const defaultIcon = "../img/icons/chatbot.svg";
    const hoverIcon = "../img/icons/download.svg";

    const isActive = menuBtn.classList.contains("menu-active");

    if (isActive) {
      icon.src = hoverIcon;
    } else {
      menuBtn.addEventListener("mouseenter", () => {
        icon.src = hoverIcon;
      });
      menuBtn.addEventListener("mouseleave", () => {
        icon.src = defaultIcon;
      });
    }
  });
</script>


<body>
    
    <div class="container">
    <div class="menu">
        <table class="menu-container" border="0" >
            <tr>
                <td style="padding:10px" colspan="2">
                    <table border="0" class="profile-container">
                        <tr>
                            <td width="30%" style="padding-left:20px" >
                                <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                            </td>
                            <td style="padding:0px;margin:0px;">
                                <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-home">
                    <a href="index.php" class="non-style-link-menu"><div><p class="menu-text">Home</p></a></div>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-doctor">
                    <a href="doctors.php" class="non-style-link-menu"><div><p class="menu-text">All Doctors</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-session">
                    <a href="schedule.php" class="non-style-link-menu"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-appoinment">
                    <a href="appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-settings">
                    <a href="settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                </td>
            </tr>
            <tr class="menu-row">
              <td class="menu-btn <?php if($page == 'chatbot') echo 'menu-active'; ?>" id="chatbotMenuBtn">
                <a href="chatbot.php" class="non-style-link-menu">
                  <div style="display: flex; align-items: center;">
                    <img
                      src="../img/icons/chatbot.svg"
                      alt="Chatbot"
                      class="chatbot-icon"
                      id="chatbotIcon"
                      style="margin-left: 26%; margin-right: 2%; height: 28px; width:30px;"
                    >
                    <p class="menu-text" style="padding-left: 3%; font-weight: 500; font-size: 16px;">Chatbot</p>
                  </div>
                </a>
              </td>
            </tr>
        </table>
    </div>
<div class="dash-body">
    <div style="display: flex; align-items: center; justify-content: center; margin-top: 4%; margin-bottom: 2%;">
        <img src="../img/Curacare_resize.png" alt="Curacare Logo" style="height: 50px;">
        <h2 style="margin: 0 0 0 10px; color:#203354;">Curacare Chatbot</h2>
    </div>


    <div class="chatbot-box">
        <div class="chatbot-header animated-header">
            <img src="../img/icons/chatbot.svg" alt="Chatbot Icon">
            <h3>Ask the bot !!</h3>
        </div>
        <div class="chatbot-message">
            <p>Hello! How can I help you today?</p>
        </div>

        <div class="chatbot-options">
            <div class="button-grid">
                <div class="button-column">
                    <!-- Doctor related -->
                    <button onclick="sendAction('doctor')">Who is the best orthopedic doctor?</button>
                    <button onclick="sendAction('availability')">I have stone in liver to whom should I consult?</button>
                    <button onclick="sendAction('services')">Know About Services</button>
                    <button onclick="sendAction('support')">Contact Support</button>
                    <button onclick="sendAction('doctor_heart')">Which doctor should I consult for heart problems?</button>
                    <button onclick="sendAction('doctor_skin')">Which doctor should I consult for skin issues?</button>
                    <button onclick="sendAction('doctor_diabetes')">Who should I consult for diabetes?</button>
                    <button onclick="sendAction('doctor_online')">Are online consultations available?</button>
                    <button onclick="sendAction('doctor_best')">How to find the best doctor?</button>
                    <button onclick="sendAction('doctor_kidney')">Which doctor for kidney problems?</button>
                    <button onclick="sendAction('doctor_eye')">Which doctor for eye problems?</button>
                    <button onclick="sendAction('doctor_pregnancy')">Who should I consult for pregnancy?</button>
                    <button onclick="sendAction('doctor_cancer')">Which doctor for cancer treatment?</button>
                    <button onclick="sendAction('doctor_ent')">Which doctor for ear, nose, throat problems?</button>
                    <button onclick="sendAction('rooms')">What room facilities are available?</button>
                </div>
                <div class="button-column">
                    <!-- Disease + hospital related -->
                    <button onclick="sendAction('ortho')">Orthopedic doctor suggestion?</button>
                    <button onclick="sendAction('liver')">Liver stone consultation?</button>
                    <button onclick="sendAction('emergency')">What to do in emergency?</button>
                    <button onclick="sendAction('timing')">Hospital timings?</button>
                    <button onclick="sendAction('fever')">What should I do if I have a fever?</button>
                    <button onclick="sendAction('headache')">How to handle frequent headaches?</button>
                    <button onclick="sendAction('stomach_pain')">Which doctor should I see for stomach pain?</button>
                    <button onclick="sendAction('breathing')">What if I face difficulty in breathing?</button>
                    <button onclick="sendAction('diabetes')">Tips for managing diabetes?</button>
                    <button onclick="sendAction('chest_pain')">What should I do if I feel chest pain?</button>
                    <button onclick="sendAction('eye_problem')">What to do for eye problems?</button>
                    <button onclick="sendAction('pregnancy')">What should I do during pregnancy?</button>
                    <button onclick="sendAction('cancer')">What to do if diagnosed with cancer?</button>
                    <button onclick="sendAction('allergy')">What to do in case of allergies?</button>
                    <button onclick="sendAction('insurance')">Do you accept health insurance?</button>
                   
                </div>
            </div>
        </div>

        <div id="response-box" class="response-box">
            <img src="../img/icons/chatbot.svg" alt="Bot" class="avatar">
            <span  style="font-family: Arial, sans-serif; margin-top:12px;   font-weight: bold;">&nbsp;&nbsp;Waiting for your question...</span>
        </div>
    </div>
</div>

<script>
function sendAction(action) {
    const box = document.getElementById("response-box");

    // Show typing with avatar left-aligned
    box.innerHTML = `
        <div class="typing-wrapper">
            <img src="../img/icons/chatbot.svg" alt="Bot" class="avatar">
            <div class="typing-indicator">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    `;
    box.style.display = "block";

    fetch('chatbot_response.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'action=' + encodeURIComponent(action)
    })
    .then(response => response.text())
    .then(data => {
        setTimeout(() => {
            box.innerHTML = `
                <div style="display: flex; align-items: flex-start; gap: 10px;">
                    <img src="../img/icons/chatbot.svg" alt="Bot" class="avatar">
                    <div class="bubble">${data}</div>
                </div>
            `;
            box.scrollIntoView({ behavior: "smooth", block: "start" });
        }, 1000); // 1 second delay for typing effect
    })
    .catch(error => {
        box.innerHTML = "Oops! Something went wrong.";
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
