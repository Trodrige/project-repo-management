# Repository Project Management Platform
---

## Project Overview

This is a web application to manage school projects in the form of files -pdf and zip files. They are two categories of users: Admin(Lecturers) and students, the admin has more priviledges than the student whose major activity on the plateform is to upload projects, download projects that belong to him/her and view other students projects. This app was built with Laravel framework. 

## How to Run the App 
1. Clone repository
2. In a terminal move to the directory you just cloned (cd the_repository_directory)
3. Run the following

    composer install
    -
    
    mv .env.example .env
    -

    php artisan key:generate
    -

4. Create a database and add it in the .env file, with the user name and password
5. Run the following

    php artisan migrate
    -

    php artisan serve
    -

6. Visit the site in your browser at http://localhost:8000



