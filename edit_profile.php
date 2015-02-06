<?php require("login.php"); ?>
<!DOCTYPE html>
<html><head>
<title>Shotz - Edit Profile</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nelson gonçalves" >

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="css/shotz.css" media="all" />   
<link rel="stylesheet" type="text/css" href="css/colors.css" media="all" />                        
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

 <link rel="icon" href="favicon.ico" type="image/ico" sizes="64x64"> 
		<style type="text/css">
		<?php echo $style; ?>
		</style>
</head>
	<body style="background-color: #FFF;">
   <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Shotz</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><i class="fa fa-tasks"></i> Home</a></li>
            <li><a href="finished.php"><i class="fa fa-check-square-o"></i> Finished</a></li>
            <li><a href="stats.php"><i class="fa fa-bar-chart"></i> Stats</a></li>            
            <li><a href="admin.php"><i class="fa fa-cogs"></i> Admin</a></li>
            <li><a href="trash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
           
 
 <li class="dropdown active">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-circle" style="margin-top: -15px;margin-bottom: -15px;" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['ls_email']))); ?>?size=32" alt=""> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="edit_profile2.php"><i class="fa fa-user"></i> Edit Profile</a></li>
 <li class="divider"></li> 
<li><a href="<?php $_SERVER['PHP_SELF']; ?>?ls_logout" rel=""><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>
</li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container">    
	<div class="row">
	
	
	<div class="col-lg-6">



				     <h1>Your Profile</h1>						
				   
				   
				   <p><img class="img-circle" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['ls_email']))); ?>?size=128" alt=""></p>				   
				   <h4><strong><i class="fa fa-user"></i> Username</strong> <?php echo $_SESSION['ls_user'] ?></h4>
				   <h4><strong><i class="fa fa-envelope-o"></i> Email</strong> <?php echo $_SESSION['ls_email']; ?></h4>
				   
	</div>
  					


<div class="col-lg-6">
				




				<form name="form" class="form-signin" method="post">
				     <h2 class="form-signin-heading">Change Password</h2>						

				    <div class="form-group">				     				     
						<label class="">New Password</label>				    
				    <div class="input-group"><div class="input-group-addon"><i class="fa fa-lock"></i></div>    											
						<input type="text" id="NEW PASSWORD" name="new_pass" value="" class="form-control" placeholder="Enter new password"/>
						</div>
  						</div>
  						
  						<button class="btn btn-lg btn-danger btn-block" name="submit" value="Submit" type="submit">Change Password</button>					

				</form>
				

	
	


<?php
$file = file($data);
$name = $_SESSION['ls_user'];
$email = $_SESSION['ls_email'];
$encodename = encode($name,$keyCode);
$encodeemail = encode($email,$keyCode);
$new = $_POST['new_pass'];
$ecodenew = sha1($new);
$break = '||';
if(isset($_POST['submit'])){
$found = false;
foreach ($file as $lineNumber => $line) {
if (strpos($line,$name) !== false) {
$found = true;
$lineNumber++;
break;
}
}


$reading = fopen($data, 'r');
$writing = fopen('myfile.tmp', 'w');

$replaced = false;

while (!feof($reading)) {
$line = fgets($reading);
if (stristr($line,$encodename)) {
$line = "$lineNumber$break$encodename$break$encodeemail$break$ecodenew\n";
$replaced = true;
}
fputs($writing, $line);
}
fclose($reading); fclose($writing);
// might as well not overwrite the file if we didn't replace anything
if ($replaced)
{
echo "Password was successfully changed to <b>$new</b>, Please write/remember your new password";
rename('myfile.tmp', $data);
} else {
unlink('myfile.tmp');
}
}
?>






    </div>
    
    
</div>    
    
 </div>    <!-- /container -->	

	<?php include 'footer.php';?>