## About the project
This project is take home based project for PT NIS Recruitment Process after written test at 22/10/2024 and Interview at 23/10/2024.

<b>Feature</b>
<ul>
    <li>Report Module</li>
    <li>Approval</li>
    <li>Master Data (User, Department, Section)</li>
    <li>Summary Dashboard Report</li>
    <li>Print Report</li>
</ul>

<b>User Role</b>
<ul>
    <li>User. Sample username / password: user / user</li>
    <li>Reviewer. Sample username / password: reviewer / reviewer</li>
    <li>Approver. Sample username / password: approver1 / approver1</li>
    <li>Admin. Default username / password: admin / admin</li>
</ul>

## Technologies
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)

## Templates
TABLER - Tabler is a free and open source web application UI kit based on Bootstrap 5, with hundreds responsive components and multiple layouts.

[https://github.com/tabler/tabler](https://github.com/tabler/tabler)

## How to Install and Development the Application
1. Open Terminal and Clone Project from Repository Github.
    - Use HTTPS
        ```
        git clone https://github.com/kusumaedi/project-report-nsi.git
        ```
    - Use SSH *must generate SSH Key first
        ```
        git clone git@github.com:kusumaedi/project-report-nsi.git
        ```
2. Go to the project after the clone process is complete.
    ```
    cd project-report-nsi
    ```
3. Install all the dependencies using composer
    ```
    composer install
    ```
    or
    ```
    composer update
    ```
4. Copy the .env.example file and make the required configuration changes in the .env file
    ```
    cp .env.example .env
    ```
    set your database connection in .env file.
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your-database
    DB_USERNAME=your-username
    DB_PASSWORD=your-password
    ```
5. Generate a new key application
    ```
    php artisan key:generate
    ```
6. Migrate the database
    ```
    php artisan migrate
    ```
7. Inject master data sample, default admin account user, into database
    ```
    php artisan db:seed
    ```
