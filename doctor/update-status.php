<?php
include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $status = $_POST["status"];

    $stmt = $database->prepare("UPDATE appointment SET status=? WHERE appoid=?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        header("Location:appointment.php");
        exit();
    } else {
        echo "Error updating status";
    }
}
?>
