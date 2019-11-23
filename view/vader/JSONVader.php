<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Sverige får väder (json)</h1>

<!-- <h1>Guess my number</h1> -->


<p>Skriv in en ip-adress eller en plats, välj om du vill se framåt eller bakåt och tryck på Kolla för att få information om läderveken</p>

<input type="radio" name="when" value="forwards"> en vecka framåt<br>
<input type="radio" name="when" value="backwards"> 30 dagar bakåt<br><br>





<form method="post">
    <input type="text" name="ip1" value=<?= $ownIP ?>>
    <input type="submit" name="ipsubmit" value="Kolla">
</form>

<h3>Test links</h3>

<a href="../ip-json-checker?ip=208.67.222.222">208.67.222.222</a><br><br>

<a href="../ip-json-checker?ip=2a03:2880:f21a:e5:face:b00c::4420">2a03:2880:f21a:e5:face:b00c::4420</a><br><br>

<a href="../ip-json-checker?ip=23.66.18.35">23.66.18.35</a><br>

<h3>Instructions</h3>

<p>You can use the above or change the address in your browser so that it ends with '/ip-json-checker?ip=&lt;ip address you wish to check&gt;.</p>
