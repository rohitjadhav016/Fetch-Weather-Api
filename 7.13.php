<?php
    
    $weatherDesc = "";
    $error = "";
    
    if (array_key_exists('city', $_GET)) {

        $city = $_GET['city'];
        $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($city)."&appid=1957505901190cb54408973e7254feb3");
        $apiDataArr = json_decode($apiData, true);

        if(!empty($apiDataArr) && $apiDataArr['cod'] == 200){
            $weatherDesc = "The weather in ".$city." is currently ".$apiDataArr['weather'][0]['description'];

            $celTemp = $apiDataArr['main']['temp'] - 273;
    
            $windSpeed = $apiDataArr['wind']['speed'];
    
            $weatherDesc .= "\n The temperature is ".round($celTemp)."&deg;c and the Wind Speed is ".$windSpeed."m/s";
        } else {
            $error = "Can not find the temperature of the city entered. Please try again!!!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Fetch Weather API</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      
      <style type="text/css">
      
      html { 
          background: url(background.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              color: black;
              
          }
          
          .container {
              
              text-align: center;
              margin-top: 100px;
              width: 450px;
              
          }
          
          input {
              
              margin: 20px 0;
              
          }
          
          #weather {
              
              margin-top:15px;
              
          }
         
      </style>
      
  </head>
  <body>
    
      <div class="container">
      
          <h1>What's The Weather?</h1>
          
          
          
          <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "
    <?php 
																										  
        if (array_key_exists('city', $_GET)) {
																										   
			echo $_GET['city']; 
																										   
		}
																										   
	?>">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      
          <div id="weather"><?php 
              
              if ($weatherDesc) {
                  
                  echo '<div class="alert alert-success" role="alert">
  '.$weatherDesc.'
</div>';
                  
              } else if ($error) {
                  
                  echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
                  
              }
              
              ?></div>
      </div>

    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>