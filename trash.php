<?php

include("functions.php");

$link = file_get_contents('storage/shot.json');



?>
<!DOCTYPE html>
<html><head>
<title><?php echo "".$LANG["softwarename"]. " ".$LANG["softwareversion"]."";?></title>
<meta charset="UTF-8">
<meta name="description" content="" />

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="css/shotz.css" media="all" />         
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

 <link rel="icon" href="favicon.ico" type="image/ico" sizes="64x64"> 



      
</head>
<body><a id="top-of-page"></a>

   <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
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
            <li><a href="index.php">Home</a></li>
            <li><a href="finished.php">Finished</a></li>
            <li><a href="stats.php">Stats</a></li>            
            <li><a href="admin.php">Admin</a></li>
            <li class="active"><a href="trash.php">Trash</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
    
  

<div class="container-fluid">    
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	      <div class="page-header">
				<h1><?php echo "".$LANG["thrash"]."";?></h1>
      	</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<p><?php listshots($json_a,"deleted","table"); ?></p>

		</div>
	</div>
</div>

<?php include 'footer.php';?>


