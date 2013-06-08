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
<form class="form-horizontal" style="margin-top:50%"  action = "login.php" method="post">
    
    <div class="control-group" style="text-align:center"><h1>Smart Gift</h1></div>
    <div class="control-group">
        <label class="control-label" for="inputEmail">user email:</label>
        <div class="controls"><input type="text" name="username" id="inputEmail" placeholder="Email"></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">password:</label>
       <div class="controls"><input type="password" name="pw" id="inputPassword" placeholder="Password"></div>
   </div>
   <div class="controls">
        <button type="submit" class="btn">Sign In</button>
        <a href="registration.php">new user?</a>
   </div>
</form>

</div>
</div>
</div>

</body>
</html>        
