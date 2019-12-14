<?php

/**
 * Mount the controller onto a mountpoint.
 */
return [
    "routes" => [
        [
            "info" => "User controller.",
            "mount" => "user",
            "handler" => "\Malm18\User\UserController",
        ],
    ]
];
