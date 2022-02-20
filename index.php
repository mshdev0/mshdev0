<?php

  $weather = "";
  $error = "";

  if ($_GET['city']) {

    $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$_GET['city']."&appid=API Key");

    $weatherArray = json_decode($urlContents, true);

    if ($weatherArray['cod'] == 200) {
    
    $weather = "<p>"."The weather in "."<strong>".$_GET['city']."</strong>"." is currently "."<strong>".$weatherArray['weather'][0]['description']."</strong>"."</p>";

    $celcius = array("tempCelcius","minCelcius","maxCelcius");

    $celcius[0] = intval($weatherArray['main']['temp'] - 273);
    $celcius[1] = intval($weatherArray['main']['temp_min'] - 273);
    $celcius[2] = intval($weatherArray['main']['temp_max'] - 273);

    $weather .= "<p>Temperature is"." "."<strong>".$celcius[0]." "."&deg;C"."</strong>"."</p>".
    "<p>"."Humidity"." "."<strong>".$weatherArray['main']['humidity']." "."%"."</strong>"."</p>".
    "<p>"."Min Temp:"." "."<strong>".$celcius[1]."&deg;C"." "."</strong>"."</p>".
    "<p>"."Max Temp:"." "."<strong>".$celcius[2]."&deg;C"." "."</strong>"."</p>".
    "<p>"."The wind speed is"." "."<strong>".$weatherArray['wind']['speed']." "."m/s"."</strong>"."</p>";

    } else {

      $error = "City not found! Please try again.";

    }
        
  }
   
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>My weather app</title>

    <link rel="stylesheet" href="phpstyle.css">
        
  </head>
  <body>
    <main>
        <header>
          <div class="blog-header bg-light">
            <div class="row flex-nowrap justify-content-center align-items-center">
              <div class="col-4 text-center">
              <a href="https://harishkutty-com.stackstaging.com"><img src="sun.gif" width="50px">  Home</a>
              </div>
            </div>
          </div>
        </header>  
        <div class="container">
            <h1><strong>What's The Weather?</strong></h1>
            <form>
                <div class="mb-3">
                    <label for="city" class="form-label" style="color:white;">Enter the name of the city</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="Eg : Chennai,Trichy,Coimbatore">
                </div>
                <button class="btn btn-primary">Go!</button>
            </form>

            <div id="weather">
              <?php 
                  
                  if ($weather) {
                      
                      echo '<div class="alert alert-info" role="alert">
                          '.$weather.'</div>';
                      
                  } else if ($error) {
                      
                      echo '<div class="alert alert-danger" role="alert">
                      '.$error.'</div>';
                      
                  }
                  
              ?>
            </div>
        </div>
    </main>  
    <footer class="footer bg-dark text-center">
          <div class="container">  
            <span class="text-muted">&COPY; 2022 Webpage by Harish</span>
          </div> 
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>