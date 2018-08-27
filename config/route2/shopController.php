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
        ],
        [
            "info" => "Remove Cart",
            "requestMethod" => "get|post",
            "path" => "cart/remove",
            "callable" => ["shopController", "removeCart"],
        ],
        [
            "info" => "Cart Checkout",
            "requestMethod" => "get|post",
            "path" => "cart/checkout",
            "callable" => ["shopController", "checkoutCart"],
        ]
    ]
];
