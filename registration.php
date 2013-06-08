<!DOCTYPE html>
<html lang="en">
<title>Smart Gift Project</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/style.css" />
<script type="text/javascript" src ='js/bootstrap.js'></script>
<script type="text/javascript" src ='js/bootstrap.min.js'></script>

<body>
<div class="container-fluid home-page">
<div class="row-fluid">

<div class="span4 offset4">

<?php 
error_reporting(E_ALL);
require_once('db.php');
if(isset($_POST['submit'])) {
$username= $_POST['username'];
$password = $_POST['password'];
 echo 'Hello, '.$username;
 $users->insert($username, array('password' => $password));
 echo "your account has successfully created!";
}
?>
<form id='registration' class="form-horizontal" style="margin-top:50%" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
 <div class="control-group" style="text-align:center"><h3>Please enter your user email and choose a password</h3></div>

<div class="control-group">
<label class="control-label" for="inputEmail">user name</label>
<div class="controls"><input type="text" name="username" /></div>
</div>
<div class="control-group">
<label class="control-label" for="inputPassword">password</label>
<div class="controls"><input type="password" name="password"></div>
</div>
<div class="controls">
<button type="submit" name="submit" class="btn">Submit</button>
</div>
</form>

</div>
</div>
</div>

</body>
</html>



