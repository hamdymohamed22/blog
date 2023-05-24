<?php
// session_start();
if (!empty($_SESSION["errors"])) {
    foreach ($_SESSION["errors"] as $error) {
        echo "<div class='alert alert-danger'>$error </div>";
        unset($_SESSION["errors"]);
    }
} elseif (isset($_SESSION["success"])) {
    foreach ($_SESSION["success"] as $success) {
        echo "<div class='alert alert-success'>$success </div>";
        unset($_SESSION["success"]);
    }
}
?>