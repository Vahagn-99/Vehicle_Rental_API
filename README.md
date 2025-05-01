# Carsharing API

Проект **Carsharing API** — это backend для системы аренды транспортных средств.

## 📦 Стек технологий

- PHP 8.x + Laravel 10
- MySQL / MariaDB
- Docker + Docker Compose
- Nginx + PHP-FPM
- OpenAPI (Swagger) для документации API

## 🚀 Запуск проекта

```bash
# Клонировать репозиторий
git clone https://github.com/Vahagn-99/Vehicle_Rental_API carsharing-api
cd carsharing-api
```

# Запустить Docker-контейнеры
```bash
docker compose up --build -d
```

# (Опционально) Масштабировать API
```bash
docker compose up --scale app=3 -d
```

# скопировать .env
```bash
cp .env.example .env
```

# Установтиь зависмости
```bash
docker compose exec app composer install
```

# Генерировать ключ проекта
```bash
docker compose exec app key:generate
```

# Генерировать ключ jwt
```bash
docker compose exec app php artisan jwt:secret
```

# Применить миграции
```bash
docker compose exec app php artisan migrate --seed
```

## 🌐 API Документация

Swagger UI доступен по адресу:

```
http://localhost будет перенаправлено в http://localhost/api/documentation сделано для простаты
```
PGADMIN доступен по адресу:

```
http://localhost:8010
```
сервер уже подключен нужно будеть прописать пароль для подключения (см .env.example)

## 📂 Структура
```bash
/app/Base - слой домена
- ├── Auth
  │ ├── AuthData.php
  │ └── Manager.php
  ├── Renter
  │ ├── BalanceOperationType.php
  │ ├── Events
  │ │ └── BalanceUpdated.php
  │ ├── Exceptions
  │ │ └── BalanceException.php
  │ ├── Jobs
  │ │ └── UpdateBalance.php
  │ ├── Listeners
  │ │ └── CheckBalanceStatus.php
  │ ├── Manager.php
  │ ├── Repositories
  │ │ ├── Balance.php
  │ │ ├── RentalHistory.php
  │ │ ├── Renter.php
  │ │ └── TransactionHistory.php
  │ └── UpdateBalance.php
  └── Vehicle
      ├── Events
      ├── Listeners
      ├── Location.php
      ├── Manager.php
      └── Repositories
          └── Vehicle.php
```

- `routes/` — маршруты API
- `docker compose.yml` — описание контейнеров
- `docker/` — насторки докера
---

