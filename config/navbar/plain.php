<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",

    // Here comes the menu items/structure
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
        [
            "text" => "IP-kollare",
            "url" => "ip-checker",
            "title" => "Kolla IP-adress.",
        ],
        [
            "text" => "IP-JSON",
            "url" => "ip-json-checker/ipJsonChecker",
            "title" => "Kolla IP-adress.",
        ],
        [
            "text" => "Väder",
            "url" => "vader",
            "title" => "Blir det ruskigt måntro?",
        ],
        [
            "text" => "JSON-väder",
            "url" => "json-vader/jsonVader",
            "title" => "JSON-väder",
        ],
    ],
];
