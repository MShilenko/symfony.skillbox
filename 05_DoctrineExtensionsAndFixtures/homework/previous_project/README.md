# Учебный проект по Symfony Модуль 4: "Библиотека работы с базой данных Doctrine Orm" - Домашняя работа
 
Автор курса: **[Волков Михаил](https://mvsvolkov.ru)**

## Установка
Склонируйте проект, в списке коммитов выберите нужную версию работы.

**Установите зависимости**
```
composer install
```

**Сконфигурируйте файл .env**

Обязательный параметр для конфигурации: `DATABASE_URL`.

**Установка Базы данных**

Убедитесь что параметр `DATABASE_URL` настроен корректно, и выполните следующие команды

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```


**Запустите веб-сервер**

Для этого вам понадобится [приложение symfony](https://symfony.com/download)

```
symfony serve
```

Заходите на `http://localhost:8000`