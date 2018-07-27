<?php
/**
 * Routes for admin controller.
 */
return [
    "routes" => [
        [
            "info" => "Admin.",
            "requestMethod" => "get|post",
            "path" => "admin",
            "callable" => ["adminController", "getAdmin"],
        ],
    ]
];
