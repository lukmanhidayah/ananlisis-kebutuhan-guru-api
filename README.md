# Ananlisis Kebutuhan Guru API

This repository contains a Laravel based REST API used for the teacher needs project. Authentication uses Sanctum and the API responses follow a common JSON structure.

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

## Available Endpoints

All routes are prefixed with `/api/v1` and protected using Sanctum (except `/login`).

| Method | Endpoint | Description |
| ------ | -------- | ----------- |
| POST   | `/login` | Obtain an auth token |
| POST   | `/logout` | Revoke the auth token |
| GET    | `/madrasahs` | List madrasahs |
| POST   | `/madrasahs` | Create madrasah |
| GET    | `/madrasahs/{id}` | Show madrasah |
| PUT    | `/madrasahs/{id}` | Update madrasah |
| DELETE | `/madrasahs/{id}` | Delete madrasah |
| GET    | `/madrasah-levels` | List madrasah levels |
| POST   | `/madrasah-levels` | Create madrasah level |
| GET    | `/madrasah-levels/{id}` | Show madrasah level |
| PUT    | `/madrasah-levels/{id}` | Update madrasah level |
| DELETE | `/madrasah-levels/{id}` | Delete madrasah level |
| GET    | `/class-levels` | List class levels (use `madrasahLevelId` query to filter) |
| POST   | `/class-levels` | Create class level |
| GET    | `/class-levels/{id}` | Show class level |
| PUT    | `/class-levels/{id}` | Update class level |
| DELETE | `/class-levels/{id}` | Delete class level |
| GET    | `/subjects` | List subjects |
| POST   | `/subjects` | Create subject |
| GET    | `/subjects/{id}` | Show subject |
| PUT    | `/subjects/{id}` | Update subject |
| DELETE | `/subjects/{id}` | Delete subject |
| GET    | `/regencies` | List regencies |
| GET    | `/districts` | List districts (use `regencyId` query to filter) |
| GET    | `/villages` | List villages (use `districtId` query to filter) |
| GET    | `/academic-years` | List academic years |
| POST   | `/academic-years` | Create academic year |
| GET    | `/academic-years/{id}` | Show academic year |
| PUT    | `/academic-years/{id}` | Update academic year |
| DELETE | `/academic-years/{id}` | Delete academic year |

## Testing

Run PHPUnit tests using:

```bash
php artisan test
```

