## Установка

### Требования

- [Docker](https://www.docker.com)
- [Git](https://git-scm.com/downloads)
- [Nginx](https://www.nginx.com)
- SSL

### Загрузка репозитория

```bash
git clone https://github.com/firdavsibodullaev/ndki_football.git
```

### Конфигурационный файл

Переименовать `.env.example` на `.env`

В файле `.env` изменить следующие поля

```dotenv
APP_NAME="Ваше название на проекта"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain

DB_DATABASE="Ваше название базы данных (на латинице)"
DB_PASSWORD="Пароль для базы данных"
```

### Докер

```bash
docker compose build
```

```bash
docker compose up -d
```

После поднятия контейнера войдите в контейнер

```bash
docker exec -it ndki_football_app bash
```

Установка зависимостей

```bash
composer install --optimize-autoloader --no-dev
```

Внутри контейнера запустите следующие команды

```bash
php artisan key:generate
```

```bash
php artisan migrate
```

```bash
php artisan storage:link
```

После запуска команды выйдите из контейнера

```bash
exit
```

### Nginx

Укажите прокси путь в nginx на `127.0.0.1:8010`

## Готово
