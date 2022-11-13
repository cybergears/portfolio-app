# Portfolio App
Dynamic Portfolio application based upon core php , mysql, html, css, jquery/js.

# Introduction
This is a full featured resume web application which can be used as a portfolio website.
This application is based upon the following technology:
1. PHP
2. MySql
3. HTML
4. CSS
5. JS/Jquery Libs.

# Features
1. Light Weight
2. Full Featured Admin Panel to manage the website

# License
This application is available under GNU GPL v3 Licence.

# Deployment Instructions
1. env.php
2. db_script/cv.php

"env.php" is the configuration file for the application. Here you can set the db credentials and other application peremeters.

This application is configured to handle two type of DB and PATH credentials i.e. local and production

'BASEPATH' => Set the url to your environment in both production and local

## Database Configuration
'DB_HOST' => for Database Host

### Local
'DEV_DB_USER' => DB User
'DEV_DB_PASS' => DB Pass
'DEV_DB_NAME' => DB Name

### Production
'PROD_DB_USER' => DB User
'PROD_DB_PASS' => DB Pass
'PROD_DB_NAME' => DB Name

In Production mode set 'DISPLAY_ERRORS'=>0 


After configuring the env.php you have to create a database with the same name mentioned above acording to your mode (Local or Production) . Then import the db file from 'db_script/sv.sql'.

## Note
This application uses seo friendly url links. The application is developed in Apache environment so in order to use it in Nginx Environment you will have to change the .htaccess rules to Nginx Rules.

## Admin Panel Details
'URL' => https://yourdomain.com/admin/
'Default Username' => admin
'Default Password' => !Admin@123

# Credits
'Frontend' => TemplateFlip - https://templateflip.com/

'Admin Panel UI' => Hope UI - https://hopeui.iqonic.design/

'Backend/ Frontend Developer' => Shahrukh Sheikh (Me)

# Live Example
'Website' => https://shahrukhsheikh.in/





