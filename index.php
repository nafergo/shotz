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

$file = file_get_contents("task.json");
$json_a = json_decode($file, true);
$closed=0;
$havetasks = 0;
?>
<!DOCTYPE html>
<html><head>
<title>Task / Todo list by Raymii.org</title>
<meta charset="UTF-8">
<meta name="description" content="" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="js/prettify.js"></script>                                   
<script type="text/javascript" src="js/kickstart.js"></script>                                  
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  
<link rel="stylesheet" type="text/css" href="style.css" media="all" />                          
</head><body><a id="top-of-page"></a><div id="wrap" class="clearfix">
<div class="col_9">

	<?php
	echo "<h2>Tasks</h2>";
	echo "<form name=\"edit\" action=\"action.php\" method=\"GET\">";
	echo "<input name=\"content\" type=\"text\" placeholder=\"Add new task...\" ></input>";
	echo "<input type=\"hidden\" name=\"action\" value=\"add\"></input>";
	echo "&nbsp; &nbsp; ";
	echo "<input type=\"submit\" name=\"submit\" value=\"Add Task\"></input>";
	echo "</form>";

	echo "<ul>";
	if(is_array($json_a)) {		
		foreach ($json_a as $item => $task) {
			if ($task['status'] == "open") {	
				$havetasks=1;
				echo "<li>";
				echo $task['task'];
				echo " <a href=\"action.php?id=" .$item. "&action=done\"><span class=\"icon small darkgray\" data-icon=\"C\"></span></a>";
				echo " [ <a href=\"action.php?id=" .$item. "&action=edit\"><span class=\"icon small darkgray\" data-icon=\"7\"></span></a>";
				echo " <a href=\"action.php?id=" .$item. "&action=delete\"><span class=\"icon small darkgray\" data-icon=\"T\"></span></a> ] ";
				echo "</li>";
			}	
		}
		if($havetasks == 0) {
			echo"No tasks. Add one first please.";	
		}
	} else { 
		echo"No tasks. Add one first please.";	
	}
	echo "</ul>";

	echo"<h2>Finished Tasks</h2>";
	echo "<ul>";
		if(is_array($json_a)) {	
		foreach ($json_a as $item => $task) {
			if ($task['status'] == "closed") {
			$closed=1;
			echo "<li>";
			echo $task['task'];
			echo " [ <a href=\"action.php?id=" .$item. "&action=delete\"><span class=\"icon small darkgray\" data-icon=\"T\"></span></a> ] ";		
			echo "</li>";
			}	
		}

		if ($closed == 0) {
			echo"No finished tasks yet. Please finish a task first.";
		}
	} else { 
		echo"No tasks. Add one first please.";	
	}		
	echo "</ul>";
	?>
</div><!--col_9 -->

<div class="col_3">
	<h2>Info</h2>
	<p>This is a task/todo list written in PHP. 
	It uses a JSON text file for the tasks (<a href="task.json">click here to see it</a>)
	and the visual side is created with the <a href="http://99lime.com">excellent HTML5 Kickstart framework by Joshua Gatcke.</a>
	</p><hr />
	<p>The script is available for download under an permissive open source license on <a href="http://raymii.org">Raymii.org</a> and was written by Remy van Elst.
	</p>
</div><!-- div col3 --> 

</div>

</div>
</body></html>
