# PHP Task/Todo list by Raymii.org

<img src="https://raymii.org/cms/images/tasks.php4.png" alt="screenshot" width="480" height="320" /> 

## Info
This is a task/todo list written in PHP.  
It uses a JSON text file for the tasks, and the visual side is created with the HTML5 Kickstart framework by Joshua Gatcke.

### Why use this over something like remember the milk, wunderlist or any other cloud service? 

- No ads
- Nobody selling your data
- Nobody monitoring your activity
- Data is easy to get out (no vendor lock-in) and to backup.
- Offline mode? Host it on your local machine with a LAMP/WAMP/MAMP server.
- Sync? Use a syncing service on the hosts ([owncloud](http://owncloud.org) and [sparkleshare](http://sparkleshare.org) are quite good) and point the program to a json file in that folder.
- Offline sync? Combine above 2 points, or put the software in a git, svn or other version control system repo.


## Changelog

### v0.0.2

- Task can now have priorities
- Task can now have a due date
- Thrash bin for deleted tasks is added
- Task list is now sortable
- Layout change, more space for tasks
- Days left / days late is now shown
- i18n added, ships with dutch and english by default.

### v0.0.1

- Initial release
- Add tasks
- Remove tasks
- Edit tasks
- Finished tasks

## Features

- Add/Remove/Update tasks
- Prioritize tasks
- Due date on tasks, time left/late shown.
- Trash bin for deleted tasks
- No database required
- i18n (Dutch and engish by default).

## Download
Either *git clone* the github repo:

    git clone git://github.com/RaymiiOrg/tasks.php.git

Or download the zipfile from github:

[https://github.com/RaymiiOrg/tasks.php/zipball/master](https://github.com/RaymiiOrg/tasks.php/zipball/master)

Or download the zipfile from Raymii.org
    
[https://raymii.org/cms/content/downloads/tasks.php-0.0.2.zip](https://raymii.org/cms/content/downloads/tasks.php-0.0.2.zip)


## Install

Unzip the file and upload to the web-directory (public_html, /var/www/, /srv/httpd etc..) and make sure that the webserver can write to the json file (chown www-data:www-data task.json or chmow 777 task.json).


## License
see license.txt.


## Links

Raymii.org: https://raymii.org/cms/
HTML5 Kickstart: https://github.com/joshuagatcke/HTML-KickStart 