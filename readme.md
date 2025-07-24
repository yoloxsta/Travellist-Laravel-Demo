# Travellist - Laravel Demo App

```
docker-compose build app
docker-compose up -d
docker-compose exec app ls -l
docker-compose exec app rm -rf vendor composer.lock
docker-compose exec app composer install
docker-compose exec app php artisan key:generate

---

docker-compose down
docker-compose build --no-cache
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan key:generate

---
# for dev-compose (mz-db-laravel)

docker-compose exec laravel.test composer install
docker-compose exec laravel.test composer update
mkdir -p bootstrap/cache storage/framework/{cache,sessions,views}
sudo mkdir -p bootstrap/cache storage/framework/{cache,sessions,views}
sudo chmod -R 777 storage bootstrap/cache
ls -ld storage/
sudo chown -R $USER:$USER .
ls -ld storage/
ls -l storage/framework/
docker-compose exec laravel.test composer update
docker exec name cat /var/www/html/.env

---
# check docker images archi

- docker image inspect imagename:latest --format='{{.Architecture}}'

---
docker build -t Name -f docker/production/Dockerfile .
docker run -d -p 8002:80 --name something ImageName

```
