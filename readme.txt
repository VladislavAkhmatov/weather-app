# OpenWeatherMap API Project

## Описание
Этот проект на PHP позволяет получать данные о погоде с помощью API OpenWeatherMap.
В проекте используется JSON-файл со списком всех городов для удобного поиска информации.

## Технологии
- **PHP** – для обработки запросов и работы с API.
- **OpenWeatherMap API** – источник данных о погоде.
- **JSON** – хранение списка всех городов.

## Установка и настройка
1. **Склонируйте репозиторий:**
   git clone https://github.com/yourusername/weather-app.git
   cd weather-app
2. **Получите API-ключ OpenWeatherMap:**
   - Зарегистрируйтесь на [OpenWeatherMap](https://openweathermap.org/)
   - Получите API-ключ в личном кабинете

3. **Настройте переменные окружения:**
   - В файле `forecast.php` в методах apiResponse и forecastResponse укажите ваш API-ключ:

4. **Запустите локальный сервер:**
   php -S localhost:8000

