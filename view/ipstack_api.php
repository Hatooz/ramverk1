<?php
namespace Anax\View;

?>

<p>Ipstack API</p>
 
<p>Du kan antigen använda någon slags mjukvara för att använda APIet, som till exemple postman, eller mata in din IP adress direkt i fältet nedan.</p>
<p>Svar kommer alltid att vara i JSON format.</p>
<form action="" method="POST">
    <label for="ipstack_rest">IP: </label>
    <input type="text" name="ipstack_rest" id="ipstack_rest">
    <input type="submit" name="doRest" id="doRest" value="Check">
</form>


<h1>Testroutes</h1>
<form action="" method="POST">    
    <input type="text" name="ipstack_rest" id="ipstack_rest_hidden" value="127.0.0.1" hidden>
    <input type="submit" name="doRest" id="doRest" value="Localhost">
</form>
<br>
<form action="" method="POST">    
    <input type="text" name="ipstack_rest" id="ipstack_rest_hidden" value="134.201.250.155" hidden>
    <input type="submit" name="doRest" id="doRest" value="Ipstack Assets">
</form>
