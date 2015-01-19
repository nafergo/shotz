<?php 
// Copyright (c) 2012 Remy van Elst
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:

// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.

?>
<p></p>
<br>
<p></p>
<br>
<p></p>
<div class="row">
	<div class="container-fluid">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		

                         <!-- Button Credits trigger modal -->
<a class="btn btn-link" data-toggle="modal" data-target="#CreditsModal"><small>Credits</small></a>

<!-- Modal -->
<div class="modal fade" id="CreditsModal" tabindex="-1" role="dialog" aria-labelledby="CreditsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="CreditsModalLabel">Credits</h2>
      </div>
      <div class="modal-body">
   
   <p>Shotz is a modified version of the <a href="https://github.com/RaymiiOrg/tasks.php" target="_blank">tasks.php</a> script written by Remy van Elst.</p>
   <p>Shotz was developed by nafergo (animaxionstudioz.com), with the precious help of <a href="https://github.com/ivanterra" target="_blank">Ivan Terra</a>, 
   for internal/personal use.</p>
      
     		    <p>Shotz uses the <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a> framework, 
     		    <a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome</a> icons and
     		    <a href="http://www.google.com/fonts/specimen/Open+Sans" target="_blank">Open Sans</a> font.</p>
     		    
      		    <p>Contacts:</p>  
<p><i class="fa fa-envelope-o"></i> nafergo[AT]animaxionstudioz[DOT]com</p>
<p><i class="fa fa-github-alt"></i> <a href="https://github.com/nafergo/shotz/" target="_blank">Shotz repository</a></p>
      		        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>



                         <!-- Button trigger modal -->
<a class="btn btn-link" data-toggle="modal" data-target="#HelpModal"><small>Help</small></a>

<!-- Modal -->
<div class="modal fade" id="HelpModal" tabindex="-1" role="dialog" aria-labelledby="HelpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="HelpModalLabel">Help</h2>
      </div>

      <div class="modal-body">

<h3>What is this?</h3>
<p>Shotz is a simple php web-based shot/task list management for short movie productions.</p>
      
<h3>Is this free?</h3>
<p>Check the <a href="https://github.com/nafergo/shotz/blob/master/license.txt" target="_blank">License</a>. Shotz has different authors, it's a modified version of a previous existent 
platform (<a href="https://github.com/RaymiiOrg/tasks.php" target="_blank">tasks.php</a>) and uses some non-original components (Bootstrap, Open Sans, Font Awesome). But let's keep this simple: Shotz is Free/Libre Software. You can install, modify, redistribute, etc. </p>

<h3>Where is the source-code?</h3>
<p>Please, visit <a href="https://github.com/nafergo/shotz/" target="_blank">Shotz repository at GitHub</a>. Download and just edit the files. Everything you need is there :)</p>

<h3>Where is the database?</h3>
<p>Shotz uses a simple flat file for storage. It's a JSON text file called shot.json.</p>

<h3>What about bugs, ideas and roadmap?</h3>
<p>If you have any bugs to report or ideas, please create a new issue in the repository but... There
 are no current plans to develop this any further. Our development goes in a strict as-needed policy.</p>

<h3>It doesn't work!!!</h3>
<p>If you have problems, please check folder/file permissions. Make sure that the webserver can write to the json file.</p>

<h3>How do I empty the Trash Bin?</h3>
<p>That's a "feature" from the original code of <a href="https://github.com/RaymiiOrg/tasks.php" target="_blank">tasks.php</a>. We will probably change this sooner or later but it's not 
an important issue for us right now. For now, just edit the shot.json file ;)</p>

<h3>Contacts?</h3>
<p><i class="fa fa-envelope-o"></i> nafergo[AT]animaxionstudioz[DOT]com</p>
<p><i class="fa fa-github-alt"></i> <a href="https://github.com/nafergo/shotz/" target="_blank">Shotz repository</a></p>
      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>




</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
				
		<div class="pull-right">
	
				<p class="pull-right"><a href="#top-of-page">Back to top</a></p>
		</div>				
				
				
				
	</div>
	</div>
</div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<script src="js/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
 

        <script type="text/javascript">
        $(document).ready(function(){
            $("[rel=tooltip]").tooltip();


            });
        </script>
        
        <script>
$(document).ready(function(){

  $(".select_user,.select_statuse,.select_task" ).change(function() {
  	//alert(this.id);
    user=$("#"+this.id+".select_user" ).find(":selected").text(); 
     statuse=$("#"+this.id+".select_statuse").find(":selected").text();
     task=$("#"+this.id+".select_task").find(":selected").text();



     $.ajax({
          type: "POST",
          url: "ajax.php",
          data:  {id: this.id, user: user, statuse: statuse, task: task },
          cache: false,         
          success: function(dadosajax)
          {
          if(dadosajax.lenght>1)
          {
          alert(dadosajax);
          }        
          }
        });


});

$(function(){
$("#sortedtable").tablesorter({ sortList: [[2,0]] });
});


});
</script>

<script type="text/javascript">
  $(function() {
    $('#datetimepicker4').datetimepicker({
      pickTime: false
    });
  });
</script>


</body></html>
