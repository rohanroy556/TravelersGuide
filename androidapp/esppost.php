<?php
    $temp = $_POST["temperature"];
    $hum = $_POST["humidity"];
    $write = "<p>Temperature : ".$temp." Celcius</p>"."<p>Humidity : ".$hum." %</p>";
    file_put_contents("sensors.html",$write);
?>