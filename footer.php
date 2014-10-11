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
	<div class="col-md-1"></div>
	<div class="col-md-5">

                         <!-- Button trigger modal -->
<a class="btn btn-link" data-toggle="modal" data-target="#VERSOESModal"><small>Credits</small></a>

<!-- Modal -->
<div class="modal fade" id="VERSOESModal" tabindex="-1" role="dialog" aria-labelledby="VERSOESModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="VERSOESModalLabel">Credits</h4>
      </div>
      <div class="modal-body">
      
      		    <?php echo "<p>".$LANG["infotext"]."</p>"; ?>
      		    <p>Shotz is based on the <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a> framework.</p>
      		    <p>For questions contact nafergo[AT]animaxionstudioz[DOT]com</p>
      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

      </div>
    </div>
  </div>
</div>
</div>

	<div class="col-md-5">
				
		<div class="pull-right">
	
				<p class="pull-right"><a href="#top-of-page">Back to top</a></p>
		</div>				
				
				
				
	</div>
	<div class="col-md-1"></div>
</div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

<script src="js/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>

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

</body></html>
