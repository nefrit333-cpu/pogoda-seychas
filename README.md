# Погода сейчас

Одностраничный сайт прогноза погоды на Laravel/PHP. Страница сразу запрашивает геолокацию пользователя, определяет город или поселок и показывает текущую погоду, почасовой прогноз на остаток дня и прогноз на неделю.

## Возможности

- Автоматическое определение текущей локации через браузерную геолокацию.
- Reverse geocoding через BigDataCloud для названия населенного пункта.
- Прогноз из Open-Meteo без серверных API-ключей.
- Почасовой прогноз текущего дня с учетом часа просмотра.
- Адаптивный интерфейс для desktop и mobile.
- Статический экспорт для Vercel.

## Локальный запуск

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Откройте `http://127.0.0.1:8000`.

## Статический экспорт

```bash
php scripts/export-static.php
```

Файл для Vercel будет создан в `vercel/index.html`.

## Проверки

```bash
php -l resources/views/welcome.blade.php
php scripts/export-static.php
```

## Деплой

Сайт опубликован на Vercel: https://vercel-nine-wine-49.vercel.app

## Лицензия

MIT. Подробности в `LICENSE`.
