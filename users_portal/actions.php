<?php
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
session_start();

$action = $_GET["action"];
if($action == "add" ){
if(empty($_POST["first_name"]) || empty($_POST["password"]) || empty($_POST["last_name"]) || empty($_POST["email"]) || empty($_POST["mobile"]) || $_POST["status"] == ""){
	$_SESSION["error_message"] = "Fill All Required Fields!";
	header('Location: add_user.php');
} else { 
$sql = "INSERT INTO users (first_name, last_name, email, mobile, password2, status, role, created_on)
VALUES ('".$_POST["first_name"]."', '".$_POST["last_name"]."', '".$_POST["email"]."', '".$_POST["mobile"]."', '".md5($_POST["password"])."', '".$_POST["status"]."', '".$_POST["role"]."', '".date('Y-m-d H:i:s')."')";

if ($conn->query($sql) === TRUE) {
  $_SESSION["success_message"] = "New record created successfully";
} else {
  $_SESSION["error_message"] =  "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: users.php');
}
} elseif($action == "delete"){
$id = $_GET["id"];
$sql = "DELETE FROM users WHERE id_users=".$id;
if ($conn->query($sql) === TRUE) {
  $_SESSION["success_message"] =  "Record deleted successfully";
} else {
  $_SESSION["error_message"] = "Error deleting record: " . $conn->error;
}
header('Location: users.php');
} elseif($action == "edit"){
	$id = $_POST["id"];
if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["mobile"]) || $_POST["status"] == ""){
	$_SESSION["error_message"] = "Fill All Required Fields!";
	header('Location: edit_user.php?id='.$id);
} else { 
$sql = "UPDATE users SET first_name = '".$_POST["name"]."', last_name = '".$_POST["last_name"]."', email = '".$_POST["email"]."', mobile = '".$_POST["mobile"]."', ";
if(!empty($_POST["password"]))
$sql .= "password2 = '".md5($_POST["password"])."',"; 
$sql .= "status = '".$_POST["status"]."', role = '".$_POST["role"]."' WHERE id_users = ".$id;

if ($conn->query($sql) === TRUE) {
  $_SESSION["success_message"] = "New record updated successfully";
} else {
  $_SESSION["error_message"] =  "Error: " . $sql . "<br>" . $conn->error;
}

header('Location: users.php');
}

} elseif($action == "login"){
	$email = $_POST["email"];
	$password = $_POST["password"];
 $sql = "SELECT id_users, first_name, last_name, email, mobile, status, role, created_on FROM users where email = '".$email."' AND password2 = '".md5($password)."' AND status = 1";

$result = $conn->query($sql);
if ($result->num_rows > 0){
	$user = $result->fetch_assoc();
	$_SESSION["login_user"] = $user;
	$_SESSION["loged_in"] = 1;
	$_SESSION["loged_in_name"] = $user["name"];
	$_SESSION["loged_role"] = $user["role"];
	header('Location: users.php');
} else {
	$_SESSION["error_message"] = "Check your Email or Password!!!";
	header('Location: index.php');
}
} elseif($action == "logout"){
	session_unset();
	header('Location: index.php');	
}
$conn->close(); ?>