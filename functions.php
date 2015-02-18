<?php
header('Content-Type: text/html; charset=utf-8');
?>

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


$LANG=NULL;
require('language.en.php');


$file="storage/shot.json";

$jsonfile = file_get_contents($file);
$json_b = json_decode($jsonfile, true);
$json_a = $json_b["shots"];
$closed=0;
$haveshots = 0;
error_reporting(0);


function showinputform($actionpage) {
    global $LANG;
    $vandaag=date('m-d-Y');
    echo "<table class=\"table\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th class=\"priorities priority_column\">".$LANG["priority"]."</th>";
    echo "<th class=\"scene_column\">".$LANG["scene"]."</th>";
    echo "<th class=\"shot_column\">".$LANG["shot"]."</th>";
    echo "<th class=\"\">".$LANG["frames"]."</th>";
    echo "<th class=\"user_column\">".$LANG["user"]."</th>";
    echo "<th class=\"task_column\">".$LANG["task"]."</th>";
    echo "<th class=\"statuse_column\">".$LANG["statuse"]."</th>";        
    echo "<th class=\"duedate_column2 \">".$LANG["duedate"]."</th>";
    echo "<th class=\"\"></th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";  
    echo "<tr>";
    echo "<td class=\"priorities\">";
    echo "<form name=\"edit\" action=\"action.php\" method=\"GET\">";
    echo "<select class=\"form-control\" name=\"prio\">\n";
        echo "<option value=\"2\">".$LANG["normal"]."</option>\n";
        echo "<option value=\"1\">".$LANG["high"]."</option>\n";
        echo "<option value=\"3\">".$LANG["low"]."</option>\n";
        echo "<option value=\"4\">".$LANG["onhold"]."</option>\n";
        echo "</select>\n";
    echo "</td><td>";  
    echo "<input name=\"scene\" class=\"form-control\" type=\"text\" placeholder=\"".$LANG["shotscene"]."\" ></input>";
    echo "</td><td>";
    echo "<input name=\"shot\" class=\"form-control\" type=\"text\" placeholder=\"".$LANG["shottodo"]."\" ></input>";
    echo "</td><td>";
    echo "<input name=\"frames\" class=\"form-control framesinput\" type=\"number\" placeholder=\"".$LANG["framesduration"]."\" ></input>";
    echo "</td><td>";
    
    $users = file('storage/users.txt');
$options = '';
foreach ($users as $user) {
    $options .= '<option value="'.$user.'">'.$user.'</option>';
}
$select = '<select class="form-control" name="user" >'.$options.'</select>';

echo $select;
    
 //   echo "<input name=\"user\" size=10 type=\"text\" placeholder=\"".$LANG["shotuser"]."\" ></input>";
	 echo "</td><td>";
    $tasks = file('storage/tasks.txt');
$options = '';
foreach ($tasks as $task) {
    $options .= '<option value="'.$task.'">'.$task.'</option>';
}
$select = '<select class="form-control" name="task">'.$options.'</select>';

echo $select;
    
 
	 echo "</td><td>";

$statuses = file('storage/statuses.txt');
$options = '';
foreach ($statuses as $statuse) {
    $options .= '<option value="'.$statuse.'">'.$statuse.'</option>';
}
$select = '<select class="form-control" name="statuse">'.$options.'</select>';

echo $select;
    
 
	 echo "</td><td class=\"duedate\">";
    echo "<div id=\"datetimepicker4\" class=\"input-group\"><input placeholder=\"MM-DD-YYYY\" class=\"form-control\" data-format=\"MM-dd-yyyy\" name=\"duedate\" size=10 type=\"text\" value=\"${vandaag}\"></input><div class=\"input-group-addon add-on\"><i data-time-icon=\"icon-time\" data-date-icon=\"icon-calendar\" class=\"fa fa-calendar\"></i></div></div>\n";
    echo "</td><td class=\"pull-right\">";
    echo "<input type=\"hidden\" name=\"action\" value=\"add\"></input>";
    echo "<input name=\"dateadded\" type=\"hidden\" value=\"${vandaag}\"></input>\n";
    echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-default\">".$LANG["addshot"]."</button>";
    echo "</form>";   
    echo "</tbody>";    
    echo "</table>";
}

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ((array) $arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}

# via http://richardathome.wordpress.com/2006/03/28/php-function-to-return-the-number-of-days-between-two-dates/
function dateDiff($start, $end) {
    $start_ts = strtotime($start);
    $end_ts = strtotime($end);
    $diff = $end_ts - $start_ts;
    return round($diff / 86400);
}




function listshots($json_a,$shotstatus,$outputformat) {
    global $LANG;
    $vandaag=date('d-m-Y');
    $haveshots = NULL;
    
    array_sort_by_column($json_a, 'priority');

        echo "<table id=\"shots_table\" class=\"table display table-striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th class=\"priorities priority_column\">".$LANG["priority"]."</th>";
        echo "<th class=\"scene_column\">".$LANG["scene"]."</th>";
        echo "<th class=\"shot_column\">".$LANG["shot"]."</th>";
        echo "<th class=\"frames_column\">".$LANG["frames"]."</th>";
       echo "<th class=\"user_column\">".$LANG["user"]."</th>";   
        echo "<th class=\"task_column\">".$LANG["task"]."</th>";
        echo "<th class=\"statuse_column\">".$LANG["statuse"]."</th>";
        echo "<th class=\"daysopen_column\">".$LANG["daysopen"]."</th>";
        echo "<th class=\"duedate duedate_column\">".$LANG["duedate"]."</th>";

        echo "<th class=\"buttons_column\">Actions</th>";
        echo "</tr>";
        echo "</thead>";
                    echo "<tbody>";     

    if(is_array($json_a)) {     
        $shotnumber=1;
        $haveshots=NULL;
        foreach ($json_a as $item => $shot) {
            if ($shot['status'] == $shotstatus) {  
            
                $haveshots=1;


                        echo "<tr id=".$item.">";
                                    #Prio
                    echo "<td class=\"priorities\">";

                    switch ($shot["priority"]) {
                        case 1:
                            echo "<div class =\"high_priority\">".$LANG["high"]."</div>";
                            break;
                        case 2:
                            echo "<div class =\"normal_priority\">".$LANG["normal"]."</div>";
                            break;
                        case 3:
                            echo "<div class =\"low_priority\">".$LANG["low"]."</div>";
                            break;
                        case 4:
                            echo "<div class =\"onhold_priority\">".$LANG["onhold"]."</div>";
                            break;
                    }

                    echo "</td>";
                    $dayopen = NULL;
                                    #shot
                    echo "<td>".$shot['scene']."</td>";
                    echo "<td>".$shot['shot']."</td>";
                    if ($shotstatus == "open") {
                        $dayopen = dateDiff(str_replace('-', '/',$shot["dateadded"]),$vandaag);
                    } elseif ($shotstatus == "closed"  || $shotstatus == "deleted" && preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/',$shot["donedate"])) {
                        $dayopen = dateDiff(str_replace('-', '/',$shot["dateadded"]),str_replace('-', '/',$shot["donedate"]));
                       
                    } elseif ($shotstatus == "closed" || $shotstatus == "deleted" && !preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/',$shot["donedate"])) {
                        $dayopen = "-";
                    }

                    echo "<td>".$shot['frames']."</td>";
                    
 $users = file('storage/users.txt');
$options = '';
 $options .= '<option value="'.$shot["user"].'">'.html_entity_decode($shot["user"]).'</option>';
foreach ($users as $user) {
       
    $options .= '<option value="'.$user.'">'.$user.'</option>';
}
$select = '<select class="form-control select_user" name="user" id="'.$item.'">'.$options.'</select>';

echo "<td class=\"artist_column\">".$select."</td>";


 $tasks = file('storage/tasks.txt');
$options = '';
$options .= '<option value="'.$shot["task"].'">'.html_entity_decode($shot["task"]).'</option>';
foreach ($tasks as $task) {
    $options .= '<option value="'.$task.'">'.$task.'</option>';
}
$select = '<select class="form-control select_task" name="task" id="'.$item.'">'.$options.'</select>';

              echo "<td class=\"task_column\">".$select."</td>";



   $statuses = file('storage/statuses.txt');
$options = '';
$options .= '<option value="'.$shot["statuse"].'">'.html_entity_decode($shot["statuse"]).'</option>';
foreach ($statuses as $statuse) {
    $options .= '<option value="'.$statuse.'">'.$statuse.'</option>';
}
$select = '<select class="form-control select_statuse" name="statuse" id="'.$item.'">'.$options.'</select>';

                echo "<td class=\"status_column\">".$select."</td>";              

                    echo "<td class=\"daysopen_column\">".$dayopen."</td>";

                    #due date
                    echo "<td class=\"duedate\">";
                    $dayclosed = $shot["duedate"];
                    switch ($shot["duedate"]) {
                        case '-':
                            echo "-";
                            break;
                       
                        default:
                            $matches=NULL;

                            if (preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/', $shot["duedate"],$matches)) {
                                $shotduedate=$matches[0];
                                $daysclosed = dateDiff($vandaag,str_replace('-', '/',$shotduedate));
                                

                                if ($daysclosed < 0) {
                                    $daysclosed = "<font class=\"text-danger\">" .abs($daysclosed) . $LANG["dayslate"] . " <br>(".date('D d M',strtotime(str_replace('-', '/',$shotduedate))).")</font>";
                                } elseif ($daysclosed == 0) {
                                    $daysclosed = "<font class=\"text-warning\">".$LANG["today"]." <br>(".date('D d M',strtotime(str_replace('-', '/',$shotduedate))).")</font>";


                                } else {
                                        $daysclosed = "<font class=\"text-success\">" . $daysclosed . $LANG["daysleft"] ." <br>(".date('D d M',strtotime(str_replace('-', '/',$shotduedate))).")</font>";
                                }
                            }                            

                            if ($shotstatus == "closed" || $shotstatus == "deleted") {

                                echo date('D d M',strtotime(str_replace('-', '/',$shotduedate)));
                            } else {
                                echo $daysclosed;
                            }

                            
                            break;

                    }

                    echo "</td>";
                                    #action:
                    echo "<td nowrap class=\"action_buttons\">";

                    switch ($shotstatus) {
                        case 'open':
                                            #done
                        echo "<a type=\"button\" class=\"btn btn-success\" href=\"action.php?id=" .$item. "&action=done\" rel=\"tooltip\" data-placement=\"top\" alt=\"Shot done!\" title=\"Shot done!\"><i class=\"fa-lg fa fa-check-square-o\"></i></a>";
                                            #edit
                        echo "  ";
                        echo "<a type=\"button\" class=\"btn btn-warning\" href=\"action.php?id=" .$item. "&action=edit\" rel=\"tooltip\" data-placement=\"top\" alt=\"Edit\" title=\"Edit\"><i class=\"fa-lg fa fa-pencil-square-o\"></i></a>";
                                            #delete
                        echo "  ";
                        echo "<a type=\"button\" class=\"btn btn-danger\" href=\"action.php?id=" . $item . "&action=delete\" rel=\"tooltip\" data-placement=\"top\" alt=\"Delete\" title=\"Delete\"><i class=\"fa-lg fa fa-trash-o\"></i></a>";
                        break;

                        case 'closed':
                        echo "<a type=\"button\" class=\"btn btn-danger\" href=\"action.php?id=" .$item. "&action=delete\" rel=\"tooltip\" data-placement=\"top\" alt=\"Delete\" title=\"Delete\"><i class=\"fa-lg fa fa-trash-o\"></i></a>";
                        break;
                    }                                        
                    echo "</td>";
                    echo "</tr>";
                 
                $shotnumber+=1;
            }   
        }
        if($haveshots == 0) {
               
                echo "<tr><td colspan=6>".$LANG["noshots"]."</td></tr>";  
             
        }
    } else { 
     
       echo "<tr><td colspan=6>".$LANG["noshots"]."</td></tr>";  
    
}


    
    echo "</tbody>";
    echo "</table>";

}

function redirect($page = "index.php") {
    echo "<script type=\"text/javascript\">";
    echo "window.location = \"$page\" ";
    echo "</script>";
}


?>
