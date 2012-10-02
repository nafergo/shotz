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

include("header.php");

	echo "<h2>Tasks</h2>";

	showinputform("action.php");

	echo "<p></p>";

	listtasks($json_a,"open","table");

	echo "<p></p>";
	echo "<h2>Finished tasks</h2>";
	listtasks($json_a,"closed","table");


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
