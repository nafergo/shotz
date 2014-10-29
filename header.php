<?php

/*
#Copyright (c) 2012 Remy van Elst
#Permission is hereby granted, free of charge, to any person obtaining a copy
#of this software and associated documentation files (the "Software"), to deal
#in the Software without restriction, including without limitation the rights
#to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
#copies of the Software, and to permit persons to whom the Software is
#furnished to do so, subject to the following conditions:
#
#The above copyright notice and this permission notice shall be included in
#all copies or substantial portions of the Software.
#
#THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
#IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
#FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
#AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
#LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
#OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
#THE SOFTWARE.
*/

include("functions.php");

$link = file_get_contents('shot.json');
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
<meta name="description" content="" />

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="shotz.css" media="all" />         
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">





      
</head>
<body><a id="top-of-page"></a>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-5">
		<?php echo "<h2 class=\"\">".$LANG["moviename"]. " </h2>"; ?>
			
	</div>
	<div class="col-md-5">

		<h3><i class="fa fa-film"></i> Shots finished <small><?php echo($countclosed); ?> of <?php echo($countopen + $countclosed); ?> <span class="pull-right">[ <?php echo($countopen); ?> to do ]</span></small></h3>
		<div class="progress progress-striped">
  			<div class="progress-bar progress-bar-info" role="progressbar" 
  			aria-valuenow="<? echo $countclosed; ?>" 
  			aria-valuemin="0" 
  			aria-valuemax="100" style="width: <?php echo($countpercent); ?>%">
    			<?php echo($countpercent); ?>%
  			</div>
		</div>
		
		


		<h3><i class="fa fa-picture-o"></i> Frames rendered <small><?php echo($countframesclosed); ?> of <?php echo($countframesopen + $countframesclosed); ?> <span class="pull-right">[ <?php echo($countframesopen); ?> to render ]</span></small></h3>
		<div class="progress progress-striped">
  			<div class="progress-bar progress-bar-info" role="progressbar" 
  			aria-valuenow="<? echo $countclosed; ?>" 
  			aria-valuemin="0" 
  			aria-valuemax="100" style="width: <?php echo($countpercentframes); ?>%">
    			<?php echo($countpercentframes); ?>%
  			</div>
		</div>




	</div>

	<div class="col-md-1"></div>
</div>

<p></p>
<br>
<p></p>
<br>
<p></p>