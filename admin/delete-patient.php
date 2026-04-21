<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"] == "" || $_SESSION['usertype'] != 'a') {
    header("location: ../loginn.php");
    exit();
}

if (isset($_GET["id"])) {
    include("../connection.php");

    $id = intval($_GET["id"]);
    $result = $database->query("SELECT pemail FROM patient WHERE pid=$id");

    if ($result->num_rows == 1) {
        $email = $result->fetch_assoc()["pemail"];
        $database->query("DELETE FROM patient WHERE pemail='$email'");
        $database->query("DELETE FROM webuser WHERE email='$email'");
    }

    header("location: patient.php");
    exit();
}
?>
