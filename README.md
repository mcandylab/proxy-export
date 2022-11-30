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

### Учетные данные для аутентификации по API

```
email:       test@example.com
password:    password
```

### Postman коллекция
Для тестирования запросов есть возможность импортировать готовую коллекцию в Postman

Ссылка для импорта:
https://documenter.getpostman.com/view/5644744/2s8YszQqpk#intro
