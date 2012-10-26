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

$projectname="Tasks";
$projectversion = "v0.0.3";

$LANG=NULL;
require('language.en.php');


$file="task.json";

$jsonfile = file_get_contents($file);
$json_b = json_decode($jsonfile, true);
$json_a = $json_b["tasks"];
$closed=0;
$havetasks = 0;
error_reporting(0);


function showinputform($actionpage) {
    global $LANG;
    $vandaag=date('m-d-Y');
    echo "<table class=\"striped\">";
    echo "<tr>";
    echo "<th><center>".$LANG["task"]."</center></th>";
    echo "<th>".$LANG["priority"]."</th>";
    echo "<th>".$LANG["duedate"]."</th>";
    echo "<th></th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>";
    echo "<form name=\"edit\" action=\"action.php\" method=\"GET\">";
    echo "<input name=\"task\" size=40 type=\"text\" placeholder=\"".$LANG["tasktodo"]."\" ></input>";
    echo "</td><td>";
    echo "<select name=\"prio\">\n";
        echo "<option value=\"2\">".$LANG["normal"]."</option>\n";
        echo "<option value=\"1\">".$LANG["high"]."</option>\n";
        echo "<option value=\"3\">".$LANG["low"]."</option>\n";
        echo "<option value=\"4\">".$LANG["onhold"]."</option>\n";
        echo "</select>\n";
    echo "</td><td>";
    echo "<input name=\"duedate\" type=\"text\" value=\"${vandaag}\"></input>\n";
    echo "</td><td>";
    echo "<input type=\"hidden\" name=\"action\" value=\"add\"></input>";
    echo "<input name=\"dateadded\" type=\"hidden\" value=\"${vandaag}\"></input>\n";
    echo "<input type=\"submit\" name=\"submit\" value=\"".$LANG["addtask"]."\"></input>";
    echo "</form>";
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




function listtasks($json_a,$taskstatus,$outputformat) {
    global $LANG;
    $vandaag=date('d-m-Y');
    $havetasks = NULL;
    
    array_sort_by_column($json_a, 'priority');

        echo "<table class=\"sortable striped\">";
        echo "<thead>";
        echo "<tr>";
        echo "<th>".$LANG["priority"]."</th>";
        echo "<th>".$LANG["task"]."</th>";
        echo "<th>".$LANG["daysopen"]."</th>";
        echo "<th>".$LANG["duedate"]."</th>";

        echo "<th> </th>";
        echo "</tr>";
        echo "</thead>";
     

    if(is_array($json_a)) {     
        $tasknumber=1;
        $havetasks=NULL;
        foreach ($json_a as $item => $task) {
            if ($task['status'] == $taskstatus) {  
            
                $havetasks=1;

                    echo "<tr>";
                                    #Prio
                    echo "<td>";

                    switch ($task["priority"]) {
                        case 1:
                            echo "<font color = \"red\" >".$LANG["high"]."</font>";
                            break;
                        case 2:
                            echo $LANG["normal"];
                            break;
                        case 3:
                            echo $LANG["low"];
                            break;
                        case 4:
                            echo "<font color = \"#0011ee\" >".$LANG["onhold"]."</font>";
                            break;
                    }

                    echo "</td>";
                    $dayopen = NULL;
                                    #task
                    echo "<td>".$task['task']."</td>";
                    if ($taskstatus == "open") {
                        $dayopen = dateDiff(str_replace('-', '/',$task["dateadded"]),$vandaag);
                    } elseif ($taskstatus == "closed"  || $taskstatus == "deleted" && preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/',$task["donedate"])) {
                        $dayopen = dateDiff(str_replace('-', '/',$task["dateadded"]),str_replace('-', '/',$task["donedate"]));
                       
                    } elseif ($taskstatus == "closed" || $taskstatus == "deleted" && !preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/',$task["donedate"])) {
                        $dayopen = "-";
                    }

                    echo "<td>".$dayopen."</td>";

                    #due date
                    echo "<td>";
                    $dayclosed = $task["duedate"];
                    switch ($task["duedate"]) {
                        case '-':
                            echo "-";
                            break;
                       
                        default:
                            $matches=NULL;

                            if (preg_match('/([0-9]{2}-[0-9]{2}-[0-9]{4})/', $task["duedate"],$matches)) {
                                $taskduedate=$matches[0];
                                $daysclosed = dateDiff($vandaag,str_replace('-', '/',$taskduedate));
                                

                                if ($daysclosed < 0) {
                                    $daysclosed = "<u>" .abs($daysclosed) . $LANG["dayslate"] . " (".date('D d M',strtotime(str_replace('-', '/',$taskduedate))).")</u>";
                                } elseif ($daysclosed == 0) {
                                    $daysclosed = "<b>".$LANG["today"]." (".date('D d M',strtotime(str_replace('-', '/',$taskduedate))).")</b>";


                                } else {
                                        $daysclosed = $daysclosed . $LANG["daysleft"] ." (".date('D d M',strtotime(str_replace('-', '/',$taskduedate))).")";
                                }
                            }                            

                            if ($taskstatus == "closed" || $taskstatus == "deleted") {

                                echo date('D d M',strtotime(str_replace('-', '/',$taskduedate)));
                            } else {
                                echo $daysclosed;
                            }

                            
                            break;

                    }

                    echo "</td>";
                                    #action:
                    echo "<td>";

                    switch ($taskstatus) {
                        case 'open':
                                            #done
                        echo "<a href=\"action.php?id=" .$item. "&action=done\"><span class=\"icon small darkgray\" data-icon=\"C\"></span></a>";
                                            #edit
                        echo "  ";
                        echo "<a href=\"action.php?id=" .$item. "&action=edit\"><span class=\"icon small darkgray\" data-icon=\"7\"></span></a>";
                                            #delete
                        echo "  ";
                        echo "<a href=\"action.php?id=" . $item . "&action=delete\"><span class=\"icon small darkgray\" data-icon=\"T\"></span></a>";
                        break;

                        case 'closed':
                        echo "<a href=\"action.php?id=" .$item. "&action=delete\"><span class=\"icon small darkgray\" data-icon=\"T\"></span></a>";
                        break;
                    }                                        
                    echo "</td>";
                    echo "</tr>";
                 
                $tasknumber+=1;
            }   
        }
        if($havetasks == 0) {
               
                echo "<tr><td colspan=6>".$LANG["notasks"]."</td></tr>";  
             
        }
    } else { 
     
       echo "<tr><td colspan=6>".$LANG["notasks"]."</td></tr>";  
    
}


    
    echo "</table>";


}

function redirect($page = "index.php") {
    echo "<script type=\"text/javascript\">";
    echo "window.location = \"$page\" ";
    echo "</script>";
}


?>