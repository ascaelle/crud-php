<?php
require_once('start-session.php');

$username = 'root';
$password = '';
$sql = "SELECT * FROM mycontacts";

try {
    $connection = new PDO('mysql:host=localhost;dbname=mycontacts', $username, $password);
} catch (PDOException $e) {
}
