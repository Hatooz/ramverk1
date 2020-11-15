<?php
namespace Anax\View;
 
?>
<h1>PHP validering</h1>
<form action="" method="POST">
    <label for="ip">IP: </label>
    <input type="text" name="ip" id="ip">
    <input type="submit" value="Check">
</form>

<p>Country: <?= $country ?? "Not Available" ?></p>
<p>Region: <?= $region  ?? "Not Available"  ?></p>
<p>Latitude: <?= $latitude  ?? "Not Available" ?></p>
<p>Longitude: <?= $longitude  ?? "Not Available" ?></p>
<p>IP: <?= $ip  ?? "Not Available" ?></p>
<p>Type: <?= $type  ?? "Not Available" ?></p>
