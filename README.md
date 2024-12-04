## Каталог товаров с корзиной (Read, Delete, Export)

-   I18n
-   Redis (Cache)
-   Docker
-   Корзина по сессиям, при логине переходит к пользователю
-   Сложная логика разнесена по сервисам
-   Экспорт корзины в Excel
-   Кастомная пагинация по товарам
-   API + Swagger `/api/documentation`
-   OAuth (Laravel Socialite)

## Технологии, использованные при разработке

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)![Redis](https://img.shields.io/badge/redis-%23DD0031.svg?style=for-the-badge&logo=redis&logoColor=white)![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)![Swagger](https://img.shields.io/badge/-Swagger-%23Clojure?style=for-the-badge&logo=swagger&logoColor=white)

## Запуск

### Через Docker:

1. `mv .env.example .env`
2. `docker compose up`

### Заполнение БД данными:

1. `./vendor/bin/sail artisan migrate`
2. `./vendor/bin/sail artisan db:seed`

## Вход в аккаунт

id - от 1 до 10 (подробнее в `database/seeders/UserSeeder`)

Почта: `user{id}@user{id}.com`
Пароль: `qwerty`
