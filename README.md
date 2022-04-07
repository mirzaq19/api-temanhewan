# API Temanhewan

This repository is api project to provide data using api for temanhewan website. This api using laravel framework for base project

### Group Member of Pencatat Handal's Team
1. M. Auliya Mirzaq Romdloni    05111940000065
2. Husin Muhammad Assegaff      05111940000127
3. Ahmad Syafiq Aqil Wafi       05111940000089
4. Afifan Syafaqi Yahya         05111940000234

### System Requirements
1. PHP v8.0
2. Composer
3. Docker

### How to install 
1. Clone this repository to your local machine
2. In **root** directory Copy `.env.example` file to `.env` and fill as you need
3. In `./src` directory and copy `.env.example` file to `.env` and change in database section like this

   ```.env
    DB_CONNECTION=mysql
    DB_HOST=temanhewan-db             # service name in docker-compose
    DB_PORT=3306                      # expose port
    DB_DATABASE=temanhewandb          # database name
    DB_USERNAME=gcoder                # user
    DB_PASSWORD="secret123#"          # password
   ```
4. Back to root directory and type command `docker container exec -it temanhewan-api sh` in terminal to access container terminal.
5. **In container terminal**, install dependency by typing command `composer install` and generate app key `php artisan key:generate`
7. Exit from container terminal and type command `docker-compose up -d` to create container
