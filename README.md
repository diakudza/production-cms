на фронте: блэйд шаблоны , tailwind + библиотека https://daisyui.com/, иконки https://heroicons.dev/

на бэкеле laravel 9, php8.1, mysql8 

Поднимаем через sail
```
./vendor/bin/sail build - Собирает контейнер
./vendor/bin/sail up -d - Запускаем контейнеры в фоне
./vendor/bin/sail composer install - установаить пакеты зависимостей 
./vendor/bin/sail npm install - установаить пакеты зависимостей
```

Если нужно выполнить в контейнере
(Импортировать дамп базы)
````
./vendor/bin/sail exec laravel bash
# mysql --database=laravel < "dump.sql"
````

Для сборки фронта
````
./vendor/bin/sail npm run dev - для разработки
./vendor/bin/sail npm run build - для сборки
````

Выполнить миграции (Если не делали импорт всей базы)
```
./vendor/bin/sail artisan migrate
```

При разработке, для проброса локального порта "наружу" ``lt --port 8000``
