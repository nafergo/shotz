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

$file = "task.json";
$jsonfile = file_get_contents($file);
$json_a = json_decode($jsonfile, true);

if (empty($_GET['action'])) {
	echo"Error: What do you want me to do? \n<br /><a href=\"index.php\">Go back and try again please.</a>";
} elseif (isset($_GET['action']) && $_GET['action'] == 'edit' ) {
#toon editformulier 
	$taskid=htmlspecialchars($_GET['id']);
	$found=0;
	echo "<h2>Edit</h2>";
	foreach ($json_a as $item => $task) {
		if ($item == $taskid) {
		$found = 1;
		echo "<form name=\"edit\" action=\"action.php\" method=\"GET\">";
		echo "<input name=\"content\" type=\"text\" value=\"";
		echo $task['task'];
		echo "\"></input>";
		echo "<input type=\"hidden\" name=\"id\" value=\"".  $taskid ."\"></input>";		
		echo "<input type=\"hidden\" name=\"action\" value=\"update\"></input>";
		echo "<input type=\"submit\" name=\"submit\" value=\"Submit\"></input>";
		echo "</form>";
		echo "<p />";
		}
	}		
		
	if ($found == 0) {
		echo"Error: Task not found.";
	} 
	
} elseif (isset($_GET['submit']) && $_GET['action'] == 'update' && !empty($_GET['id']) && !empty($_GET['content'])) {
#update task
	$taskid=htmlspecialchars($_GET['id']);
	$value=htmlspecialchars($_GET['content']);
	foreach ($json_a as $item => $task) {
		if ($item == $taskid) {
			$found = 1;
			$current = file_get_contents($file);
			$current = json_decode($current, TRUE);
			$json_a = array($taskid => array("task" => $value, "status" => "open"));
			$replaced = array_replace_recursive($current, $json_a);
			$replaced = json_encode($replaced);
			if(file_put_contents($file, $replaced, LOCK_EX)) {
				echo"Task updated. You will now be redirected back to the task list.";
				echo"<a href=\"index.php\">If that does not happen, please click here.</a>";
				?>
				<script type="text/javascript">
				window.location = "index.php"
				</script>
				<?php
			} else {
				echo"failure.";
			}
		}
	}
	if ($found==0) {
		echo "Error. Task not found. <a href=\"index.php\">Go back and try again please..</a>";
	}
	
} elseif (isset($_GET['submit']) && $_GET['action'] == 'add' && !empty($_GET['content'])) {
	#add task
	$id=substr(md5(rand()), 0, 20);
	$value=htmlspecialchars($_GET['content']);	
	$current = file_get_contents($file);
	$current = json_decode($current, TRUE);
	$json_a = array($id => array("task" => $value, "status" => "open"));
	if(is_array($current)) {
		$current = array_merge_recursive($json_a, $current);
	} else {
		$current = $json_a;
	}
	$current=json_encode($current);	
	if(file_put_contents($file, $current, LOCK_EX)) {
		echo"The task is added.<br />\nYou will now be redirected back to the task list.<br /> \n";
		echo"<a href=\"index.php\">If that does not happen, please click here.</a>";
		?>
		<script type="text/javascript">
		window.location = "index.php"
		</script>
		<?php
	} else {
		echo"failure.";
	}
} elseif (isset($_GET['action']) && $_GET['action'] == 'done' && !empty($_GET['id'])) {
	#task is done
	$taskid=htmlspecialchars($_GET['id']);
	foreach ($json_a as $item => $task) {
		if ($item == $taskid) {
			$found = 1;
			$current = file_get_contents($file);
			$current = json_decode($current, TRUE);
			$json_a = array($taskid => array("task" => $task['task'], "status" => "closed"));
			$done = array_replace_recursive($current, $json_a);
			$done = json_encode($done);
			if(file_put_contents($file, $done, LOCK_EX)) {
				echo"The task is marked as done.<br />\nYou will now be redirected back to the task list. <br />\n";
				echo"<a href=\"index.php\">If that does not happen, please click here.</a>";
				?>
				<script type="text/javascript">
				window.location = "index.php"
				</script>
				<?php
			} else {
				echo"failure.";
			}
		}
	}
	if ($found==0) {
		echo "Error. Task not found. <a href=\"index.php\">return.</a>";
	}
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
#delete task
	$taskid=htmlspecialchars($_GET['id']);
	foreach ($json_a as $item => $task) {
		if ($item == $taskid) {
			$found = 1;
			$current = file_get_contents($file);
			$current = json_decode($current, TRUE);
			unset($current[$taskid]);
			$deleted = json_encode($current);		
			if(file_put_contents($file, $deleted, LOCK_EX)) {
				echo"The task is deleted.<br />\nYou will now be redirected back to the task list. ";
				echo"<a href=\"index.php\">If that does not happen, please click here.</a>";
				?>
				<script type="text/javascript">
					window.location = "index.php"
				</script>
				<?php
			} else {
				echo"failure.";
			}
		}
	}
	if ($found==0) {
		echo "Error. Task not found. <a href=\"index.php\">Please go back to the task list and try again.</a>";
	}
} else {
	echo"What do you want me to do?";
}	

?>
