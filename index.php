<?php
require "vendor/autoload.php";

use App\Forecast;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;

$httpClient = new Client();
$httpRequestFactory = new HttpFactory();

$city = $_GET['city'] ?? 'Astana';

$api = new Forecast();
if ($api->apiResponse($httpClient, $httpRequestFactory, $city)) {
    $weather = $api->apiResponse($httpClient, $httpRequestFactory, $city);
    $forecast = $api->forecastResponse($httpClient, $httpRequestFactory, $city);
    $forecastsArray = iterator_to_array($forecast);
    $slicedForecast = array_slice($forecastsArray, 0, count($forecastsArray) - 3);
}

$cities = $api->getCities();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Weather Forecast</title>
</head>
<body>
<form class="select-city" method="GET" action="">
    <label for="city">Выберите город:</label>
    <select name="city" id="city">
        <?php foreach ($cities as $city): ?>
            <?php foreach ($city as $item): ?>
                <?php if ($item['country_id'] == 1894): ?>
                    <option value="<?= $item['name'] ?>" <?= (isset($_GET['city']) && $_GET['city'] == $item['name']) ?
                        'selected' : '' ?>><?= $item['name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </select>
    <button type="submit">Показать погоду</button>
</form>
<div class="card">
    <h2><?= $weather->city->name ?? 'Астана' ?></h2>
    <h3><?= $weather->weather->description ?? 'Солнечно' ?>
        <span>Ветер <?= isset($weather->wind->speed) ? (int)$weather->wind->speed->getValue() : 0 ?>km/h <span
                    class="dot">•</span> Осадки <?= isset($weather->precipitation) ? $weather->precipitation->getValue() : 0 ?>%
        </span>
    </h3>
    <h1><?= isset($weather->temperature->now) ? (int)$weather->temperature->now->getValue() : 10 ?>°</h1>
    <img class="icon" src="https://openweathermap.org/img/wn/<?= $weather->weather->icon ?? 'default' ?>.png"
         alt="icon">
    <table>
        <?php if (isset($slicedForecast)): ?>
            <tr>
                <?php foreach ($slicedForecast as $forecastItem): ?>
                    <td><?= $forecastItem->time->to->format('H:i') ?? '00:00' ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($slicedForecast as $forecastItem): ?>
                    <td> <?= (int)$forecastItem->temperature->now->getValue() ?? '00:00' ?>°</td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($slicedForecast as $forecastItem): ?>
                    <td> <?= (int)$forecastItem->temperature->min->getValue() ?? '00:00' ?>°</td>
                <?php endforeach; ?>
            </tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>
