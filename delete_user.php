<!DOCTYPE html>
<html><head>
<title>Shotz - New Login Created!</title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="openlab3" >

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" type="text/css" href="css/shotz.css" media="all" />   
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

 <link rel="icon" href="favicon.ico" type="image/ico" sizes="64x64"> 
		<style type="text/css">
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #e5e5e5;
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
	
<div class="container-fluid">    
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			
				<form class="form-signin">
				     <h2 class="btn-block"><span class="label label-success">Deletion successful</span></h2>
				     	 <div class="form-group">


	
		


				
<?php 
// 
$datafile = 'users.txt'; 
if (isset($_GET['id']) and is_numeric($_GET['id']) and ($_GET['id'] > 0)) { 
 $newfile = null; 
 $id = $_GET['id']; 
 $fh = fopen($datafile, "r") or die("cannot open file for reading"); 
 if (is_file($datafile) and $fh) { 
 while (!feof($fh)) { 
 $buffer = fgets($fh, 4096); 
 // Only skip the line if it matches on the id. 
 // otherwise compile all the contents into $newfile, 
 // which we will use to overwrite $datafile. Include 
 // the delimiter so it doesn't match on 42, 406, etc. 
 // make sure it's writable. 
 if (! preg_match("/^$id\|\|.*/",$buffer)) { 
 $newfile .= $buffer; 
 } 
 } 
 } 
 fclose($fh); 
 $fh = fopen($datafile, "w") or die("cannot open file for writing"); 
 if (fwrite($fh, $newfile) === FALSE) { die("Cannot write to $datafile"); } 
 fclose($fh); 
 // check it 
 $contents = file_get_contents($datafile); 
 echo "<h2>Login deleted!!</h2></div>
 <a class=\"btn btn-lg btn-primary btn-block\" href=\"admin.php\" >Back To Admin</a>
 "; 
} 
else {  
 echo "<h1>Something went wrong :(</h1>
<a class=\"btn btn-lg btn-primary btn-block\" href=\"admin.php\" >Back To Admin</a>
 ";  
} 
?> 
  
				</form>  
  
</div></div>    </div> <!-- /container -->	
    
    	
	<?php include 'footer.php';?>
	

