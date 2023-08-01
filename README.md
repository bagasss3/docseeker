# docseeker

## Project Structure

```
├── app
|   ├── Http              
|       ├── Controllers   # API Controllers (handling request and response)
|   ├── Models            # Model for database tables
├── database              # Database migration tables
├── routes                # Web route resources
├── resources             # Css, javascript and page views
|   ├── css
|   ├── js
|   ├── views             # User Interface
|       ├── templates     # Section of the page that will be used on more than one page (ex: navbar)
|       ├── layout        # Main layout of the web
```

## How to Run The Project:
```
1.  Clone the docseeker repo from github using command line `git clone "repo-link"`
2.  Type `git checkout develop` to switch branch to branch develop
3.  If failed to switch branch, type `git pull origin` first then do step 2
4.  If success, type `composer i` in the project terminal
5.  Start Apache and MySQL from XAMPP Control Panel
6.  Create database with `docseeker` as its name in phpmyadmin
7.  Create .env file and fill it with the config from .env.example 
8.  Type `php artisan key:generate` in the project terminal
9.  Type `php artisan migrate` in the project terminal
10. Type `php artisan serve` in the project terminal
11. Done
```
