<?php
include 'functions.php';
$result = getUsers($conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users List</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<div class="container">
  <div class="row mt-5 mb-5">
    <div class="col">
<p class="lead">
  Welcome <?php echo $_SESSION["loged_in_name"]; ?> - <a href="actions.php?action=logout" >Log Out</a>
</p>
      <h1>Users List <?php if($_SESSION["loged_role"] == "admin"){ ?><a href="add_user.php" class="float-end btn btn-primary" >Create User</a><?php } ?></h1>
      <hr />
<?php
if(isset($_SESSION["success_message"])){ ?>
<div class="alert alert-success" role="alert">
  <?php echo $_SESSION["success_message"]; ?>
</div>
<?php } ?>
<?php
if(isset($_SESSION["error_message"])){ ?>
<div class="alert alert-danger" role="alert">
  <?php echo $_SESSION["error_message"]; ?>
</div>
<?php } ?>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) { ?>
    <tr>
      <th scope="row"><?php echo $row["id_users"]; ?></th>
      <td><?php echo $row["first_name"]." ".$row["last_name"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
      <td><?php echo $row["mobile"]; ?></td>
      <td><?php echo ($row["status"] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">In Active</span>'; ?></td>
      <td>
      <?php
	  if($_SESSION["loged_role"] == "admin"){ ?>
      <a href="edit_user.php?id=<?php echo $row["id_users"]; ?>" class="badge bg-primary" >Edit</a>
      &nbsp;|&nbsp;
      <a onclick="if(confirm('Are you sure?')){ window.location = 'actions.php?action=delete&id=<?php echo $row["id_users"]; ?>'; }" class="badge bg-danger" style="cursor: pointer" >Delete</a>
      <?php } ?>
      </td>
    </tr>
  <?php } 
  } ?>
  </tbody>
</table>
    </div>
   
  </div>
</div>
<?php 
unset($_SESSION["success_message"]);
unset($_SESSION["error_message"]);
//session_unset();
$conn->close(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<body>
</body>
</html>