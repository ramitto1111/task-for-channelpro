<?php
session_start();
if(!isset($_SESSION["loged_in"])){
	header('Location: index.php');
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_portal";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function getUsers($conn ){
$sql = "SELECT id_users, first_name, last_name, email, mobile, status, role, created_on FROM users ORDER BY created_on DESC";
$result = $conn->query($sql);
return $result;
}

function getOneUser($conn, $id){
$sql = "SELECT id_users, first_name, last_name, email, mobile, status, role, created_on FROM users where id_users = ".$id;
$result = $conn->query($sql);
return $result->fetch_assoc();
}