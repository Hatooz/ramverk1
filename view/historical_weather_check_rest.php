<?php
namespace Anax\View;

?>
<h1>REST validering</h1>

<h2>REST api för validering av IP adresser.</h2>
<p>Du kan antigen använda någon slags mjukvara för att använda APIet, som till exemple postman, eller mata in din IP adress direkt i fältet nedan.</p>
<p>Svar kommer alltid att vara i JSON format.</p>
<form action="" method="POST">
    <label for="ip_rest">IP: </label>
    <input type="text" name="ip_rest" id="ip_rest">
    <input type="submit" name="doRest" id="doRest" value="Check">
</form>

 
