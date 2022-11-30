### Запуск проекта

Установка зависимостей
```
composer i
```

Создание `.env` файла
```
cp .env.example .env
```

Запуск Docker контейнера
```
./vendor/bin/sail up -d
```

Генерация секретного ключа для JWT
```
./vendor/bin/sail artisan jwt:secret
```

Запуск миграции с генерацией тестовых данных
```
./vendor/bin/sail artisan migrate --seed
```

Запуск тестов
```
./vendor/bin/sail test
```
