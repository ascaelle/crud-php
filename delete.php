<?php
require_once('start-session.php');
require 'connection.php';
if (empty($_SESSION['admin_id'])) {
    header("Location: /login.php");
}
$id = $_GET['id'];
$sql = 'DELETE FROM contacts WHERE id=:id';

$statement = $connection->prepare($sql);

if ($statement->execute([':id' => $id])) {
    header("Location: /");
}
