# Laravel Inception Exam

This is guide how to set up project

## Step 1: Environment Configuration

```bash
cp .env.example .env
```

## Step 2: Build and Start Docker Containers

```bash
docker-compose up -d --build
```


## Step 3: Build and Start Docker Containers

```bash
docker-compose up -d --build
```


## Step 4: Install Dependencies

```bash
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
```

## Step 5: Publish Sanctum Migrations

```bash
php artisan vendor:publish --tag=sanctum-migrations
```

## Step 6: Database Migrations

```bash
docker-compose exec app php artisan migrate
```

## Step 7: Database Seeding

```bash
docker-compose exec app php artisan db:seed
```


## Additional Commands
Running Artisan Commands: Use 
```bash
docker-compose exec app php artisan <command>
``` 
to run Artisan commands.

Access your MySQL database using 
```bash
docker-compose exec mysql mysql -u root -p
```
