<?php
session_start();
if(isset($_SESSION["loged_in"])){
	header('Location: users.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<div class="container">
  <div class="row mt-5 mb-5">
    <div class="col">
      <h1>Log In</h1>
      <hr />
<?php
if(isset($_SESSION["error_message"])){ ?>
<div class="alert alert-danger" role="alert">
  <?php echo $_SESSION["error_message"]; ?>
</div>
<?php } ?>
<form action="actions.php?action=login" method="post" >
<div class="mb-3">
  <label for="email" class="form-label">Email address <em>*</em></label>
  <input type="email" id="email" name="email" class="form-control" id="" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="password" class="form-label">Password <em>*</em></label>
  <input type="password" id="password" name="password" class="form-control" id="" placeholder="Password">
</div>
<div class="mb-3">
<input type="submit" name="Submit" value="Login" class="btn btn-success"  />
</div>
</form>
    </div>
   
  </div>
</div>
<?php 
unset($_SESSION["success_message"]);
unset($_SESSION["error_message"]);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<body>
</body>
</html>