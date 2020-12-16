# Учебный проект по Symfony Модуль 4: "Библиотека работы с базой данных Doctrine Orm"
## Cat-Cas-Car
Это учебный проект по фреймворку Symfony на курсе Skillbox. Модуль 4: "Библиотека работы с базой данных Doctrine Orm"
 
Автор курса: **[Волков Михаил](https://mvsvolkov.ru)**

## Установка
Выберите нужную версию по тегу и скачайте проект

**Установите зависимости**

Для этого вам понадобится [установленный Composer](https://getcomposer.org/download/),
а затем выполните:

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


**Скомпилируйте Webpack Encoder Assets**

Убедитесь, что у вас установлен [yarn](https://yarnpkg.com/lang/en/),
а затем выполните:

```
yarn install
yarn run dev
```

**Запустите веб-сервер**

Для этого вам понадобится [приложение symfony](https://symfony.com/download)

```
symfony serve
```

Заходите на `http://localhost:8000`

Изучайте!
