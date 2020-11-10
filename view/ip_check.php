<?php
namespace Anax\View;


?>
<h1>PHP validering</h1>
<form action="" method="POST">
    <label for="ip">IP: </label>
    <input type="text" name="ip" id="ip">
    <input type="submit" value="Check">
</form>

<p><?=  $result ?></p>
<p>Domain name: <?=  $domain ?></p>
