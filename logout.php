<?php
require_once('start-session.php');
if (empty($_SESSION['admin_id'])) {
    header("Location: /login.php");
}
session_destroy();
header("Location: /index.php"); 
?>