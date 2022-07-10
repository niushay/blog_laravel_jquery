




https://user-images.githubusercontent.com/48344449/178140688-faca0707-e609-40b8-ab2a-6ac4a3e09aa7.mp4





This project is made by Laravel and it is authenticated by Passport package of Laravel.
In this project you can register new user, login and logout. When you logged in you can see all
posts that created by all users and filter them by writer and/or date. You can click each post to
see complete details. Each post has its own QR code that you can scan it with mobile phone and
redirect to the link of post.

You can create new post. JQuery validator will validate the data that you entered in
login and logout forms. You can export your own posts in excel format by the button in
the navbar.

1. Git clone from Github
* Open CMD (command-line interpreter)
* cd to your custom directory
* Clone codes by typing this line:
    * git clone https://github.com/niushay/blog_test.git

2. Open you custom IDE (for example: phpstorm, VSCode, ...)
3. Open the directory of the cloned files
4. Create new database with your own custom name
5. Change the name of .env.example to .env
6. Open .env file and change database field due to your database configurations
7. Uncomment extension=gd in php.ini file
8. composer update
9. php artisan migrate
10. php artisan passport:install
11. php artisan key:generate

