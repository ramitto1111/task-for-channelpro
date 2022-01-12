<?php
include 'functions.php';
if($_SESSION["loged_role"] == "client"){
	header('Location: users.php');
}
$id = $_GET["id"];
$user = getOneUser($conn, $id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users / Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<div class="container">
  <div class="row mt-5 mb-5">
    <div class="col">
<p class="lead">
  Welcome <?php echo $_SESSION["loged_in_name"]; ?> - <a href="actions.php?action=logout" >Log Out</a>
</p>
      <h1><a href="users.php">Users List</a> / Edit User / <?php echo $user["first_name"]; ?></h1>
      <hr />
<?php
if(isset($_SESSION["error_message"])){ ?>
<div class="alert alert-danger" role="alert">
  <?php echo $_SESSION["error_message"]; ?>
</div>
<?php } ?>
<form action="actions.php?action=edit" method="post" >
<div class="mb-3">
  <label for="name" class="form-label">Full Name <em>*</em></label>
  <input type="text" id="name" name="name" class="form-control" id="" placeholder="First Name" value="<?php echo $user["first_name"]; ?>">
</div>
<div class="mb-3">
  <label for="last_name" class="form-label">Last Name <em>*</em></label>
  <input type="text" id="last_name" name="last_name" class="form-control" id="" placeholder="Last Name" value="<?php echo $user["last_name"]; ?>">
</div>
<div class="mb-3">
  <label for="email" class="form-label">Email address <em>*</em></label>
  <input type="email" id="email" name="email" class="form-control" id="" placeholder="name@example.com"  value="<?php echo $user["email"]; ?>">
</div>
<div class="mb-3">
  <label for="mobile" class="form-label">Mobile <em>*</em></label>
  <input type="text" id="mobile" name="mobile" class="form-control" id="" placeholder="Mobile"  value="<?php echo $user["mobile"]; ?>">
</div>

<div class="mb-3">
<label for="status" class="form-label">Status <em>*</em></label>
<select class="form-select" name="status" id="status">
  <option selected value="">- select option -</option>
  <option value="1" <?php if($user["status"] == 1) echo 'selected="selected"'; ?>>Active</option>
  <option value="0" <?php if($user["status"] == 0) echo 'selected="selected"'; ?>>In Active</option>
</select>
</div>
<div class="mb-3">
<input type="hidden" name="id" value="<?php echo $user["id_users"]; ?>"  />
<input type="submit" name="Submit" value="Create" class="btn btn-success"  />
</div>
</form>
    </div>
   
  </div>
</div>
<?php 
unset($_SESSION["success_message"]);
unset($_SESSION["error_message"]);
$conn->close(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<body>
</body>
</html>