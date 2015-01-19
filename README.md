# Shotz

Shotz is a simple php web-based shot/task list management for short movie productions. You can add/edit/delete shots to a simple flat file database (JSON text file). Each shot has an artist assigned, current task, status and due date. There are no current plans to develop this any further, development goes in a strict as-needed policy.

You can easily create a shot, choose/edit the current task of the shot (for example, modeling or compositing), choose/edit the assigned user and choose/edit the status (for example, on going or rendering). You can close shots when they are finished or delete them. Shotz displays the number and % of shots done and frames rendered.

Shotz was developed by nelson gonçalves (nafergo) with the precious help of Ivan Terra.

## License
Check license file - https://github.com/nafergo/shotz/blob/master/license.txt

## Description

Shotz is based on:
* tasks.php by RaymiiOrg (Remy van Elst) https://github.com/RaymiiOrg/tasks.php
* bootstrap framework https://github.com/twbs/bootstrap

Main features:
* add/edit/delete shots and tasks via webpage
* bootstrap interface
* assign users to shots/tasks
* simple install, no database required (uses a JSON text file)
* prioritize shots
* due date on shots, time left/late shown.
* trash bin for deleted shots
* easy add/edit user list, task list and statuses list
* display the number and % of shots done and frames rendered
* easy translation


 

## Installation
1.  unzip, upload the files to your web server and visit index.php

## Frequently Asked Questions

### Where is the source-code?
Just edit the files. Everything you need is inside :)

### What about bugs and ideas?
If you have any bugs to report or ideas, please create a new issue.


### Support
If you have problems, we suggest you check folder/file permissions. Make sure that the webserver can write to the json file.
