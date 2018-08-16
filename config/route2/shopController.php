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
        [
            "info" => "View Product",
            "requestMethod" => "get|post",
            "path" => "shop/product/{id:digit}",
            "callable" => ["shopController", "getProduct"],
        ],
        [
            "info" => "View Cart",
            "requestMethod" => "get|post",
            "path" => "cart",
            "callable" => ["shopController", "getCart"],
        ],
        [
            "info" => "Add product to Cart",
            "requestMethod" => "post",
            "path" => "cart/add",
            "callable" => ["shopController", "postAddToCart"],
        ]
    ]
];
