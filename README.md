<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Установка

db: laravel_test

1. Зарегистрироваться в [Mail faker](https://mailtrap.io/), установить [docker](https://www.docker.com/)
2. Создать директорию для проекта
3. Внутри директории склонировать [laradock](https://laradock.io/)
4. Склонировать этот репозиторий, скопировать из него .laradock.env в laradock/.env (laradock)
5. cd test
6. скопировать .env.example в корень с именем .env, настроить [Mail faker](https://mailtrap.io/)
6. cd ../laradock
7. docker-compose up -d mysql nginx workspace
8. docker-compose exec workspace bash
9. composer install
10. php artisan key:generate
11. php artisan migrate --seed, тут нужно будет ввести учетные данные для менеджера, соответственно с [Mail faker](https://mailtrap.io/) 
12. php artisan queue:work --daemon 
