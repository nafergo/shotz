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


# First open the JSON file
$file = file_get_contents("storage/shot.json") or die("Cant open JSON file. Does it exist? Error code x51.");
#now check if it is a valid file
$json_debug = json_decode($file, true) or die("Cant decode JSON file. Is it a valid JSON file? Error code x61.");



echo "<h1>".$projectname."</h1>";
echo "<h2>JSON FILE</h2>";
echo "<h2>Debug</h2>";
echo "<pre>";
print_r($json_debug);
echo "</pre>";

echo "<hr /><h2>LANGUAGE FILE</h2>";
echo "<pre>";
print_r($LANG);
echo "</pre>";


echo "</div>";

?>