## Каталог товаров с корзиной (Read, Delete)

-   I18n
-   Redis (Cache)
-   Docker
-   Корзина по сессиям, при логине переходит к пользователю
-   Custom pagination

## Технологии, использованные при разработке

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)![Redis](https://img.shields.io/badge/redis-%23DD0031.svg?style=for-the-badge&logo=redis&logoColor=white)![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

## Запуск

1.  `npm run dev`
2.  `docker compose up`

Для заполнения товарами:
`docker exec <container_id> php artisan db:seed`

Для заполнения пользователями:
`docker exec <container_id> php artisan db:seed UserSeeder`
