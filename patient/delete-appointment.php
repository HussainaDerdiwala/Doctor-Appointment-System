<?php
include("../connection.php");
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // ✅ delete appointment safely using prepared statement
    $sql = "DELETE FROM appointment WHERE appoid=?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // ✅ after deleting, redirect back with success flag
        header("Location: appointment.php?action=cancel-success&id=".$id);
        exit();
    } else {
        // ❌ fallback if something went wrong
        header("Location: appointment.php?action=cancel-failed");
        exit();
    }
} else {
    // ❌ if accessed directly without id
    header("Location: appointment.php");
    exit();
}
?>
