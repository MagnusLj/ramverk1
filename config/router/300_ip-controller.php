<?php
/**
 * Load the IP Checker as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP Checker.",
            "mount" => "ip-checker",
            "handler" => "\Malm18\IPChecker\IPController",
        ],
        [
            "info" => "IP json Checker.",
            "mount" => "ip-json-checker",
            "handler" => "\Malm18\IPChecker\IPJsonController",
        ],
        [
            "info" => "Väder.",
            "mount" => "vader",
            "handler" => "\Malm18\IPChecker\VaderController",
        ],
        [
            "info" => "JSON-väder.",
            "mount" => "json-vader",
            "handler" => "\Malm18\IPChecker\JSONVaderController",
        ],
    ]
];
