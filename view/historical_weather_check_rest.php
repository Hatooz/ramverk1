<?php
namespace Anax\View;

?>
<h1>Historisk väderrdata API</h1>
<p>Mata in antigen koordinater eller en IP adress för att se hur vädret var de senaste 5 dagarna.</p>
<form action="" method="POST" class="weather-form">
    <label for="ip">IP: </label>
    <input type="text" name="ip" id="ip">
    <!-- <input type="submit" value="Check"> -->
<!-- </form> -->
<!-- <form action="weather_check/ipstack" method="POST" class="weather-form"> -->
    <label for="lat">Latitude: </label>
    <input type="text" name="lat" id="lat">
    <label for="lon">Longitude: </label>
    <input type="text" name="lon" id="lon"><br>
    <input type="submit" value="Check">
</form>
 
