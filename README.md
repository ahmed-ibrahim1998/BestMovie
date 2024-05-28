## Setup Dashboard Project

## Requirements

  - PHP 7.4+
  - Composer
  - Docker
  - Docker Compose
  - AWS Account


- First clone project on your device
    - copy .env.example and paste .env file
    - enter in env file to connect db.
    - Run ``` composer update```.
    - then Run ``` composer install```.
    - After Run ``` php artisan key:generate```.
    - Run ``` php artisan migrate:fresh --seed ``` .
    ## To Test All Api Crud 
- To Get All Movies go to on postman app  ```http://localhost/Task/BestMovie/api/movies```
- To Add Movie go to postman app  ```http://localhost/Task/BestMovie/api/movies``` and change the type of method to post and all end point you can check it from collection on postman 
- To add movie to watchlist All Movies go to postman app  ```http://localhost/Task/BestMovie/api/movies/{move_id}/watchlist```
- To add movie to favorite All Movies go to postman app  ```http://localhost/Task/BestMovie/api/movies/{move_id}/favorite```
- To add Filter   ```http://localhost/Task/BestMovie/api/movies/filter``` And you can check all end point in api.php file


- the login information as user to generate token on postman
    - login as admin
        - username `user@gmail.com`
        - password `password`
