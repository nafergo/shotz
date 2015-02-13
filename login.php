<?php session_start();
//================================================
// Login Session is copyright (c)2007, Scott J. LeCompte
// 
// Released 02/20/2010 under GNU Public Licensing 
// Terms.  Free to use, modify, and distribute.
//
// Support available at http://www.myphpscripts.net
//================================================

// Data file
$data = "users.txt";

// Absolute path to the data file
$path = "";

// Enable / Disable user registration: 1 = enabled, 0 = disabled
$registration = 1;

// Encoding key - Change this to any string of characters.
$keyCode = "vns98ogavna5489hverz9np950yhz9gzx89fghjv9pv4598hj";

// Main cascading stylesheets
$style = '
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading {
  margin-bottom: 10px;
}

.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="text"] {
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.btn-block {
    display: block;
    width: 100%;
}

';


// Do not edit below this line

$version = '2.2.4';

function encode($string,$key) {
	$key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
}

function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}

$users = $path . $data;

if (file_exists($users)) {
	$records = count(file($users));
}
else {
	fopen($users, 'w') or die("Can't open user database.");
}
if (isset($_GET['ls_logout'])) {
	unset($_SESSION['ls_id']);
	unset($_SESSION['ls_user']);
	unset($_SESSION['ls_email']);
}
if (isset($_POST)) {
	$login = FALSE; 
	$register = FALSE;
	$errors = '';
	foreach ($_POST as $key => $value) {
		if ($key == "ls_reg") { $login = FALSE; $register = TRUE; }
		else if ($key == "ls_log") { $login = TRUE; $register = FALSE; }
		else if ($key == "ls_user") { 
			if (!eregi('^[[:alnum:]\.\'\-]{3,15}$', $value)) { $u_invalid = 1; }
			$user = encode($value,$keyCode); 
		}
		else if ($key == "ls_email") { 
			if (!eregi('^[a-zA-Z]+[\.a-zA-Z0-9_-]*@([a-zA-Z0-9_-]+){1}(\.[a-zA-Z0-9]+){1,2}', $value)) { $e_invalid = 1; }
			$email = encode($value,$keyCode); 
		}
		else if ($key == "ls_pass") { 
			if (!eregi("^[[:alnum:]\.\'\-]{3,15}$", $value)) { $p_invalid = 1; }
			$pass = sha1($value); 
		}
		else if ($key == "ls_repeat") { $repeat = sha1($value); }
	}
}
if ($login == TRUE) {
	if (file_exists($users)) {
		$lines = file($users);
		foreach ($lines as $line_num => $line) {
			$array = explode("||",str_replace("\n","",$line));
			$c_id = $array[0];
			$c_user = $array[1];
			$c_email = $array[2];
			$c_pass = $array[3];
			if ($c_user == $user && $c_pass == $pass) {
				$_SESSION['ls_id'] = $c_id;
				$_SESSION['ls_user'] = decode($c_user,$keyCode);
				$_SESSION['ls_email'] = decode($c_email,$keyCode);
			}
		}
		if (!isset($_SESSION['ls_id']) || !isset($_SESSION['ls_user']) || !isset($_SESSION['ls_email'])) {
			$errors[] = "Invalid Login!";
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
<title>Shotz - Login Error</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nafergo" >

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
	<body>
	
<div class="container">

	<div class="form-signin">
	
		<h1 class="login_title">Shotz</h1>
		 <h2 class="form-signin-heading">Login Error</h2>
				    <div class="form-group">
					<?php
			                foreach ($errors as $msg) {
			                  echo "<h2><span class=\"label label-danger\"><i class=\"fa fa-exclamation-circle\"></i> $msg</span></h2>";			                  
			                }
					$errors = '';
					?>

  						</div>
  
					  <div class="form-group">
					  <h5>Please double-check the details you have entered are correct.</h5>
  						</div>

						<a class="btn btn-lg btn-block btn-primary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="">Click here to retry</a>

		</div>

		</div>
	</body>
</html>
		<?php
		exit();
		}
	}
}
else if ($register == TRUE) {
	if (file_exists($users)) {
		$lines = file($users);
		foreach ($lines as $line_num => $line) {
			$array = explode("||",str_replace("\n","",$line));
			$c_id = $array[0];
			$c_user = $array[1];
			$c_email = $array[2];
			$c_pass = $array[3];
			if ($user == $c_user) { $u_taken = 1; }
			if ($email == $c_email) { $e_taken = 1; }
		}
		if ($user == NULL) { $errors[] = 'Username cannot be blank.'; }
		if ($u_invalid == 1) { $errors[] = 'Username <strong>' . htmlspecialchars(decode($user,$keyCode)) . '</strong> is invalid. 3-15 alphanumeric characters required.'; }
		if ($u_taken == 1) { $errors[] = 'Username <strong>' . htmlspecialchars(decode($user,$keyCode)) . '</strong> is already taken.'; }
		if ($email == NULL) { $errors[] = 'Email cannot be blank.'; }
		if ($e_invalid == 1) { $errors[] = 'Email address <strong>' . htmlspecialchars(decode($email,$keyCode)) . '</strong> is invalid.'; }
		if ($e_taken == 1) { $errors[] = 'Email address <strong>' . htmlspecialchars(decode($email,$keyCode)) . '</strong> already registered.'; }
		if ($pass == sha1(NULL)) { $errors[] = 'Password cannot be blank.'; }
		if ($p_invalid == 1) { $errors[] = 'Password is invalid. 3-15 alphanumeric characters required.'; }
		if ($repeat == sha1(NULL)) { $errors[] = 'Password verification cannot be blank.'; }
		if ($pass != $repeat) { $errors[] = 'Password and verification do not match.'; }
	}
	if (empty($errors)) {
		$newline = $records++;
		$data = "$newline||$user||$email||$pass\n";
		$fh = fopen($users, 'a') or die("Can't open user database.");
		fwrite($fh, $data);
		fclose($fh);
?>
<!DOCTYPE html>
<html><head>
<title>Shotz - New Login Created!</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nafergo" >

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
            <li class="active"><a href="admin.php"><i class="fa fa-cogs"></i> Admin</a></li>
            <li><a href="trash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
           
 
 <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-circle" style="margin-top: -15px;margin-bottom: -15px;" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['ls_email']))); ?>?size=32" alt=""> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="edit_profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
 <li class="divider"></li> 
<li><a href="<?php $_SERVER['PHP_SELF']; ?>?ls_logout" rel=""><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>
</li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container">    
			

				<form class="form-signin">
				     <h2 class="form-signin-heading">Registration Successful</h2>
				     	 <div class="form-group">
				     <h2><span class="label label-success"><i class="fa fa-thumbs-o-up"></i> New Login Created!</span></h2>
						</div>
	
		

						<a class="btn btn-lg btn-primary btn-block" href="<?php echo $_SERVER['REQUEST_URI']; ?>" rel="">Back To Admin</a>

				</form>


    </div> <!-- /container -->	
	
	
	<?php include 'footer.php';?>
	

<?php
	exit();
	}
	else {
?>
<!DOCTYPE html>
<html><head>
<title>Shotz - Login Creation ERROR!</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nafergo" >

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
            <li class="active"><a href="admin.php"><i class="fa fa-cogs"></i> Admin</a></li>
            <li><a href="trash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
           
 
 <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-circle" style="margin-top: -15px;margin-bottom: -15px;" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['ls_email']))); ?>?size=32" alt=""> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="edit_profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
 <li class="divider"></li> 
<li><a href="<?php $_SERVER['PHP_SELF']; ?>?ls_logout" rel=""><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>
</li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container">    
			

				<form class="form-signin">
				     <h2 class="form-signin-heading">Login Creation ERROR!</h2>
				     					  <div class="form-group">
	
						<?php
			                foreach ($errors as $msg) {
			                  echo "<h2><span class=\"label label-danger\"><i class=\"fa fa-exclamation-circle\"></i> $msg</span></h2>";
			                }
					$errors = '';
					?>
									</div>	

						<a class="btn btn-lg btn-primary btn-block" href="<?php echo $_SERVER['HTTP_REFERER']; ?>" rel="">Go Back</a>

				</form>


    </div> <!-- /container -->	
	
	
	<?php include 'footer.php';?>
	
	
	


<?php
	exit();
	}
}
else if (isset($_GET['ls_register']) && $registration == 1) {
?>
<!DOCTYPE html>
<html><head>
<title>Shotz - Register New Login</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nafergo" >

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
            <li class="active"><a href="admin.php"><i class="fa fa-cogs"></i> Admin</a></li>
            <li><a href="trash.php"><i class="fa fa-trash-o"></i> Trash</a></li>
           
 
 <li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="img-circle" style="margin-top: -15px;margin-bottom: -15px;" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['ls_email']))); ?>?size=32" alt=""> <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="edit_profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
 <li class="divider"></li> 
<li><a href="<?php $_SERVER['PHP_SELF']; ?>?ls_logout" rel=""><i class="fa fa-sign-out"></i> Logout</a></li>
</ul>
</li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	
	<div class="container">    
			

				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-signin" method="post">
				     <h2 class="form-signin-heading">Create New Login</h2>
				    <div class="form-group">				     				     
						<label class="sr-only">Username</label>				    
				    <div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>    											
						<input type="text" name="ls_user" value="" class="form-control" placeholder="Enter username"/>
						</div>
  						</div>
						
				    <div class="form-group">						
						<label class="sr-only">Email Address</label>
				    <div class="input-group"><div class="input-group-addon">@</div>    											
						<input type="text" name="ls_email" value="" class="form-control" placeholder="Enter email" />
						</div>
						<p class="help-block">This email address is for displaying a <a href="https://en.gravatar.com/"target="_blank">Gravatar</a>. </p>
  						</div>

				    <div class="form-group">
						<label class="sr-only">Password</label>
				    <div class="input-group"><div class="input-group-addon"><i class="fa fa-lock"></i></div>    											
						<input type="password" name="ls_pass" value="" class="form-control" placeholder="Password" />
						</div>
  						</div>

				    <div class="form-group">
						<label class="sr-only">Repeat Password</label>
				    <div class="input-group"><div class="input-group-addon"><i class="fa fa-lock"></i></div>    											
						<input type="password" name="ls_repeat" value="" class="form-control" placeholder="Repeat Password" />
						</div>
  						</div>

			        <button class="btn btn-lg btn-primary btn-block" name="ls_reg" value="Register" type="submit"><i class="fa fa-key"></i> Create New Login</button>					


						<a class="btn btn-lg btn-danger btn-block" href="<?php echo $_SERVER['PHP_SELF'] ?>" rel="">Cancel</a>

				</form>


    </div> <!-- /container -->	
	
	
	<?php include 'footer.php';?>

<?php
exit();
}
else if (!isset($_SESSION['ls_id']) && !isset($_SESSION['ls_user']) && !isset($_SESSION['ls_email'])) {
?>
<!DOCTYPE html>
<html><head>
<title>Shotz - Login</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nafergo" >

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

	<body>

	<div class="container">    
			
				<form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="form-signin" method="post"><h1 class="login_title">Shotz</h1>
				     <h2 class="form-signin-heading">Please sign in</h2>
				    <div class="form-group">
				    <label for="inputUser" class="sr-only">User</label>
				    <div class="input-group"><div class="input-group-addon"><i class="fa fa-user"></i></div>
    					<input type="text" name="ls_user" value="" class="form-control" id="inputUser" placeholder="Enter username">
  						</div>
  						</div>					
					  <div class="form-group">
    					<label for="inputPassword" class="sr-only">Password</label>
				    <div class="input-group"><div class="input-group-addon"><i class="fa fa-lock"></i></div>    					
    					<input type="password" name="ls_pass" value="" class="form-control" id="inputPassword" placeholder="Password">
  						</div>
  						</div>					
			        <button class="btn btn-lg btn-primary btn-block" name="ls_log" value="Log In" type="submit"><i class="fa fa-sign-in"></i> Sign in</button>					
					
				</form>

    </div> <!-- /container -->


	</body>
</html>
<?php
exit();
}
?>