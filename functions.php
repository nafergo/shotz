<?php

$file="task.json";
$jsonfile = file_get_contents($file);
$json_a = json_decode($jsonfile, true);
$closed=0;
$havetasks = 0;

function showinputform($actionpage) {
    echo "<form name=\"edit\" action=\"".$actionpage."\" method=\"GET\">";
    echo "<input name=\"content\" type=\"text\" placeholder=\"Add new task...\" ></input>";
    echo "<input type=\"hidden\" name=\"action\" value=\"add\"></input>";
    echo "&nbsp; &nbsp; ";
    echo "<input type=\"submit\" name=\"submit\" value=\"Add Task\"></input>";
    echo "</form>";
}

function listtasks($json_a,$outputformat) {
    

    switch ($outputformat) {
        case 'table':
            echo "<table class=\"striped\">";
                echo "<tr>";
                    echo "<th>#</th>";
                    echo "<th>Task</th>";
                    #echo "<th>Date added</th>";
                    #echo "<th>Due date</th>";
                    #echo "<th>Priority</th>";
                    echo "<th>Action</th>";
                echo "</tr>";
            break;
        }

            if(is_array($json_a)) {     
                $tasknumber=1;
                foreach ($json_a as $item => $task) {
                    if ($task['status'] == "open") {    
                        $havetasks=1;
                        
                        switch ($outputformat) {
                            case 'table':
                                echo "<tr>";
                                    #number
                                    echo "<td>".$tasknumber."</td>";
                                    #task
                                    echo "<td>" . $task['task'] . "</td>";
                                    #date added
                                    #echo "<td>".$dateadded."</td>";
                                    #due date
                                    #echo "<td>".$duedate."</td>";
                                    #prio
                                    #echo "<td>".$priority."</td>";
                                    #action:
                                    echo "<td>";
                                        #done
                                        echo "<a href=\"action.php?id=" .$item. "&action=done\"><span class=\"icon small darkgray\" data-icon=\"C\"></span></a>";
                                        #edit
                                        echo " - ";
                                        echo "<a href=\"action.php?id=" .$item. "&action=edit\"><span class=\"icon small darkgray\" data-icon=\"7\"></span></a>";
                                        #delete
                                        echo " - ";
                                        echo "<a href=\"action.php?id=" .$item. "&action=delete\"><span class=\"icon small darkgray\" data-icon=\"T\"></span></a>";
                                    echo "</td>";
                                echo "</tr>";
                                break;
                        }
                        $tasknumber+=1;
                    }   
                }
                if($havetasks == 0) {
                    switch ($outputformat) {
                        case 'table':
                            echo "<tr><td colspan=3>No tasks. Add a task first please.</td></tr>";  
                            break;
                    }
                }
            } else { 
               switch ($outputformat) {
                     case 'table':
                        echo "<tr><td colspan=3>No tasks. Add one first please.</td></tr>";  
                        break;
                    }
            }

            switch ($outputformat) {
                case 'table':
                    echo "</table>";
                    break;
            }

    }


?>