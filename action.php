<?php include 'header.php';?>


<div class="row">


	<div class="col-md-1"></div>

	<div class="col-md-10">
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




if (empty($_GET['action'])) {
	echo $LANG["noactiongiven"];

} elseif (isset($_GET['action']) && $_GET['action'] == 'edit' ) {
#toon editformulier 
	$shotid=htmlspecialchars($_GET['id']);
	$found=0;
	echo "<h2>".$LANG["edit"]."</h2>";
	foreach ($json_a as $item => $shot) {
		if ($item == $shotid) {
		$found = 1;

    echo "<table class=\"table-condensed\">";
    echo "<tr>";
    echo "<th>".$LANG["priority"]."</th>";
    echo "<th>".$LANG["scene"]."</th>";
    echo "<th>".$LANG["shot"]."</th>";
    echo "<th>".$LANG["frames"]."</th>";
    echo "<th>".$LANG["user"]."</th>";
    echo "<th>".$LANG["task"]."</th>";
    echo "<th>".$LANG["statuse"]."</th>";
    echo "<th>".$LANG["duedate"]."</th>";
    echo "<th>".$LANG["addsomething"]."</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo "<form name=\"edit\" action=\"action.php\" method=\"GET\">";
    echo "<select class=\"form-control\" name=\"prio\">\n";
        echo "<option value=\"2\">".$LANG["normal"]."</option>\n";
        echo "<option value=\"1\">".$LANG["high"]."</option>\n";
        echo "<option value=\"3\">".$LANG["low"]."</option>\n";
        echo "<option value=\"4\">".$LANG["onhold"]."</option>\n";
        echo "</select>\n";
    echo "</td>";
    echo "<td>";
    echo "<input class=\"form-control\" name=\"scene\" type=\"text\" value=\"".$shot["scene"]."\" ></input>";
    echo "</td>";
    echo "<td>";
    echo "<input class=\"form-control\" name=\"shot\" type=\"text\" value=\"".$shot["shot"]."\" ></input>";
    echo "</td>";

    echo "<td>";
    echo "<input class=\"form-control framesinput\" name=\"frames\" type=\"number\" value=\"".$shot["frames"]."\" ></input>";
    echo "</td>";

    echo "<td>";

$users = file('users.txt');
$options = '';
foreach ($users as $user) {
    $options .= '<option value="'.$user.'">'.$user.'</option>';
}
$select = '<select class="form-control" name="user">'.$options.'</select>';

echo $select;

    //echo "<input name=\"user\" size=10 type=\"text\" value=\"".$shot["user"]."\" ></input>";
    echo "</td>";
    echo "<td>";

$tasks = file('tasks.txt');
$options = '';
foreach ($tasks as $task) {
    $options .= '<option value="'.$task.'">'.$task.'</option>';
}
$select = '<select class="form-control" name="task">'.$options.'</select>';

echo $select;

    echo "</td>";
    echo "<td>";

$statuses = file('statuses.txt');
$options = '';
foreach ($statuses as $statuse) {
    $options .= '<option value="'.$statuse.'">'.$statuse.'</option>';
}
$select = '<select class="form-control" name="statuse">'.$options.'</select>';

echo $select;

    echo "</td>";
    echo "<td>";
    echo "<input class=\"form-control\" name=\"duedate\" size=10 type=\"text\" value=\"".$shot["duedate"]."\"></input>\n";
    echo "</td>";
    echo "<td class=\"center_me\">";
    echo "<input type=\"hidden\" name=\"action\" value=\"update\"></input>";
    echo "<input name=\"dateadded\" type=\"hidden\" value=\"".$shot["dateadded"]."\"></input>\n";
    echo "<input type=\"hidden\" name=\"id\" value=\"".  $item ."\"></input>";
    echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-default\">".$LANG["updateshot"]."</button>";
        
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
		}
	}		
		
	if ($found == 0) {
		echo $LANG["eshotnotfound"];
	} 
	
} elseif (isset($_GET['submit']) && $_GET['action'] == 'update' && !empty($_GET['id']) && !empty($_GET['shot']) && !empty($_GET['prio'])) {
#update shot
	$shotid=htmlspecialchars($_GET['id']);
	$sentshot=htmlspecialchars($_GET['shot']);
	$duedate=htmlspecialchars($_GET['duedate']);
	$scene=htmlspecialchars($_GET['scene']);
	$frames=htmlspecialchars($_GET['frames']);	
	$user=htmlspecialchars($_GET['user']);
	$task=htmlspecialchars($_GET['task']);
	$statuse=htmlspecialchars($_GET['statuse']);
	# If the due date is empty we replace it with a dash. 
	if (empty($duedate) || !preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/',$duedate)) {
		$duedate = "-";
	} 
	
	$priority=htmlspecialchars($_GET['prio']);

	#Validating priority. Only 4 possibilities.
	if ($priority != "1" && $priority != "2" && $priority != "3" && $priority != "4") {
		$priority = 2;
	}
	foreach ($json_a as $item => $shot) {
		if ($item == $shotid) {
			$found = 1;
			$current = file_get_contents($file);
			$current = json_decode($current, TRUE);
			$json_update["shots"]["$item"] = array("shot" => $sentshot, "status" => "open", "duedate" => $duedate, "dateadded" => $shot["dateadded"], "priority" => $priority, "scene" => $scene, "frames" => $frames, "user" => $user, "task" => $task, "statuse" => $statuse);
			$replaced = array_replace_recursive($current, $json_update);
			$replaced = json_encode($replaced);
			if(file_put_contents($file, $replaced, LOCK_EX)) {
				echo $LANG["shotupdated"];
				echo $LANG["redirected"];
				redirect();
			} else {
				echo $LANG["eupdateshot"];
			}
		}
	}
	if ($found==0) {
		echo $LANG["eshotnotfound"];
		echo $LANG["redirected"];
		redirect();
	}
	
} elseif (isset($_GET['submit']) && $_GET['action'] == 'add' && !empty($_GET['shot']) && !empty($_GET['scene']) && !empty($_GET['frames']) && !empty($_GET['user']) && !empty($_GET['task']) && !empty($_GET['statuse']) && !empty($_GET['prio'])) {
	#add shot
	$id=substr(md5(rand()), 0, 20);
	$shot=htmlspecialchars($_GET['shot']);
	$scene=htmlspecialchars($_GET['scene']);
	$frames=htmlspecialchars($_GET['frames']);
	$user=htmlspecialchars($_GET['user']);
	$task=htmlspecialchars($_GET['task']);
	$statuse=htmlspecialchars($_GET['statuse']);
	$duedate=htmlspecialchars($_GET['duedate']);
	# If the due date is empty we replace it with a dash. And if the due date is in the past we also do that.
	if (empty($duedate)) {
		$duedate = "-";
	} elseif (!preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/', $duedate)) {

		$duedate = "-";
	}
	$dateadded=date('m-d-Y');
	$priority=htmlspecialchars($_GET['prio']);
	#Validating priority. Only 4 possibilities.
	if ($priority != "1" && $priority != "2" && $priority != "3" && $priority != "4") {
		$priority = 2;
	}
	$current = file_get_contents($file);
	$current = json_decode($current, TRUE);
	$json_add["shots"]["$id"] = array("shot" => $shot, "status" => "open", "duedate" => $duedate, "dateadded" => $dateadded, "scene" => $scene, "frames" => $frames, "user" => $user,  "task" => $task, "statuse" => $statuse, "priority" => $priority);
		
		

	if(is_array($current)) {
		$current = array_merge_recursive($json_add, $current);
	} else {
		$current = $json_add;
	}

	$current=json_encode($current);	
	if(file_put_contents($file, $current, LOCK_EX)) {
		echo $LANG["shotadded"];
		echo $LANG["redirected"];
		redirect();
	} else {
		echo $LANG["eshotnotadded"];
		echo $LANG["redirected"];
		redirect();
	}
} elseif (isset($_GET['action']) && $_GET['action'] == 'done' && !empty($_GET['id'])) {
	#shot is done
	$shotid=htmlspecialchars($_GET['id']);
	$vandaag=date('m-d-Y');
	foreach ($json_a as $item => $shot) {
		if ($item == $shotid) {
			$found = 1;
			$current = file_get_contents($file);
			$current = json_decode($current, TRUE);
			$json_done["shots"]["$shotid"] = array("shot" => $shot['shot'], "status" => "closed", "duedate" => $shot["duedate"], "dateadded" => $shot["dateadded"], "priority" => $shot["priority"], "scene" => $shot["scene"], "frames" => $shot["frames"], "user" => $shot["user"], "task" => $shot["task"], "statuse" => $shot["statuse"], "donedate" => $vandaag);
			$done = array_replace_recursive($current, $json_done);
			$done = json_encode($done);
			if(file_put_contents($file, $done, LOCK_EX)) {
				echo $LANG["shotdone"];
				echo $LANG["redirected"];
				redirect();
			} else {
				echo $LANG["eshotnotdone"];
				echo $LANG["redirected"];
				redirect();
			}
		}
	}
	if ($found==0) {
		echo $LANG["eshotnotfound"];
		echo $LANG["redirected"];
		redirect();
	}
} elseif (isset($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
#delete shot
	#shot is done
	$shotid=htmlspecialchars($_GET['id']);
	foreach ($json_a as $item => $shot) {
		if ($item == $shotid) {
			$found = 1;
			$current = file_get_contents($file);
			$current = json_decode($current, TRUE);
			$json_delete["shots"]["$shotid"] = array("shot" => $shot['shot'], "status" => "deleted", "duedate" => $shot["duedate"], "dateadded" => $shot["dateadded"], "scene" => $shot["scene"], "frames" => $shot["frames"], "user" => $shot["user"], "task" => $shot["task"], "statuse" => $shot["statuse"], "priority" => $shot["priority"]);
			$done = array_replace_recursive($current, $json_delete);
			$done = json_encode($done);
			if(file_put_contents($file, $done, LOCK_EX)) {
				echo $LANG["shotdeleted"];
				echo $LANG["redirected"];
				redirect();
			} else {
				echo $LANG["eshotnotdeleted"];
				echo $LANG["redirected"];
				redirect();
			}
		}
	}
	if ($found==0) {
		echo $LANG["eshotnotdeleted"];
		echo $LANG["redirected"];
		redirect();
	}
} else {
	echo $LANG["noactiongiven"];
}	

?>
<p></p>	</div>
	<div class="col-md-1"></div>
</div>

<?php include 'footer.php';?>