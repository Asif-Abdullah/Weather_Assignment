<?php
if (array_key_exists('submit', $_GET)) {
  if ($_GET['city']) {
    $erroe = "Sorry ,Your Input field is empty";
  }
  if ($_GET['city']) {
    $apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=" . $_GET['city'] . "&appid=3141312094d1523ad8786a215ef86c6b");
    $weatherArray = json_decode($apiData, true);
    if ($weatherArray['cod'] == 200) {
      $tempCelsius = $weatherArray['main']['temp'] - 273;
      $weather = "<b>" . $weatherArray['name'] . ", " . $weatherArray['sys']['country'] . " :" . intval($tempCelsius) . "&deg;C</b> <br>";
      $weather .= "<b>Weather Condition :</b>" . $weatherArray['weather']['0']['description'] . "<br>";
      $weather .= "<b>Atmosperic Pressure :</b>" . $weatherArray['main']['pressure'] . "hpa <br>";
      $weather .= "<b>Wind Speed :</b>" . $weatherArray['wind']['speed'] . "meter/sec <br> ";
      $weather .= "<b>Cloudness :</b>" . $weatherArray['clouds']['all'] . " % <br> ";
      date_default_timezone_set('Asia/Dhaka');
      $sunrise = $weatherArray['sys']['sunrise'];

      $weather .= "<b>Sunrise : </b>" . date("g:i a", $sunrise) . "<br>";
      $weather .= "<b>Current Time : </b>" . date("F j, Y, g:i a");
    } else {
      $erroe = "Couldn't be Prosess,Your city nameis not valid";
    }
  }
}



?>



<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Weather website</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">

    <h1>Global Weather</h1>
    <form action="" method="GET">
      <p><label for="city">Enter your city name</label></p>
      <p> <input type="text" name="city" id="city" placeholder="city Name"></p>
      <button type="submit" name="submit" class="btn btn-success">Submit</button>

      <div class="output mt-3">
        <?php
        if (isset($weather)) {
          echo '<div class="alert alert-success" role="alert">
        ' . $weather . '
        </div>';
        }
        if (isset($error)) {
          echo '<div class="alert alert-danger" role="alert">
        ' . $error . '
        </div>';
        }



        ?>
      </div>

    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>

</html>