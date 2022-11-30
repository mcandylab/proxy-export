### Запуск проекта

Установка зависимостей
```
composer i
```

Создание `.env` файла
```
cp .env.example .env
```

Генерация секретного ключа для JWT
```
php artisan jwt:secret
```

Запуск Docker контейнера
```
./vendor/bin/sail up -d
```
