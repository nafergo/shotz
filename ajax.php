
  <?php 

$LANG=NULL;
require('language.en.php');


$file="shot.json";

$jsonfile = file_get_contents($file);
$json_b = json_decode($jsonfile, true);
$json_a = $json_b["shots"];
$closed=0;
$haveshots = 0;
error_reporting(0);

$user=$_POST['user'];
$item=$_POST['id'];
$shotid=$_POST['id'];
$task=$_POST['task'];
$statuse=$_POST['statuse'];
  
  foreach ($json_a as $item => $shot) {
    if ($item == $shotid) {
      $found = 1;
      $current = file_get_contents($file);
      $current = json_decode($current, TRUE);
      $json_update["shots"]["$item"] = array("user" => $user, "task"=> $task, "statuse"=>$statuse );
      $replaced = array_replace_recursive($current, $json_update);
      $replaced = json_encode($replaced,JSON_PRETTY_PRINT);
      if(file_put_contents($file, $replaced, LOCK_EX)) {
       //
      } else {
       echo "Houston, we have a problem!";
      }
    }
  }     


?>