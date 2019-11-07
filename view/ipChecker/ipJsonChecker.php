<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Kolla en ip-adress (JSON)</h1>

<!-- <h1>Guess my number</h1> -->


<p>Lägg in ip-adressen här nedanför och tryck på Kolla så får du svar i JSON.</p>





<form method="post">
    <input type="text" name="ip1">
    <input type="submit" name="ipsubmit" value="Kolla">
</form>

<h3>Testlänkar</h3>

<a href="../ip-json-checker?ip=208.67.222.222">208.67.222.222</a><br><br>

<a href="../ip-json-checker?ip=2a03:2880:f21a:e5:face:b00c::4420">2a03:2880:f21a:e5:face:b00c::4420</a><br><br>

<a href="../ip-json-checker?ip=23.66.18.35">23.66.18.35</a><br>

<h3>Instruktioner</h3>

<p>Du kan använda ovanstående eller så kan du ändra adressen i webbläsaren så att den slutar på '/ip-json-checker?ip=&lt;ip-adressen du vill kolla&gt;.</p>
