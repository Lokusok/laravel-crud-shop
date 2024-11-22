## Каталог товаров с корзиной (Read, Delete, Export)

-   I18n
-   Redis (Cache)
-   Docker
-   Корзина по сессиям, при логине переходит к пользователю
-   Экспорт корзины в Excel
-   Custom pagination

## Технологии, использованные при разработке

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)![Redis](https://img.shields.io/badge/redis-%23DD0031.svg?style=for-the-badge&logo=redis&logoColor=white)![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Запуск

### Через Docker:

1.  `mv .env.docker .env`
2.  `npm run dev`
3.  `docker compose up`

Для заполнения товарами:
`docker exec <container_id> php artisan db:seed`

Для заполнения пользователями:
`docker exec <container_id> php artisan db:seed UserSeeder`

### Локально:

1.  `mv .env.local .env`
2.  `composer run dev`

Для заполнения товарами:
`php artisan db:seed`

Для заполнения пользователями:
`php artisan db:seed UserSeeder`

## Вход в аккаунт

id - от 0 до 10 (подробнее в `database/seeders/UserSeeder`)

Почта: `user{id}@user{id}.com`
Пароль: `qwerty`
