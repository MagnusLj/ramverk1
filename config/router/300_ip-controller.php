<?php
/**
 * Load the IP Checker as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP Checker.",
            "mount" => "ip-checker",
            "handler" => "\Anax\Controller\IPController",
        ],
    ]
];