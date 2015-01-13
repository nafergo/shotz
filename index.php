<?php include 'header.php';?>

<div class="row">
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
&nbsp;
		</div>
	</div>
</div>

<div class="row">
<div class="container-fluid">


	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">




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

?>

<ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#maintab"><?php echo "".$LANG["shots"]."";?></a></li>
<li><a data-toggle="tab" href="#finishedtab"><?php echo "".$LANG["finishedshots"]."";?></a></li>


<li>
<a href="#" data-toggle="modal" data-target="#usersModal">
  <?php echo "".$LANG["users"]."";?>
</a>


<!-- Modal -->
<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="userModalLabel">EDIT <?php echo "".$LANG["users"]."";?></h3>
        <h5><small><i class="fa fa-info-circle"></i> One name per line and no empty lines.</small></h5>
      </div>
      <div class="modal-body">

<?php
$usersmyfile = "users.txt";
if (isset($_POST['usersta'])) {
    $usersnewData = nl2br(htmlspecialchars($_POST['usersta']));
    $usershandle = fopen($usersmyfile, "w");
    fwrite($usershandle, $usersnewData);
    fclose($usershandle);
}
// ------------------------------------------------
if (file_exists($usersmyfile)) {

    $usersmyData = file_get_contents($usersmyfile);
}
?>


<form action="index.php" method="post">
<textarea class="form-control" name="usersta" id="userstextareaediting" rows="10">
<?php echo str_replace("<br />","",$usersmyData); ?>
</textarea>


      </div>
      <div class="modal-footer">
      
    		<button type="submit" name="usersBtn" class="btn btn-default">Submit</button>
      </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>
</li>



<li>
<a href="#" data-toggle="modal" data-target="#taskModal">
  <?php echo "".$LANG["task"]."";?>
</a>


<!-- Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="taskModalLabel">EDIT <?php echo "".$LANG["task"]."";?></h3>
        <h5><small><i class="fa fa-info-circle"></i> One task per line and no empty lines.</small></h5>
      </div>
      <div class="modal-body">

<?php
$taskmyfile = "tasks.txt";
if (isset($_POST['taskta'])) {
    $tasknewData = nl2br(htmlspecialchars($_POST['taskta']));
    $taskhandle = fopen($taskmyfile, "w");
    fwrite($taskhandle, $tasknewData);
    fclose($taskhandle);
}
// ------------------------------------------------
if (file_exists($taskmyfile)) {

    $taskmyData = file_get_contents($taskmyfile);
}
?>


<form action="index.php" method="post">
<textarea class="form-control" name="taskta" id="tasktextareaediting" rows="10">
<?php echo str_replace("<br />","",$taskmyData); ?>
</textarea>



      </div>
      <div class="modal-footer">
          		<button type="submit" name="taskBtn" class="btn btn-default">Submit</button>
          		</form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>
</li>



<li>
<a href="#" data-toggle="modal" data-target="#statuseModal">
  <?php echo "".$LANG["statuse"]."";?>
</a>


<!-- Modal -->
<div class="modal fade" id="statuseModal" tabindex="-1" role="dialog" aria-labelledby="statuseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="statuseModalLabel">EDIT <?php echo "".$LANG["statuse"]."";?></h3>
        <h5><small><i class="fa fa-info-circle"></i> One status per line and no empty lines.</small></h5>
      </div>
      <div class="modal-body">

<?php
$statusmyfile = "statuses.txt";
if (isset($_POST['statusta'])) {
    $statusnewData = nl2br(htmlspecialchars($_POST['statusta']));
    $statushandle = fopen($statusmyfile, "w");
    fwrite($statushandle, $statusnewData);
    fclose($statushandle);
}
// ------------------------------------------------
if (file_exists($statusmyfile)) {

    $statusmyData = file_get_contents($statusmyfile);
}
?>


<form action="index.php" method="post">
<textarea class="form-control" name="statusta" id="statustextareaediting" rows="10">
<?php echo str_replace("<br />","",$statusmyData); ?>
</textarea>


      </div>
      <div class="modal-footer">
      
     		<button type="submit" name="statusBtn" class="btn btn-default">Submit</button>
     		</form>
                		
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

      </div>
    </div>
  </div>
</div>
</li>





<li><a data-toggle="tab" href="#thrashtab"><?php echo "".$LANG["thrash"]."";?></a></li>


</ul>


<?php






echo "<div class=\"tab-content\">";


echo "<div id=\"maintab\" class=\"tab-pane active\">";
echo "<h2>".$LANG["addshot"]."</h2>";

echo "<p>";

showinputform("action.php");

echo "</p>";


echo "<h2>".$LANG["todo"]."<h4><small>Click on column headers to sort data</small></h4></h2>";
echo "<p>";
listshots($json_a,"open","table");

echo "</p>";


echo "</div> <!-- tab div -->";



echo "<div class=\"tab-pane\" id=\"finishedtab\">";

echo "<h2>".$LANG["finishedshots"]."</h2>";
echo "<p>";
	listshots($json_a,"closed","table");
echo "</p>";
echo "</div> <!-- tab div -->";

echo "<div class=\"tab-pane\" id=\"thrashtab\">";
echo "<h2>".$LANG["thrash"]."</h2>";
echo "<p>";
listshots($json_a,"deleted","table");
echo "</p>";
echo "</div> <!-- tab div -->";





echo "</div>";

?>

	</div>

</div>
</div>
<?php include 'footer.php';?>




