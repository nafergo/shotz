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


echo "<ul class=\"tabs left\">";
echo "<li><a href=\"#maintab\">".$LANG["tasks"]."</a></li>";
echo "<li><a href=\"#finishedtab\">".$LANG["finishedtasks"]."</a></li>";
echo "<li><a href=\"#thrashtab\">".$LANG["thrash"]."</a></li>";
echo "</ul>";


echo "<div id=\"maintab\" class=\"tab-content\">";
echo "<h2>".$LANG["addtask"]."</h2>";

echo "<p>";

showinputform("action.php");

echo "</p>";

echo "<p>";
echo "<h2>".$LANG["todo"]."</h2>";

listtasks($json_a,"open","table");

echo "</p>";


echo "</div> <!-- tab div -->";



echo "<div class=\"tab-content\" id=\"finishedtab\">";

echo "<h2>".$LANG["finishedtasks"]."</h2>";
	listtasks($json_a,"closed","table");

echo "</div> <!-- tab div -->";

echo "<div class=\"tab-content\" id=\"thrashtab\">";
echo "<h2>".$LANG["thrash"]."</h2>";

listtasks($json_a,"deleted","table");

echo "</div> <!-- tab div -->";

echo "</div><!--col_12 -->";

echo "<div class=\"col_6\">";

echo "<h2>".$LANG["info"] . "</h2><p>".$LANG["infotext"]."</p><p>".$projectname." - ".$projectversion."</p>";

echo "</div> <!-- col_ -->";


include("footer.php");
