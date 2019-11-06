<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Här är resultatet för adressen <?= $ip1 ?></h1>

<!-- <h1>Guess my number</h1> -->


<p>Domännamn: <?= $hostname ?></p>

<p>Typ: <?= $type ?></p>



<form method="post">
    <input type="text" name="ip1">
    <input type="submit" name="ip1" value="Kolla">
</form>
