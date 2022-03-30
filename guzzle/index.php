<?php
    require_once("vendor/autoload.php");

    $egyptianCities = City::getEgyptianCities();

    if(isset($_POST['submit'])) {
        echo GuzzleWeather::getWeatherData($_POST['city']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Weather Info</title>
</head>
<body>
    <form method="post">
        <select name="city" id="city">
            <?php
                foreach($egyptianCities as $city) {
                    echo "<option name='{$city['name']}'>{$city['name']}</option>";
                }
            ?>
        </select>
        <input type="submit" name="submit" value="Get Weather">
    </form>
</body>
</html>