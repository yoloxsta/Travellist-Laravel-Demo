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

```