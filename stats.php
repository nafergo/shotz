<?php require("login.php"); ?>
<?php

include("functions.php");

$link = file_get_contents('storage/shot.json');
$myarray = json_decode($link, true);

$countopen = 0;
foreach($myarray['shots'] as $item){
    if($item['status'] == open){//or whatever you're looking for
        $countopen++;
    }
}

$countclosed = 0;
foreach($myarray['shots'] as $item){
    if($item['status'] == closed){//or whatever you're looking for
        $countclosed++;
    }
}

$countpercent = ($countclosed * 100) / ($countopen + $countclosed);
$countpercent = round($countpercent); //


$countframesclosed = 0;
foreach($myarray['shots'] as $key => $value){
    if($value['status'] == closed){//or whatever you're looking for
    $countframesclosed += $value['frames'];
    }
}

$countframesopen = 0;
foreach($myarray['shots'] as $key => $value){
    if($value['status'] == open){//or whatever you're looking for
    $countframesopen += $value['frames'];
    }
}

$countpercentframes = ($countframesclosed * 100) / ($countframesopen + $countframesclosed);
$countpercentframes = round($countpercentframes); //


?>
<!DOCTYPE html>
<html><head>
<title><?php echo "".$LANG["softwarename"]. " ".$LANG["softwareversion"]."";?></title>
<meta charset="UTF-8">
<meta name="description" content="Web platform for short movie production tracking">
<meta name="keywords" content="production, management, task, shot, animation, film, movie">
<meta name="author" content="nelson gonçalves" >

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="css/shotz.css" media="all" />        
<link rel="stylesheet" type="text/css" href="css/colors.css" media="all" />                   
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

 <link rel="icon" href="favicon.ico" type="image/ico" sizes="64x64"> 



      
</head>
<body><a id="top-of-page"></a>

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
            <li class="active"><a href="stats.php"><i class="fa fa-bar-chart"></i> Stats</a></li>            
            <li><a href="admin.php"><i class="fa fa-cogs"></i> Admin</a></li>
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
	      <div class="page-header">
				<h1><?php echo "".$LANG["statstitle"]."";?></h1>    
      	</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">

    <h2>Total Progress</h2>
		<h3><i class="fa fa-film"></i> Shots finished</h3>
		<small><?php echo($countclosed); ?> finished of a total of <?php echo($countopen + $countclosed); ?> <span class="pull-right">[ <?php echo($countopen); ?> to do ]</span></small>
		<div class="progress progress-striped">
  			<div class="progress-bar progress-bar-info" role="progressbar" 
  			aria-valuenow="<? echo $countclosed; ?>" 
  			aria-valuemin="0" 
  			aria-valuemax="100" style="width: <?php echo($countpercent); ?>%">
    			<?php echo($countpercent); ?>%
  			</div>
		</div>



		</div>
		</div>

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">


		<h3><i class="fa fa-picture-o"></i> Frames rendered</h3>
		<small><?php echo($countframesclosed); ?> rendered of a total of <?php echo($countframesopen + $countframesclosed); ?> <span class="pull-right">[ <?php echo($countframesopen); ?> to render ]</span></small>
		<div class="progress progress-striped">
  			<div class="progress-bar progress-bar-info" role="progressbar" 
  			aria-valuenow="<? echo $countclosed; ?>" 
  			aria-valuemin="0" 
  			aria-valuemax="100" style="width: <?php echo($countpercentframes); ?>%">
    			<?php echo($countpercentframes); ?>%
  			</div>
		</div>
		
				</div>
		
		<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
		

	
<div class="row">
		<h3 class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-12 col-xs-12">Calculate the seconds</h3>
</div>	
<form class="form-horizontal" method="post" action="">

<?php

if (isset($_POST['valuea'])) $valuea = $_POST['valuea'];
if (isset($_POST['valueb'])) $valueb = $_POST['valueb'];
$answer = $valuea / $valueb;

echo <<<_END

  <div class="form-group">
    <label for="frames" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label">Frames</label>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
      <input class='form-control' type='text' name='valuea' value="$countframesclosed"/>
    </div>
  </div>

  <div class="form-group">
    <label for="fps" class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label">FPS</label>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-3">
<select class="form-control" name="valueb" value="$valueb">
<option value="6">6</option>
<option value="12">12</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="50">50</option>
        </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-2 col-lg-offset-2 col-md-2 col-md-offset-2 col-sm-offset-2 col-sm-2 col-xs-4 col-xs-offset-2">
      <button class="btn btn-primary" value="Calculate" type="submit">Calculate</button>
    </div>
  </div>    

	
 					
_END;
?>
<div class="form-group">    
    <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
<p>You have <strong><?php echo round($answer)?></strong> seconds</p>
    </div>
      </div>
</form> 

		</div>

		</div>



	</div>


<?php include 'footer.php';?>




   
    


