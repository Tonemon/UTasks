# UTask Informatica Eindproject
This is a repository for the UTasks project, which has been developed during a school project. This is not the final README.md file, an extended version will be published soon.

## About This Project
UTasks is a small planning software, which you can install locally or online on a webhost. This 'application' has a lot of small features, for example: creating/editing accounts, managing calender items, adding and managing task folders and more. This is developed using PHP & MySQL and I have used some Bootstrap and FontAwesome for the style elements. More information and ideas/features/bugs can be found on the [project boards](https://github.com/Tonemon/UTasks/projects).

## Installation
REMEMBER: This software is still a work in progess and it can happen that during the installation process (or after that) things can freeze or not work as they should. After a stable version of this application is released, this information will be removed from this page and updated.

To install this project on your (local) system, you will need to follow these steps:
1. Download the latest version of this project (by clicking the 'Clone or Download' button) to download a zip file containing all of the project files.
2. Make sure that you have **Apache** and **MySQL** installed on your system (I am using AMPPS for local hosting and development, which is easy to use. It's also really usefull, because it has all of the hosting functions in one place).
      * If you are using AMPPS, you need to add the domain 'utasks.me' using the 'configure' > 'Add domain' function. This will ensure that all of the links will redirect properly (You could get an error if you don't configure that, because you will be send to a page which isn't registered within AMPPS).
3. Unzip the zip file in your localhost directory (default location configured in AMPPS).
4. For optimal performance you should add the domain to your pc's 'hosts' file, so you can insert the domain in your webbrowser instead of using the 'localhost/utasks.me' domain and subfolder.
You will need to insert the following in your 'hosts' file: <pre>127.0.0.1   utasks.me</pre>
5. Go to your PHPMyAdmin (often default: localhost/phpmyadmin) and create the following databases: UTasksDAT and UTasksMAIN. Then create the following database user (name: UTasks, password: UTasks) and make sure that he has all rights enabled on **both databases**. This can be done by editing his permissions (Edit Privileges > Database > Add privileges on following databases > Grant all & Go, in phpmyadmin).
6. Import both .sql files in the correct database (UTasksDAT.sql in UTasksDAT database and UTasksMAIN.sql in UTasksMAIN database).
7. Go to the <a href="http://utasks.me" target="_blank">homepage</a> or the <a href="http://utasks.me/login" target="_blank">login page</a> and log in with the following credentials:
<pre>Username: admin / Email: admin@utasks.me, password: adminpassword
Username: normal / Email: normal@utasks.me, password: normalpassword</pre>

## Database layout
<details>
  <summary>I have used the following database layout in this project</summary>
  <pre>UTasksDAT: label*userid* & tasks*userid* (two mysql tables per account)
UTasksMAIN: premiumreq, questions, users, usersclosed & usersnew</pre>
</details>