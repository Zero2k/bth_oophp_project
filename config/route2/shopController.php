<?php
/**
 * Routes to pages.
 */
return [
    "routes" => [
        [
            "info" => "Shop",
            "requestMethod" => "get|post",
            "path" => "shop",
            "callable" => ["shopController", "getShop"],
        ],
    ]
];
