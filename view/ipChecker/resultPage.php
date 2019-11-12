<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Here are the results for <?= $ip1 ?></h1>

<!-- <h1>Guess my number</h1> -->




<p>Type: <?= $type ?></p>
<p>City: <?= $city ?></p>
<p>Country: <?= $country_name ?></p>
<p>Position: Latitude <?= $latitude ?>, longitude <?= $longitude ?></p>



<!-- <form method="post">
    <input type="text" name="ip1">
    <input type="submit" name="ip1" value="Kolla">
</form> -->
