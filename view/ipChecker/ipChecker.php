<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Kolla en ip-adress</h1>

<!-- <h1>Guess my number</h1> -->


<p>Lägg in ip-adressen här nedanför och tryck på Kolla så blir du klokare.</p>





<form method="post">
    <input type="text" name="ip1">
    <input type="submit" name="ipsubmit" value="Kolla">
</form>
