#Install Composer
docker run --rm -v $(pwd):/app composer install
#Bring up containers
docker-compose up -d
#Setup env variables
docker-compose exec app cp .env.example .env
#Prep DB
docker-compose exec app php artisan migrate:fresh --seed
#Setup Passport Auth
docker-compose exec app php artisan passport:install